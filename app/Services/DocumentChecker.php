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

    public function verifyDocumentBelongsToUser($filePath, $requirementName, $user)
    {
        $text = strtolower($this->extractText($filePath));

        if (empty(trim($text))) {
            return 'No Readable Text';
        }

        // Normalize requirement name and user info
        $requirementName = strtolower($requirementName);
        $userName = strtolower($user->name ?? '');
        $userAddress = strtolower(trim("{$user->user_info->barangay} {$user->user_info->city} {$user->user_info->province}"));

        // Clean multiple spaces
        $text = preg_replace('/\s+/', ' ', $text);
        $requirementName = preg_replace('/\s+/', ' ', $requirementName);
        $userName = preg_replace('/\s+/', ' ', $userName);
        $userAddress = preg_replace('/\s+/', ' ', $userAddress);

        //Check requirement existence
        $requirementWords = explode(' ', $requirementName);
        $requirementFound = true;
        foreach ($requirementWords as $word) {
            if (!str_contains($text, $word)) {
                $requirementFound = false;
                break;
            }
        }

        //Check name loosely (allow partial match)
        $nameFound = false;
        if ($userName) {
            $nameParts = explode(' ', $userName);
            $matches = 0;
            foreach ($nameParts as $part) {
                if (str_contains($text, $part)) {
                    $matches++;
                }
            }
            // Consider name found if at least half of the parts match
            $nameFound = ($matches >= ceil(count($nameParts) / 2));
        }

        //Check address loosely (allow partial match)
        $addressFound = false;
        if ($userAddress) {
            $addressParts = explode(' ', $userAddress);
            $matches = 0;
            foreach ($addressParts as $part) {
            if (str_contains($text, $part)) {
                $matches++;
            }
        }
        $addressFound = ($matches >= ceil(count($addressParts) / 2));
        }

        // Logging for debugging
        Log::info("Checking document for user '{$userName}' and requirement '{$requirementName}'");
        Log::info("Requirement found: " . ($requirementFound ? 'Yes' : 'No') . 
                ", Name found: " . ($nameFound ? 'Yes' : 'No') . 
                ", Address found: " . ($addressFound ? 'Yes' : 'No'));

        // Final result
        if ($requirementFound && ($nameFound || $addressFound)) {
            return 'Passed';
        } elseif ($requirementFound) {
            return 'Possibly Other Person’s Document';
        } else {
            return 'Needs Checking';
        }
    }

}
