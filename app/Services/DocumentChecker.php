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
        $parser = new PdfParser();
        $pdf = $parser->parseFile($filePath);
        return $pdf->getText();
    }

    public function extractFromDocx($filePath)
    {
        $phpWord = IOFactory::load($filePath);
        $text = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof Text) {
                    $text .= $element->getText() . " ";
                } elseif ($element instanceof TextRun) {
                    foreach ($element->getElements() as $e) {
                        if ($e instanceof Text) {
                            $text .= $e->getText() . " ";
                        }
                    }
                } elseif ($element instanceof Table) {
                    foreach ($element->getRows() as $row) {
                        foreach ($row->getCells() as $cell) {
                            foreach ($cell->getElements() as $ce) {
                                if ($ce instanceof Text) {
                                    $text .= $ce->getText() . " ";
                                } elseif ($ce instanceof TextRun) {
                                    foreach ($ce->getElements() as $t) {
                                        if ($t instanceof Text) {
                                            $text .= $t->getText() . " ";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return trim($text);
    }

    private function extractFromImage($filePath)
    {
        $response = Http::attach(
            'file', file_get_contents($filePath), basename($filePath)
        )->post('https://api.ocr.space/parse/image', [
            'apikey' => env('OCR_SPACE_API_KEY'),
            'language' => 'eng',
        ]);

        if ($response->successful()) {
            $json = $response->json();
            return $json['ParsedResults'][0]['ParsedText'] ?? '';
        }

        return '';
    }

    public function checkRequirementInFile($filePath, $requirementName)
    {
        $text = $this->extractText($filePath);

        // Normalize text (case insensitive, trim spaces)
        $text = strtolower($text);
        $requirementName = strtolower($requirementName);

        return str_contains($text, $requirementName);
    }
}
