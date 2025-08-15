<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SwisaAGAP</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .bg-light-green {
            background-color: #e0f2f1;
        }
        .text-dark-green {
            color: #1a7867;
        }
        .curved-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 300px;
            background-color: white;
            border-top-left-radius: 50% 250px;
            border-top-right-radius: 50% 250px;
        }

        /* Animations */
        @keyframes popUp {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Logo animations */
        .swisa-logo {
            margin-top: -150px;
            margin-bottom: 40px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            animation: popUp 1s ease-out forwards;
        }
        .swisa-text {
            margin-top: -100px;
            opacity: 0;
            animation: fadeIn 1.5s ease-out forwards;
            animation-delay: 0.8s;
        }
        .swisa-p1 {
            font-size: 50px;
            color: #2C6E49;
        }
        .swisa-p2 {
            font-size: 100px;
            color: #2C6E49;
        }

        /* Powered by animation */
        .powered-by {
            opacity: 0;
            animation: popUp 1s ease-out forwards;
            animation-delay: 1.5s;
        }

        /* Spinning border exactly matching image */
        .loading-border {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .loading-border::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 5px solid transparent;
            border-top-color: #2C6E49;
            animation: spin 3s linear infinite;
            margin-top:-25px;
        }
    </style>
</head>
<body class="bg-light-green text-dark-green">

    <!-- Main container -->
    <div class="relative min-h-screen flex flex-col items-center justify-center p-6">

        <!-- Curved bottom shape -->
        <div class="curved-bg"></div>

        <!-- Main content -->
        <div class="z-10 flex flex-col items-center text-center">
                <div class="loading-border w-[300px] h-[300px] swisa-logo">
                    <img src="{{ asset('images/swisa-logo2.png') }}" alt="SWISA Logo" class=" w-[300px] h-[300px] object-contain rounded-full">
                </div>
            <div class="swisa-text font-extrabold text-5xl tracking-wide">
                <p class="swisa-p1">SWISA</p>
                <p class="swisa-p2">AGAP</p>
            </div>
        </div>
        <div class="powered-by z-10 absolute bottom-8 text-center text-sm">
            <p>POWERED BY</p>
            <div class="mt-2 w-[90px] h-[90px] mx-auto flex items-center justify-center rounded-full overflow-hidden">
                <img src="{{ asset('images/swisa-logo.png') }}" alt="SWISA Logo" class="w-full h-full object-contain">
            </div>
        </div>

    </div>
    <script>
        // Redirect to login page after 3 seconds
        setTimeout(function(){
            window.location.href = "{{ route('login') }}";
        }, 3000);
    </script>
</body>
</html>
