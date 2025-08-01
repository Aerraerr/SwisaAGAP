@extends('layouts.sidebar')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- External Fonts & CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fordashboard.css') }}">
</head>
<body>
    <h2 class="text-3xl font-bold mb-4 font-product text-custom">Dashboard</h2>
    <div class="py-12 font-product text-custom">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-customIT text-lg">
                    {{ __("Content here") }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
