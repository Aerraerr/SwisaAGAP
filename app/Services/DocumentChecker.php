<?php

namespace App\Services;

use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory as WordLoader;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Row;
use PhpOffice\PhpWord\Element\Cell;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Text;
use Illuminate\Support\Facades\Log;

class DocumentChecker
{
    public function extractText($filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        switch ($extension) {
            case 'pdf':
                return $this->extractFromPdf($filePath);

            case 'docx':
                return $this->extractFromDocx($filePath);

            case 'jpg':
            case 'jpeg':
            case 'png':
                return $this->extractFromImage($filePath);

            default:
                return '';
        }
    }

    private function extractFromPdf($filePath)
    {
        try {
            $parser = new PdfParser();
            $pdf = $parser->parseFile($filePath);
            return $pdf->getText();
        } catch (\Exception $e) {
            Log::error("PDF parsing failed for {$filePath}: " . $e->getMessage());
            return '';
        }
    }

    public function extractFromDocx($filePath)
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text = '';

            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    $text .= $this->extractTextFromElement($element);
                }
            }

            return trim($text);
        } catch (\Exception $e) {
            Log::error("DOCX parsing failed for {$filePath}: " . $e->getMessage());
            return '';
        }
    }

    private function extractTextFromElement($element)
    {
        $text = '';

        if ($element instanceof Text) {
            $text .= $element->getText() . ' ';
        } elseif ($element instanceof TextRun) {
            foreach ($element->getElements() as $e) {
                if ($e instanceof Text) {
                    $text .= $e->getText() . ' ';
                }
            }
        } elseif ($element instanceof Table) {
            foreach ($element->getRows() as $row) {
                foreach ($row->getCells() as $cell) {
                    foreach ($cell->getElements() as $ce) {
                        $text .= $this->extractTextFromElement($ce);
                    }
                }
            }
        }

        return $text;
    }

    private function extractFromImage($filePath)
    {
        $maxRetries = 3;
        $retryDelay = 2; // seconds between retries

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                Log::info("OCR attempt {$attempt} for image: {$filePath}");

                $response = Http::timeout(60)
                    ->connectTimeout(15)
                    ->attach('file', file_get_contents($filePath), basename($filePath))
                    ->post('https://api.ocr.space/parse/image', [
                        'apikey' => env('OCR_SPACE_API_KEY'),
                        'language' => 'eng',
                    ]);

                if ($response->successful()) {
                    $json = $response->json();
                    return $json['ParsedResults'][0]['ParsedText'] ?? '';
                }

                Log::warning("OCR API unsuccessful response: " . $response->status());
            } catch (\Exception $e) {
                Log::warning("OCR attempt {$attempt} failed: " . $e->getMessage());
                if ($attempt === $maxRetries) {
                    Log::error("All OCR attempts failed for {$filePath}");
                    return '';
                }

                sleep($retryDelay);
            }
        }

        return '';
    }

    public function checkRequirementInFile($filePath, $requirementName)
    {
        $text = strtolower($this->extractText($filePath));
        $requirementName = strtolower($requirementName);

        Log::info("Extracted text sample: " . substr($text, 0, 300));
        Log::info("Searching for '{$requirementName}'");

        // Normalize both strings
        $text = preg_replace('/\s+/', ' ', $text);
        $requirementName = preg_replace('/\s+/', ' ', $requirementName);

        // Split requirement into individual words
        $words = explode(' ', $requirementName);

        // Check if all words exist somewhere in the text
        foreach ($words as $word) {
            if (!str_contains($text, $word)) {
                return false;
            }
        }

        return true;
    }
}
