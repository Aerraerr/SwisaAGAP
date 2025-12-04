<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportRequest;
use Illuminate\Support\Facades\DB;
use Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportRequestController extends Controller
{
    public function index()
    {
        $requests = ReportRequest::all();

        // Stats
        $total = $requests->count();
        $approved = $requests->where('status', 'Approved')->count();
        $pending = $requests->where('status', 'Pending')->count();
        $denied = $requests->where('status', 'Denied')->count();
        $approvalRate = $total ? round($approved / $total * 100, 2) : 0;

        return view('reports.requests', compact('requests', 'total', 'approved', 'pending', 'denied', 'approvalRate'));
    }
    public function requestStats()
    {
        // Base query for grant requests only
        $baseQuery = \App\Models\Application::where('application_type', 'Grant Application');

        $total = (clone $baseQuery)->count();

        $approved = (clone $baseQuery)->where('status_id', 4)->count();    // Approved
        $pending = (clone $baseQuery)->where('status_id', 3)->count();     // Pending
        $toBeReview = (clone $baseQuery)->where('status_id', 15)->count();  // To be review
        $rejected = (clone $baseQuery)->where('status_id', 6)->count();    // Rejected
        $released = (clone $baseQuery)->where('status_id', 5)->count();    // Released or Completed

        // Completed = Released
        $completed = $released;

        $approvalRate = $total ? round(($approved / $total) * 100, 2) : 0;

        return response()->json([
            'total' => $total,
            'approved' => $approved,
            'pending' => $pending,
            'toBeReview' => $toBeReview,
            'rejected' => $rejected,
            'released' => $released,
            'completed' => $completed,
            'approvalRate' => $approvalRate
        ]);
    }

    public function requestChartData(Request $request)
    {
        $year = $request->year ?? now()->year;

        // Filter only Grant Application
        $query = \App\Models\Application::where('application_type', 'Grant Application')
            ->whereYear('created_at', $year);

        // Group by month using new statuses
        $monthly = $query->selectRaw("
            MONTH(created_at) as month,
            SUM(CASE WHEN status_id = 5 THEN 1 ELSE 0 END) as completed,
            SUM(CASE WHEN status_id = 6 THEN 1 ELSE 0 END) as rejected
        ")
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Convert months for the chart
        $formatted = [];

        $months = [
            1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr",
            5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug",
            9 => "Sept", 10 => "Oct", 11 => "Nov", 12 => "Dec",
        ];

        foreach ($months as $num => $name) {
            $row = $monthly->firstWhere('month', $num);

            $formatted[] = [
                'month'     => $name,
                'completed' => $row->completed ?? 0,
                'rejected'  => $row->rejected ?? 0,
            ];
        }

        return response()->json($formatted);
    }
        // --------------------------
        // CSV Export
        // --------------------------
    public function exportCsv()
    {
        $requests = $this->recentGrantRequests() ?? [];
        $filename = 'swisa_requests_report_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($requests) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['SwisaAGAP Requests Report']);
            fputcsv($file, []);

            fputcsv($file, ['Request ID','Item','Requester','Date','Status']);

            foreach($requests as $r) {
                fputcsv($file, [
                    $r['request_id'],
                    $r['grant_title'],
                    $r['requester'],
                    $r['date'],
                    $r['status'],
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['Latest as of ' . now()->format('F d, Y')]);
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }


    // --------------------------
    // Excel Export
    // --------------------------
    public function exportExcel()
    {
        $requests = $this->recentGrantRequests() ?? [];
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $row = 1;

        // Title
        $sheet->setCellValue('A'.$row++, 'SwisaAGAP Requests Report');
        $row++; // blank row

        // Table header
        $sheet->fromArray([['Request ID','Item','Requester','Date','Status']], null, 'A'.$row++);

        // Rows
        foreach($requests as $r) {
            $sheet->fromArray([
                $r['request_id'],
                $r['grant_title'],
                $r['requester'],
                $r['date'],
                $r['status'],
            ], null, 'A'.$row++);
        }

        $row++; // blank row
        $sheet->setCellValue('A'.$row, 'Latest as of '.now()->format('F d, Y'));

        $filename = 'swisa_requests_report_' . now()->format('Ymd_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    // --------------------------
    // PDF Export
    // --------------------------
public function exportPdf()
{
    $requests = $this->recentGrantRequests() ?? collect(); // ensure it's a collection

    $logoPath = public_path('images/swisa-agap5.png');

    // --- HTML ---
    $html = '
    <html>
    <head>
        <meta charset="utf-8">
        <title>SwisaAGAP Requests Report</title>
        <style>
            body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin:0; padding:0; }
            .card { background:white; padding:10px; border-radius:8px; text-align:center; margin-bottom:10px; }
            .card h3 { color:#2C6E49; margin:5px 0; font-size:12px; }
            .card p { margin:0; font-weight:bold; font-size:14px; color:#2C6E49; }
            .modern-table th { background:#2C6E49; color:white; padding:8px; font-size:11px; text-align:left; }
            .modern-table td { padding:7px; font-size:10px; color:#333; border-bottom:1px solid #e5e7eb; }
            .modern-table tr:nth-child(even) { background:#f9f9f9; }
            .modern-table tr:nth-child(odd) { background:#ffffff; }
            .status-green { color:#2C6E49; font-weight:bold; }
            .status-yellow { color:#FFC107; font-weight:bold; }
            .status-red { color:#FF3B30; font-weight:bold; }
            .modern-header { margin:20px 0 10px 0; font-weight:bold; color:#2C6E49; font-size:14px; }
        </style>
    </head>
    <body>
        <div style="text-align:center; margin-bottom:10px;">
            <img src="' . $logoPath . '" width="120">
        </div>

        <div style="margin-bottom:20px; text-align:start;">
            <h2 style="color:#2c6e49; margin-bottom:5px;">Requests Reports</h2>
            <p style="color:#555; margin-top:-5px;">Track requests and their approval status</p>
        </div>

        <!-- STATS CARDS -->
        <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
            <tr>';

    // Calculate stats using Collection methods
    $total = $requests->count();
    $approved = $requests->filter(fn($r) => $r['status'] === 'Approved' || $r['status'] === 'Completed')->count();
    $pending = $requests->filter(fn($r) => $r['status'] === 'Pending' || $r['status'] === 'Processing Application')->count();
    $completed = $approved;
    $approvalRate = $total ? round(($approved / $total) * 100, 2) : 0;

    $stats = [
        ['label' => 'Completed Requests', 'value' => $completed, 'color' => '#2C6E49'], // green
        ['label' => 'Total Requests', 'value' => $total, 'color' => '#2C6E49'], // dark green
        ['label' => 'Approved Requests', 'value' => $approved, 'color' => '#2C6E49'], // blue
        ['label' => 'Pending Requests', 'value' => $pending, 'color' => '#2C6E49'], // yellow
    ];

    foreach ($stats as $s) {
        $html .= '
        <td class="card" style="border-top:4px solid ' . $s['color'] . ';">
            <h3>' . $s['label'] . '</h3>
            <p>' . $s['value'] . '</p>
        </td>';
    }

    $html .= '
            </tr>
        </table>

        <!-- REQUESTS TABLE -->
        <div class="section">
            <h3 class="modern-header">Recent Grant Requests</h3>
            <table class="modern-table" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Item</th>
                        <th>Requester</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($requests as $r) {
        $statusClass = match($r['status']) {
            'Approved', 'Completed' => 'status-green',
            'Pending', 'Processing Application' => 'status-yellow',
            'Rejected', 'Denied' => 'status-red',
            default => ''
        };

        $html .= '
        <tr>
            <td>' . $r['request_id'] . '</td>
            <td>' . $r['grant_title'] . '</td>
            <td>' . $r['requester'] . '</td>
            <td>' . $r['date'] . '</td>
            <td class="' . $statusClass . '">' . $r['status'] . '</td>
        </tr>';
    }

    $html .= '
                </tbody>
            </table>
        </div>

        <p style="margin-top:15px;">Latest as of ' . now()->format('F d, Y') . '</p>
    </body>
    </html>';

    $pdf = Pdf::loadHTML($html)->setPaper('A4', 'landscape');
    return $pdf->download('swisa_requests_report_' . now()->format('Ymd_His') . '.pdf');
}




    public function recentGrantRequests()
    {
        $requests = \DB::table('applications as a')
            ->join('grants as g', 'a.grant_id', '=', 'g.id')
            ->join('users as u', 'a.user_id', '=', 'u.id')
            ->where('a.application_type', 'Grant Application')
            ->select(
                \DB::raw("CONCAT('REQ-0000', a.id) as request_id"),
                'g.title as grant_title', // <-- use title instead of item
                \DB::raw("CONCAT(u.first_name, ' ', u.last_name) as requester"),
                'a.updated_at as date',
                'a.status_id'
            )
            ->orderBy('a.updated_at', 'desc')
            ->limit(1000)
            ->get()
            ->map(function ($r) {

                $status = (int) $r->status_id;

                $statusText = match($status) {
                    15 => 'Processing Application',
                    6 => 'Rejected',
                    5 => 'Completed',   // Released treated as Completed
                    4 => 'Approved',
                    3 => 'Pending',
                    default => 'Unknown',
                };

                return [
                    'request_id' => $r->request_id,
                    'grant_title' => $r->grant_title, // updated key
                    'requester' => $r->requester,
                    'date' => date('Y-m-d', strtotime($r->date)),
                    'status' => $statusText,
                ];
            });

        return $requests;
    }


}
