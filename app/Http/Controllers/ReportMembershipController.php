<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\Log;
use App\Models\Sector;
use Carbon\Carbon;



class ReportMembershipController extends Controller
{
    public function index()
    {
        // Total members
        $totalMembers = UserInfo::count();

        // New members this month
        $newMembers = UserInfo::whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->count();

        // Last month members (optional for comparison)
        $lastMonth = Carbon::now()->subMonth();
        $lastMonthMembers = UserInfo::whereMonth('created_at', $lastMonth->month)
                                    ->whereYear('created_at', $lastMonth->year)
                                    ->count();

        if ($lastMonthMembers === 0 && $newMembers > 0) {
            $newMembersChange = 100;
        } elseif ($lastMonthMembers === 0 && $newMembers === 0) {
            $newMembersChange = 0;
        } else {
            $newMembersChange = $lastMonthMembers === 0 ? 0 : round((($newMembers - $lastMonthMembers) / $lastMonthMembers) * 100);
        }

        // Active members (unique user_id who logged in last 30 days)
        $activeMembersCount = Log::where('activity', 'Logged In')
                                 ->where('activity_timestamp', '>=', Carbon::now()->subDays(30))
                                 ->distinct('user_id')
                                 ->count('user_id');

        $activeMembers = $totalMembers ? round(($activeMembersCount / $totalMembers) * 100) : 0;

        // All members list
        $members = UserInfo::orderBy('created_at', 'desc')->get();

        // --- Sector labels & counts for chart ---
        $sectors = Sector::orderBy('id')->get();
        if ($sectors->isEmpty()) {
            $sectorLabels = collect(['Agriculture','Fisheries','Livestock','Forestry','Agri-Business']);
            $sectorCounts = $sectorLabels->map(fn($s) => UserInfo::where('farmer_type', $s)->count());
        } else {
            $sectorLabels = $sectors->pluck('name');
            $sectorCounts = $sectors->map(fn($sector) => UserInfo::where('farmer_type', $sector->name)->count());
        }

        return view('swisa-admin.admin-reports.membership', compact(
            'totalMembers',
            'newMembers',
            'newMembersChange',
            'activeMembers',
            'members',
            'sectorLabels',
            'sectorCounts'
        ));
    }

    // ---------------------------
    // Member Demographics Method
    // ---------------------------
    public function memberDemographic()
    {
        $members = UserInfo::all();

        // Gender counts
        $maleCount = $members->whereIn('gender', ['Male','male','MALE'])->count();
        $femaleCount = $members->whereIn('gender', ['Female','female','FEMALE'])->count();

        $totalGender = $maleCount + $femaleCount;

        // Gender percentages
        $malePercent = $totalGender > 0 ? round(($maleCount / $totalGender) * 100) : 0;
        $femalePercent = $totalGender > 0 ? round(($femaleCount / $totalGender) * 100) : 0;

        // Age groups (calculated from birthdate)
        $age18_25 = $members->filter(fn($u) => Carbon::parse($u->birthdate)->age >= 18 && Carbon::parse($u->birthdate)->age <= 25)->count();
        $age26_30 = $members->filter(fn($u) => Carbon::parse($u->birthdate)->age >= 26 && Carbon::parse($u->birthdate)->age <= 30)->count();
        $age30plus = $members->filter(fn($u) => Carbon::parse($u->birthdate)->age > 30)->count();

        $ageTotal = $age18_25 + $age26_30 + $age30plus;

        return [
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,
            'malePercent' => $malePercent,
            'femalePercent' => $femalePercent,
            'age18_25' => $age18_25,
            'age26_30' => $age26_30,
            'age30plus' => $age30plus,
            'ageTotal' => $ageTotal,
        ];
    }
// ---------------------------
// Active Members Method (latest login per user)
// ---------------------------
public function activeMembers()
{
    $totalMembers = UserInfo::count();

    // Get all users' latest login timestamp where role is 'Member'
    $latestLogins = Log::select('user_id', \DB::raw('MAX(activity_timestamp) as latest_login'))
                        ->where('activity', 'Logged In')
                        ->where('role', 'Member') // Only consider Member role
                        ->groupBy('user_id')
                        ->get();

    // Count how many of these latest logins are within the last 30 days
    $activeMembersCount = $latestLogins->filter(function ($log) {
        return Carbon::parse($log->latest_login)->greaterThanOrEqualTo(Carbon::now()->subDays(30));
    })->count();

    // Calculate percentage
    $activeMembersPercent = $totalMembers > 0 ? round(($activeMembersCount / $totalMembers) * 100) : 0;

    return [
        'activeMembersCount' => $activeMembersCount,
        'activeMembersPercent' => $activeMembersPercent
    ];
}


public function exportCsv()
{
    $members = UserInfo::all();

    // Get active members percentage
    $activeData = $this->activeMembers();

    // Member type counts
    $memberTypes = $members->groupBy('farmer_type')->map->count();

    $filename = 'swisa_membership_report_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function() use ($members, $activeData, $memberTypes) {
        $file = fopen('php://output', 'w');

        // -------------------------------
        // Top: SwisaAGAP text
        // -------------------------------
        fputcsv($file, ['SwisaAGAP']);
        fputcsv($file, []); // blank row for spacing

        // Total Members
        fputcsv($file, ['Total Members', count($members)]);
        fputcsv($file, ['Active Members', $activeData['activeMembersPercent'] . '%']);
        fputcsv($file, []);

        // Member Type
        fputcsv($file, ['Member Types']);
        foreach ($memberTypes as $type => $count) {
            fputcsv($file, [$type ?? '-', $count]);
        }
        fputcsv($file, []);

        // Member Demographics
        fputcsv($file, ['Member Demographics']);
        $demographics = $this->memberDemographic();
        fputcsv($file, ['Male', $demographics['maleCount']]);
        fputcsv($file, ['Female', $demographics['femaleCount']]);
        fputcsv($file, ['Age 18-25', $demographics['age18_25']]);
        fputcsv($file, ['Age 26-30', $demographics['age26_30']]);
        fputcsv($file, ['Age 30+', $demographics['age30plus']]);
        fputcsv($file, []);

        // All registered members
        fputcsv($file, ['All Registered Members']);
        fputcsv($file, ['Name', 'Address', 'Email', 'Contact Number', 'Type', 'ID Number', 'Registered Since']);
        foreach ($members as $member) {
            $address = trim(
                ($member->house_no ? '#' . $member->house_no . ', ' : '') .
                ($member->barangay ?? '') .
                ($member->zone ? ', Zone ' . $member->zone : '') .
                ($member->city ? ', ' . $member->city : '')
            );
            $name = $member->name ?? trim($member->fname . ' ' . $member->mname . ' ' . $member->lname);
            fputcsv($file, [
                $name ?: '-',
                $address ?: '-',
                $member->email ?: '-',
                $member->phone_no ?: '-',
                $member->farmer_type ?: '-',
                $member->formatted_id ?: '-',
                optional($member->created_at)->format('F d, Y') ?: '-',
            ]);
        }

        // -------------------------------
        // Bottom: Latest as of current date
        // -------------------------------
        fputcsv($file, []);
        fputcsv($file, ['Latest as of ' . now()->format('F d, Y')]);

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}



public function exportExcel()
{
    $members = UserInfo::all();
    $activeData = $this->activeMembers();
    $memberTypes = $members->groupBy('farmer_type')->map->count();
    $demographics = $this->memberDemographic();

    // Create new spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $row = 1;

    // Top: SwisaAGAP text
    $sheet->setCellValue('A' . $row++, 'SwisaAGAP');
    $row++; // blank row

    // Total & Active Members
    $sheet->setCellValue('A' . $row, 'Total Members');
    $sheet->setCellValue('B' . $row++, count($members));

    $sheet->setCellValue('A' . $row, 'Active Members');
    $sheet->setCellValue('B' . $row++, $activeData['activeMembersPercent'] . '%');
    $row++; // blank row

    // Member Types
    $sheet->setCellValue('A' . $row++, 'Member Types');
    foreach ($memberTypes as $type => $count) {
        $sheet->setCellValue('A' . $row, $type ?? '-');
        $sheet->setCellValue('B' . $row++, $count);
    }
    $row++; // blank row

    // Member Demographics
    $sheet->setCellValue('A' . $row++, 'Member Demographics');
    $sheet->setCellValue('A' . $row, 'Male');
    $sheet->setCellValue('B' . $row++, $demographics['maleCount']);
    $sheet->setCellValue('A' . $row, 'Female');
    $sheet->setCellValue('B' . $row++, $demographics['femaleCount']);
    $sheet->setCellValue('A' . $row, 'Age 18-25');
    $sheet->setCellValue('B' . $row++, $demographics['age18_25']);
    $sheet->setCellValue('A' . $row, 'Age 26-30');
    $sheet->setCellValue('B' . $row++, $demographics['age26_30']);
    $sheet->setCellValue('A' . $row, 'Age 30+');
    $sheet->setCellValue('B' . $row++, $demographics['age30plus']);
    $row++; // blank row

    // All Registered Members Table
    $sheet->setCellValue('A' . $row, 'All Registered Members');
    $row++;
    $sheet->fromArray([
        ['Name','Address','Email','Contact Number','Type','ID Number','Registered Since']
    ], null, 'A' . $row++);
    
    foreach ($members as $member) {
        $address = trim(
            ($member->house_no ? '#' . $member->house_no . ', ' : '') .
            ($member->barangay ?? '') .
            ($member->zone ? ', Zone ' . $member->zone : '') .
            ($member->city ? ', ' . $member->city : '')
        );
        $name = $member->name ?? trim($member->fname . ' ' . $member->mname . ' ' . $member->lname);
        $sheet->fromArray([
            $name ?: '-',
            $address ?: '-',
            $member->email ?: '-',
            $member->phone_no ?: '-',
            $member->farmer_type ?: '-',
            $member->formatted_id ?: '-',
            optional($member->created_at)->format('F d, Y') ?: '-',
        ], null, 'A' . $row++);
    }

    // Latest as of current date
    $row++;
    $sheet->setCellValue('A' . $row, 'Latest as of ' . now()->format('F d, Y'));

    // Output file
    $filename = 'swisa_membership_report_' . now()->format('Ymd_His') . '.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}




public function exportPdf()
{
    $members = UserInfo::all();
    $activeData = $this->activeMembers();
    $memberTypes = $members->groupBy('farmer_type')->map->count();
    $demographics = $this->memberDemographic();

    $newMembers = UserInfo::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count();

    $logoPath = public_path('images/swisa-agap5.png');

    $html = '
    <html>
    <head>
        <meta charset="utf-8">
        <title>SwisaAGAP Membership Report</title>

        <style>
            body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin:0; padding:0; }

            /* Modern Table */
            .modern-table th {
                background:#2C6E49;
                color:white;
                padding:8px;
                font-size:11px;
                text-align:left;
            }
            .modern-table td {
                padding:7px;
                font-size:10px;
                color:#333;
                border-bottom:1px solid #e5e7eb;
            }
            .modern-table tr:nth-child(even) { 
                background:#f9f9f9;
            }
            .modern-table tr:nth-child(odd) {
                background:#ffffff;
            }
            .modern-header {
                margin:20px 0 10px 0;
                font-weight:bold;
                color:#2C6E49;
                font-size:14px;
            }
        </style>

    </head>
    <body>

        <div class="logo" style="text-align:center; ">
            <img src="' . $logoPath . '" width="120">
        </div>

        <div class="header" style="margin-bottom:10px;">
            <h2 style="color:#2c6e49; margin-bottom:5px;">Membership Reports</h2>
            <p style="color:#555; margin-top:-5px;">Overview of registered members and demographics</p>
        </div>

        <!-- SUMMARY CARDS -->
        <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
            <tr>
                <td style="width:33%; padding:10px; text-align:center; background:white; border:none; border-top:4px solid #2C6E49;">
                    <h3 style="color:#2C6E49;">Total Members</h3>
                    <p style="font-size:22px; color:#2C6E49; font-weight:bold;">' . count($members) . '</p>
                </td>
                <td style="width:33%; padding:10px; text-align:center; background:white; border:none; border-top:4px solid #2C6E49;">
                    <h3 style="color:#2C6E49;">New Members (This Month)</h3>
                    <p style="font-size:22px; color:#2C6E49; font-weight:bold;">' . $newMembers . '</p>
                </td>
                <td style="width:33%; padding:10px; text-align:center; background:white; border:none; border-top:4px solid #2C6E49;">
                    <h3 style="color:#2C6E49;">Active Members</h3>
                    <p style="font-size:22px; color:#2C6E49; font-weight:bold;">' . $activeData['activeMembersPercent'] . '%</p>
                </td>
            </tr>
        </table>

        <!-- MEMBER TYPES + DEMOGRAPHICS -->
        <div style="margin-bottom:20px;">
            <table style="width:100%; border-collapse:collapse;">
                <tr>

                    <!-- MEMBER TYPES -->
                    <td style="width:50%; vertical-align:top; padding-right:10px;">
                        <h3 style="color:#2C6E49; font-weight:bold;">Member Types</h3>

                        <table style="width:100%; margin-top:8px;">
                            <tbody>';

                            foreach ($memberTypes as $type => $count) {
                                $percent = round($count / max(array_sum($memberTypes->toArray()),1) * 100);

                                $html .= '
                                <tr>
                                    <td style="width:20%; padding:5px; font-size:10px;">' . ($type ?? '-') . '</td>
                                    <td style="width:80%; padding:5px;">
                                        <div style="width:100%; background:white; border-radius:5px;">
                                            <div style="width:' . $percent . '%; background:#bae3cc; padding:4px; text-align:right; font-weight:bold; color:#2C6E49; border-radius:5px;">
                                                <span style="font-size:10px;">' . $count . '</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>';
                            }

            $html .= '
                            </tbody>
                        </table>
                    </td>


                    <!-- DEMOGRAPHICS -->
                    <td style="width:50%; vertical-align:top; padding-left:10px;">
                        <h3 style="color:#2C6E49; font-weight:bold;">Member Demographics</h3>

                        <table style="width:100%; margin-top:8px;">';

                        foreach ([
                            'Male'       => 'malePercent',
                            'Female'     => 'femalePercent',
                            '18–25'      => 'age18_25',
                            '26–30'      => 'age26_30',
                            '30+'        => 'age30plus'
                        ] as $label => $key) {

                            $value = $demographics[$key];

                            $html .= '
                            <tr>
                                <td style="width:20%; padding:5px; font-weight:bold; color:#2C6E49;">' . $label . '</td>
                                <td style="width:80%; padding:5px;">
                                    <div style="width:100%; background:white; border-radius:5px;">
                                        <div style="width:' . $value . '%; background:#bae3cc; padding:4px; text-align:right; color:#2C6E49; font-weight:bold; border-radius:5px;">
                                            <span style="font-size:10px;">' . $value . '%</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                        }

            $html .= '
                        </table>
                    </td>

                </tr>
            </table>
        </div>


        <!-- MODERN REGISTERED MEMBERS TABLE -->
        <div class="section">
            <h3 class="modern-header">Registered Members</h3>

            <table class="modern-table" style="width:100%; border-collapse:collapse;">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Type</th>
                        <th>ID Number</th>
                        <th>Registered Since</th>
                    </tr>
                </thead>

                <tbody>';

                foreach ($members as $member) {

                    $address = trim(
                        ($member->house_no ? '#' . $member->house_no . ', ' : '') .
                        ($member->barangay ?? '') .
                        ($member->zone ? ', Zone ' . $member->zone : '') .
                        ($member->city ? ', ' . $member->city : '')
                    );

                    $name = $member->name ?? trim($member->fname . ' ' . $member->mname . ' ' . $member->lname);

                    $html .= '
                    <tr>
                        <td>' . ($name ?: '-') . '</td>
                        <td>' . ($address ?: '-') . '</td>
                        <td>' . ($member->email ?: '-') . '</td>
                        <td>' . ($member->phone_no ?: '-') . '</td>
                        <td style="color:#2C6E49; font-weight:bold;">' . ($member->farmer_type ?: '-') . '</td>
                        <td style="font-weight:bold;">' . ($member->formatted_id ?: '-') . '</td>
                        <td>' . optional($member->created_at)->format('F d, Y') . '</td>
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
    return $pdf->download('swisa_membership_report_' . now()->format('Ymd_His') . '.pdf');
}



}
