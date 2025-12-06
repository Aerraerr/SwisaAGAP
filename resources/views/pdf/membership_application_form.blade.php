<!DOCTYPE html>
<html>
<head>
    <title>SWISA-AGAP Membership Application Form</title>
    {{-- Inline CSS is crucial for reliable PDF generation (Dompdf/Laravel-Dompdf) --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        /* Header and Separator Styles */
        .app-title { font-size: 18pt; color: #4C956C; margin: 0; }
        .dept-info { font-size: 10pt; color: #555; margin-top: 2px; }
        .section-header { 
            font-size: 12pt; 
            font-weight: bold; 
            color: #2C6E49; 
            border-bottom: 2px solid #ccc; 
            padding-bottom: 3px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        /* Data Presentation Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 5px 0;
            vertical-align: top;
            width: 50%; /* Two columns per row */
        }
        .data-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 120px; /* Fixed width for label alignment */
        }
        .data-value {
            border-bottom: 1px dashed #bbb;
            display: inline-block;
            min-width: 250px;
            padding-left: 5px;
            font-weight: normal;
        }
        .full-width .data-value { min-width: 80%; }
        /* Footer and Declaration */
        .declaration-box { 
            border: 1px solid #ddd; 
            padding: 10px; 
            margin-top: 30px; 
            font-size: 9pt; 
            background-color: #f9f9f9;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 40px;
            text-align: center;
            font-size: 9pt;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <table style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="width: 70%;">
                    <h1 class="app-title">SWISA-AGAP Membership Application</h1>
                    <p class="dept-info">Department of Agriculture, Small Water Irrigation System Association Federation</p>
                    <p style="font-size: 9pt; color: #888; margin-top: 5px;">Application ID: {{ $application->id ?? 'N/A' }} | Status: {{ ucfirst($application->status->status_name ?? 'Pending') }}</p>
                </td>
                <td style="width: 30%; text-align: right;">
                    {{-- Placeholder for Logo or Picture --}}
                                    </td>
            </tr>
        </table>
        
        <div class="section-header">A. PERSONAL INFORMATION</div>
        <table class="data-table">
            <tr>
                <td><span class="data-label">Full Name:</span><span class="data-value">
                    {{ $application->user->user_info->fname ?? '' }} {{ $application->user->user_info->mname ?? '' }} {{ $application->user->user_info->lname ?? '' }} {{ $application->user->user_info->suffix ?? '' }}
                </span></td>
                <td><span class="data-label">Date of Birth:</span><span class="data-value">
                    {{ $application->user->user_info->birthdate ?? '-' }}
                </span></td>
            </tr>
            <tr>
                <td><span class="data-label">Sex:</span><span class="data-value">
                    {{ ucfirst($application->user->user_info->gender ?? '-') }}
                </span></td>
                <td><span class="data-label">Civil Status:</span><span class="data-value">
                    {{ ucfirst($application->user->user_info->civil_status ?? '-') }}
                </span></td>
            </tr>
            <tr class="full-width">
                <td colspan="2"><span class="data-label">Address:</span><span class="data-value" style="min-width: 600px;">
                    Purok {{ $application->user->user_info->zone ?? '' }}, Brgy. {{ $application->user->user_info->barangay ?? '' }}, 
                    {{ $application->user->user_info->city ?? '' }}, {{ $application->user->user_info->province ?? '' }}
                </span></td>
            </tr>
            <tr>
                <td><span class="data-label">Contact No.:</span><span class="data-value">
                    {{ $application->user->phone_number ?? '-' }}
                </span></td>
                <td><span class="data-label">Email:</span><span class="data-value">
                    {{ $application->user->email ?? '-' }}
                </span></td>
            </tr>
        </table>

        <div class="section-header">B. SECONDARY CONTACT</div>
        <table class="data-table">
            <tr>
                <td><span class="data-label">Contact Name:</span><span class="data-value">
                    {{ $application->user->user_info->sc_fname ?? '' }} {{ $application->user->user_info->sc_mname ?? '' }} {{ $application->user->user_info->sc_lname ?? '' }} {{ $application->user->user_info->sc_suffix ?? '' }}
                </span></td>
                <td><span class="data-label">Relationship:</span><span class="data-value">
                    {{ ucfirst($application->user->user_info->relationship ?? '-') }}
                </span></td>
            </tr>
            <tr class="full-width">
                <td colspan="2"><span class="data-label">Address:</span><span class="data-value" style="min-width: 600px;">
                    Purok {{ $application->user->user_info->sc_zone ?? '' }}, Brgy. {{ $application->user->user_info->sc_barangay ?? '' }}, 
                    {{ $application->user->user_info->sc_city ?? '' }}, {{ $application->user->user_info->sc_province ?? '' }}
                </span></td>
            </tr>
            <tr>
                <td><span class="data-label">Contact No.:</span><span class="data-value">
                    {{ $application->user->user_info->sc_phone_no ?? '-' }}
                </span></td>
                <td><span class="data-label">Email:</span><span class="data-value">
                    {{ $application->user->user_info->sc_email ?? '-' }}
                </span></td>
            </tr>
        </table>
        
        <div class="section-header">C. AGRICULTURE / LIVELIHOOD INFORMATION</div>
        <table class="data-table">
            <tr>
                <td><span class="data-label">Sector:</span><span class="data-value">
                    {{ $application->user->user_info->sector->sector_name ?? '-' }}
                </span></td>
                <td><span class="data-label">Farm Location:</span><span class="data-value">
                    {{ $application->user->user_info->farm_location ?? '-' }}
                </span></td>
            </tr>
            <tr>
                <td><span class="data-label">Land Size:</span><span class="data-value">
                    {{ $application->user->user_info->land_size ?? '-' }}
                </span></td>
                <td><span class="data-label">Water Source:</span><span class="data-value">
                    {{ $application->user->user_info->water_source ?? '-' }}
                </span></td>
            </tr>
            <tr class="full-width">
                <td colspan="2"><span class="data-label">Purpose:</span><span class="data-value" style="min-width: 600px;">
                    {{ $application->purpose ?? 'N/A' }}
                </span></td>
            </tr>
        </table>

        <div class="section-header">D. REQUIREMENTS CHECKLIST</div>
        <div style="padding-left: 10px;">
            @forelse($application->documents as $doc)
                <p style="margin-bottom: 2px;">
                    <span style="font-weight: bold; color: #4C956C;">&#10003;</span> 
                    {{ $doc->membershipRequirement->requirement_name ?? 'Document Attached' }}
                </p>
            @empty
                <p style="color: red;">No documents were attached to this application record.</p>
            @endforelse
        </div>
        
        <div class="declaration-box">
            <p style="font-weight: bold; margin-bottom: 5px;">DECLARATION</p>
            <p style="margin-bottom: 10px;">I hereby certify that the information provided above is true and correct to the best of my knowledge. I understand that any false statement or misrepresentation shall be grounds for disqualification or termination of membership in SWISA-AGAP.</p>
        </div>

        <table style="width: 100%; margin-top: 50px;">
            <tr>
                <td style="width: 50%;">
                    <p class="signature-line">Applicant's Signature Over Printed Name</p>
                </td>
                <td style="width: 50%; text-align: right;">
                    <p class="signature-line">Date Submitted: {{ $application->created_at->format('F d, Y') }}</p>
                </td>
            </tr>
        </table>
        
    </div>
</body>
</html>