@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rebríček</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="{{ asset('css/Styly.css') }}" rel="stylesheet">
</head>

<body class="quiz" id = "vrchol" style="background-image: url('{{ asset('pozadie.png')}}');">
<h1 class="faq">Rebríček</h1>
<p class="faq">Na tejto stránke sa nachádza rebríček aktuálne najúspešenkších riešiteľov nášho quizu. Zobrazujú sa vždy prvé 3 miesta,
    spolu s menami víťazov a ich celkovou percentuálnou úspešnosťou riešení, ktorá sa udáva ako počet správne zodpovedaných otázok
    vydelený počtom správne zodpovedaných otázok. Lídrom gratulujeme.</p>

<br>
<div class="container">
    <div class="row justify-content-center">
        <!-- Druhe miesto -->
        <div class="col-2 col-sm-3 col-md-3 col-lg-2" style="margin-left: 10px; margin-top: 150px; border:6px solid white; height: 450px; background-color:lightgray">
            <p style="text-align: center; line-height: 100px; font-size: 1.2vw; font-weight: bold">2.miesto</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">{{ $prvi_traja['druhe_miesto'][0] }}</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">Úspešnosť : {{ $prvi_traja['druhe_miesto'][1] }}%</p>
        </div>
        <!-- Prve miesto -->
        <div class="col-2 col-sm-3 col-md-3 col-lg-2" style="margin-right: 10px; margin-left: 10px; border:6px solid white; height: 600px; background-color:white">
            <p style="text-align: center; line-height: 100px; font-size: 1.2vw; font-weight: bold">1.miesto</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">{{ $prvi_traja['prve_miesto'][0] }}</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">Úspešnosť : {{ $prvi_traja['prve_miesto'][1] }}%</p>
        </div>
        <!-- Tretie miesto -->
        <div class="col-2 col-sm-3 col-md-3 col-lg-2" style="margin-right: 10px; margin-top: 300px; border:6px solid white; height: 300px; background-color:grey">
            <p style="text-align: center; line-height: 100px; font-size: 1.2vw; font-weight: bold">3.miesto</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">{{ $prvi_traja['tretie_miesto'][0] }}</p>
            <p style="text-align: center; line-height: 30px; font-size: 0.9vw; font-weight: bold">Úspešnosť : {{ $prvi_traja['tretie_miesto'][1] }}%</p>
        </div>
    </div>
</div>

</body>
</html>
@endsection
