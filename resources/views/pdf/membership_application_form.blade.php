<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWISA-AGAP Application Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .section-header { font-size: 16px; font-weight: bold; border-bottom: 1px solid #ccc; margin-bottom: 10px; padding-bottom: 3px; }
        .label { font-weight: 600; }
        .value { color: #111; }
    </style>
</head>
<body class="p-8 bg-white">

    <div class="text-center mb-6">
        <h1 class="text-xl font-bold">Department of Agriculture</h1>
        <h2 class="text-lg font-semibold text-blue-700">Small Water Irrigation System Association Federation</h2>
        <p class="text-sm text-red-600 mt-2">IMPORTANT: PLEASE READ GENERAL INSTRUCTIONS BEFORE FILLING OUT THE FORM</p>
    </div>

    <section class="mb-6">
        <h3 class="section-header">REQUEST FOR</h3>
        <p><span class="label">Application Type:</span> 
            <span class="value">{{ ucfirst($application->application_type ?? 'Membership') }}</span>
        </p>
    </section>

    <section class="mb-6">
        <h3 class="section-header">PERSONAL INFORMATION</h3>
        <div class="grid grid-cols-2 gap-2">
            <p><span class="label">Full Name:</span> 
                <span class="value">{{ $application->user->user_info->fname ?? '' }} {{ $application->user->user_info->mname ?? '' }} {{ $application->user->user_info->lname ?? '' }} {{ $application->user->user_info->suffix ?? '' }}</span>
            </p>
            <p><span class="label">Date of Birth:</span> 
                <span class="value">{{ $application->user->user_info->birthdate ?? '' }}</span>
            </p>
            <p><span class="label">Sex:</span> 
                <span class="value">{{ ucfirst($application->user->user_info->gender ?? '') }}</span>
            </p>
            <p><span class="label">Civil Status:</span> 
                <span class="value">{{ ucfirst($application->user->user_info->civil_status ?? '') }}</span>
            </p>
            <p><span class="label">Contact Number:</span> 
                <span class="value">{{ $application->user->user_info->contact_no ?? '' }}</span>
            </p>
            <p><span class="label">Email:</span> 
                <span class="value">{{ $application->user->email ?? '' }}</span>
            </p>
            <p class="col-span-2"><span class="label">Address:</span> 
                <span class="value">
                    {{ $application->user->user_info->zone ?? '' }},
                    {{ $application->user->user_info->barangay ?? '' }},
                    {{ $application->user->user_info->city ?? '' }},
                    {{ $application->user->user_info->province ?? '' }}
                </span>
            </p>
        </div>
    </section>

    <section class="mb-6">
        <h3 class="section-header">SECONDARY CONTACT</h3>
        <div class="grid grid-cols-2 gap-2">
            <p><span class="label">Full Name:</span>
                <span class="value">{{ $application->user->user_info->sc_fname ?? '' }} {{ $application->user->user_info->sc_mname ?? '' }} {{ $application->user->user_info->sc_lname ?? '' }} {{ $application->user->user_info->sc_suffix ?? '' }}</span>
            </p>
            <p><span class="label">Relationship:</span> 
                <span class="value">{{ $application->user->user_info->relationship ?? '' }}</span>
            </p>
            <p><span class="label">Contact Number:</span> 
                <span class="value">{{ $application->user->user_info->sc_contact_no ?? '' }}</span>
            </p>
            <p><span class="label">Email:</span> 
                <span class="value">{{ $application->user->user_info->sc_email ?? '' }}</span>
            </p>
        </div>
    </section>

    <section class="mb-6">
        <h3 class="section-header">AGRICULTURE / LIVELIHOOD INFORMATION</h3>
        <div class="grid grid-cols-2 gap-2">
            <p><span class="label">Sector:</span> 
                <span class="value">{{ $application->user->user_info->sector->sector_name ?? '-' }}</span>
            </p>
            <p><span class="label">Farm Location:</span> 
                <span class="value">{{ $application->user->user_info->farm_location ?? '' }}</span>
            </p>
            <p><span class="label">Land Size:</span> 
                <span class="value">{{ $application->user->user_info->land_size ?? '' }}</span>
            </p>
            <p><span class="label">Water Source:</span> 
                <span class="value">{{ $application->user->user_info->water_source ?? '' }}</span>
            </p>
        </div>
    </section>

    <section class="mb-6">
        <h3 class="section-header">PURPOSE OF MEMBERSHIP</h3>
        <p><span class="value">{{ $application->purpose ?? '-' }}</span></p>
    </section>

    <section class="mb-6">
        <h3 class="section-header">REQUIREMENTS ATTACHED</h3>
        <ul>
            @foreach($application->documents as $doc)
                <li>{{ $doc->file_name }}</li>
            @endforeach
        </ul>
    </section>

    <section class="mb-6">
        <h3 class="section-header">STATUS</h3>
        <p><span class="label">Application Status:</span> 
            <span class="value">{{ ucfirst($application->status->status_name ?? 'Pending') }}</span>
        </p>
    </section>

    <footer class="text-center mt-8 text-sm text-gray-500">
        <p>Generated on {{ now()->format('F d, Y h:i A') }}</p>
        <p>SWISA-AGAP Membership Application Form</p>
    </footer>

</body>
</html>
