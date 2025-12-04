<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReportFinancial;

use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class ReportFinancialController extends Controller
{


    public function overAllBudget()
    {

        $total = DB::table('grants as g')
            ->sum(DB::raw('g.total_quantity * g.amount_per_quantity'));

        $total2 = DB::table('applications as a')
            ->join('grants as g', 'a.grant_id', '=', 'g.id')
            ->sum(DB::raw('g.unit_per_request * g.amount_per_quantity'));
        $combinedTotal = $total + $total2;

        return $combinedTotal;
    }
    public function totalGrantsReleased()
    {
        // Sum of released grants based on actual applications
        $total = DB::table('applications as a')
            ->join('grants as g', 'a.grant_id', '=', 'g.id')
            ->where('a.status_id', 5) // 5 = released
            ->sum(DB::raw('g.unit_per_request * g.amount_per_quantity'));

        return $total; // returns as float
    }



        // Optional: Budget Utilization (example)
        public function budgetUtilization()
        {
            $released = $this->totalGrantsReleased();
            $budget = $this->overAllBudget();

            return $budget > 0 ? round(($released / $budget) * 100, 2) : 0;
        }

    public function pendingDisbursements()
    {
        // Sum of all applications that are pending (status_id = 3)
        // Each request counts as 1, multiplied by the grant's unit_per_request and amount_per_quantity
        $total = DB::table('applications as a')
            ->join('grants as g', 'a.grant_id', '=', 'g.id')
            ->where('a.status_id', 3) // 3 = Pending
            ->sum(DB::raw('g.unit_per_request * g.amount_per_quantity'));

        return $total; // float
    }



    public function recentTransactions()
    {
    $applicationTransactions = DB::table('applications as a')
        ->join('grants as g', 'a.grant_id', '=', 'g.id')
        ->select(
            DB::raw("CONCAT('REQ-0000', a.id) as transaction_id"),
            DB::raw("'Grant Request' as type"),
            DB::raw('(g.unit_per_request * g.amount_per_quantity) as amount'),
            'a.updated_at as date',
            'a.status_id'
        );
    $grantTransactions = DB::table('grants as g')
        ->select(
            DB::raw("CONCAT('GRANTS-0000', g.id) as transaction_id"),
            DB::raw("'Grant Allocation' as type"),
            DB::raw('(g.total_quantity * g.amount_per_quantity) as amount'),
            'g.created_at as date',
            DB::raw("NULL as status_id")
        );
        $transactions = $applicationTransactions
            ->unionAll($grantTransactions)
            ->orderBy('date', 'desc')
            ->limit(1000)
            ->get()
            ->map(function ($t) {

                $status = (int) $t->status_id; 

                $statusText = match($status) {
                    7 => 'To be review',
                    6 => 'Rejected',
                    5 => 'Released',
                    4 => 'Approved',
                    3 => 'Pending',
                    
                    default => 'Grants Allocation',
                };

                return [
                    'transaction_id' => $t->transaction_id,
                    'type' => $t->type,
                    'amount' => $t->amount,
                    'date' => date('F d, Y', strtotime($t->date)),
                    'status' => $statusText,
                ];
            });

        return $transactions;

    }

    public function budgetChartData()
    {
        return [
            'overall'   => $this->overAllBudget(),
            'released'  => $this->totalGrantsReleased(),
            'pending'   => $this->pendingDisbursements(),
            'expenses'  => 0 // placeholder if you don’t have expenditures yet
        ];
    }


        



    public function exportPdf()
    {
        // --- DATA ---
        $totalGrantsReleased = $this->totalGrantsReleased() ?? 0;
        $combinedTotalValue = $this->overAllBudget() ?? 0;
        $budgetUtilization = $this->budgetUtilization() ?? 0;
        $pendingDisbursements = $this->pendingDisbursements() ?? 0;
        $transactions = $this->recentTransactions() ?? [];
        $budgetData = [
            'Overall Budget' => $combinedTotalValue,
            'Total Grants Released' => $totalGrantsReleased,
            'Budget Utilization (%)' => $budgetUtilization,
            'Pending Disbursements' => $pendingDisbursements
        ];
        $maxValue = max($budgetData);

        $logoPath = public_path('images/swisa-agap5.png');

        // --- HTML ---
        $html = '
        <html>
        <head>
            <meta charset="utf-8">
            <title>SwisaAGAP Financial Report</title>
            <style>
                body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin:0; padding:0; }
                .card { background:white; padding:10px; border-radius:8px; text-align:center; margin-bottom:10px; }
                .card h3 { color:#2C6E49; margin:5px 0; font-size:12px; }
                .card p { margin:0; font-weight:bold; font-size:14px; color:#2C6E49; }
                .modern-table th { background:#2C6E49; color:white; padding:8px; font-size:11px; text-align:left; }
                .modern-table td { padding:7px; font-size:10px; color:#333; border-bottom:1px solid #e5e7eb; }
                .modern-table tr:nth-child(even) { background:#f9f9f9; }
                .modern-table tr:nth-child(odd) { background:#ffffff; }
                .modern-header { margin:20px 0 10px 0; font-weight:bold; color:#2C6E49; font-size:14px; }
            </style>
        </head>
        <body>
            <div style="text-align:center; margin-bottom:10px;">
                <img src="' . $logoPath . '" width="120">
            </div>

            <div style="margin-bottom:20px; text-align:start;">
                <h2 style="color:#2c6e49; margin-bottom:5px;">Financial Reports</h2>
                <p style="color:#555; margin-top:-5px;">Overview of grants, disbursements, and budget utilization</p>
            </div>

            <!-- SUMMARY CARDS -->
            <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
                <tr>
                    <td class="card" style="border-top:4px solid #2C6E49;">
                        <h3>Overall Budget</h3>
                        <p>₱ ' . number_format($combinedTotalValue,2) . '</p>
                    </td>
                    <td class="card" style="border-top:4px solid #2C6E49;">
                        <h3>Total Grants Released</h3>
                        <p>₱ ' . number_format($totalGrantsReleased,2) . '</p>
                    </td>
                    <td class="card" style="border-top:4px solid #2C6E49;">
                        <h3>Budget Utilization</h3>
                        <p>' . $budgetUtilization . '%</p>
                    </td>
                    <td class="card" style="border-top:4px solid #2C6E49;">
                        <h3>Pending Disbursements</h3>
                        <p>₱ ' . number_format($pendingDisbursements,2) . '</p>
                    </td>
                </tr>
            </table>

            <!-- BUDGET ALLOCATION CHART -->
            <div style="margin-bottom:20px;">
                <h3 style="color:#2C6E49; font-weight:bold; margin-bottom:10px;">Budget Allocation Overview</h3>';

        $colors = ['#2C6E49', '#4CAF50', '#1E88E5', '#FFC107'];
        $i = 0;
        foreach ($budgetData as $label => $value) {
            $percent = ($value / max($maxValue, 1)) * 100;
            $displayValue = str_contains($label, 'Utilization') ? $value.'%' : '₱ '.number_format($value,2);
            $color = $colors[$i % count($colors)];

            $html .= '
            <div style="margin-bottom:8px;">
                <div style="display:flex; justify-content:space-between; font-size:10px; margin-bottom:3px; color:#2C6E49;">
                    <span>'.$label.'</span>
                    <span>'.$displayValue.'</span>
                </div>
                <div style="background:#e5e7eb; border-radius:6px; height:18px; width:100%;">
                    <div style="width:'.$percent.'%; background:'.$color.'; height:100%; border-radius:6px;"></div>
                </div>
            </div>';
            $i++;
        }

        $html .= '</div>';

        // --- FINANCIAL TRANSACTIONS TABLE ---
        $html .= '
            <div class="section">
                <h3 class="modern-header">Recent Financial Transactions</h3>
                <table class="modern-table" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($transactions as $t) {
            $color = match($t['status']) {
                'Released' => '#2C6E49',
                'Pending' => '#FFC107',
                'Approved' => '#1E88E5',
                'Rejected' => '#FF3B30',
                default => '#333'
            };
            $html .= '<tr>
                <td>' . $t['transaction_id'] . '</td>
                <td>' . $t['type'] . '</td>
                <td style="font-weight:bold; color:' . $color . ';">' . (str_contains($t['type'],'Utilization') ? $t['amount'].'%' : '₱ '.number_format($t['amount'],2)) . '</td>
                <td>' . $t['date'] . '</td>
                <td style="font-weight:bold; color:' . $color . ';">' . $t['status'] . '</td>
            </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>

            <p style="margin-top:15px;">Latest as of ' . now()->format('F d, Y') . '</p>
        </body>
        </html>';

        // --- GENERATE PDF ---
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'landscape');
        return $pdf->download('swisa_financial_report_' . now()->format('Ymd_His') . '.pdf');
    }

public function exportFinancialCsv()
{
    $totalGrantsReleased = $this->totalGrantsReleased() ?? 0;
    $combinedTotalValue = $this->overAllBudget() ?? 0;
    $budgetUtilization = $this->budgetUtilization() ?? 0;
    $pendingDisbursements = $this->pendingDisbursements() ?? 0;
    $transactions = $this->recentTransactions() ?? [];

    $filename = 'swisa_financial_report_' . now()->format('Ymd_His') . '.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function() use ($totalGrantsReleased, $combinedTotalValue, $budgetUtilization, $pendingDisbursements, $transactions) {
        $file = fopen('php://output', 'w');

        // Title
        fputcsv($file, ['SwisaAGAP Financial Report']);
        fputcsv($file, []);

        // Summary
        fputcsv($file, ['Overall Budget', '₱ ' . number_format($combinedTotalValue,2)]);
        fputcsv($file, ['Total Grants Released', '₱ ' . number_format($totalGrantsReleased,2)]);
        fputcsv($file, ['Budget Utilization', $budgetUtilization . '%']);
        fputcsv($file, ['Pending Disbursements', '₱ ' . number_format($pendingDisbursements,2)]);
        fputcsv($file, []);

        // Transactions
        fputcsv($file, ['Recent Financial Transactions']);
        fputcsv($file, ['Transaction ID', 'Type', 'Amount', 'Date', 'Status']);
        foreach ($transactions as $t) {
            fputcsv($file, [
                $t['transaction_id'],
                $t['type'],
                '₱ ' . number_format($t['amount'], 2),
                $t['date'],
                $t['status']
            ]);
        }

        fputcsv($file, []);
        fputcsv($file, ['Latest as of ' . now()->format('F d, Y')]);
        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}
public function exportFinancialExcel()
{
    $totalGrantsReleased = $this->totalGrantsReleased() ?? 0;
    $combinedTotalValue = $this->overAllBudget() ?? 0;
    $budgetUtilization = $this->budgetUtilization() ?? 0;
    $pendingDisbursements = $this->pendingDisbursements() ?? 0;
    $transactions = $this->recentTransactions() ?? [];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $row = 1;

    // Title
    $sheet->setCellValue('A' . $row++, 'SwisaAGAP Financial Report');
    $row++; // blank row

    // Summary
    $sheet->setCellValue('A' . $row, 'Overall Budget');
    $sheet->setCellValue('B' . $row++, '₱ ' . number_format($combinedTotalValue,2));

    $sheet->setCellValue('A' . $row, 'Total Grants Released');
    $sheet->setCellValue('B' . $row++, '₱ ' . number_format($totalGrantsReleased,2));

    $sheet->setCellValue('A' . $row, 'Budget Utilization');
    $sheet->setCellValue('B' . $row++, $budgetUtilization . '%');

    $sheet->setCellValue('A' . $row, 'Pending Disbursements');
    $sheet->setCellValue('B' . $row++, '₱ ' . number_format($pendingDisbursements,2));

    $row++; // blank row

    // Transactions
    $sheet->setCellValue('A' . $row++, 'Recent Financial Transactions');
    $sheet->fromArray([
        ['Transaction ID', 'Type', 'Amount', 'Date', 'Status']
    ], null, 'A' . $row++);

    foreach ($transactions as $t) {
        $sheet->fromArray([
            $t['transaction_id'],
            $t['type'],
            '₱ ' . number_format($t['amount'], 2),
            $t['date'],
            $t['status']
        ], null, 'A' . $row++);
    }

    $row++; // blank row
    $sheet->setCellValue('A' . $row, 'Latest as of ' . now()->format('F d, Y'));

    // Output Excel
    $filename = 'swisa_financial_report_' . now()->format('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

}
