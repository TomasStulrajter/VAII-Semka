@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hlavná stránka</title>

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

    <link href="{{ asset('css/Styly.css') }}" rel="stylesheet">
</head>

<body class="main" id="vrchol" style="background-image: url('{{ asset('pozadie.png')}}');">
<div class="container">
    <div class="row">
        <!-- Opis COVIDu -->
        <div class="col-md-4">
            <p id = "prvyStlpec" class="main">COVID-19 je infekčné ochorenie, vyvolané koronavírusom SARS-CoV-2. Prvýkrát bol identifikovaný u pacientov so závažným
                respiračným ochorením v decembri roku 2019 v čínskom meste Wu-chan. COVID-19 postihuje najmä dýchací systém, v ťažkých
                prípadoch vyvoláva ťažký zápal pľúc a môže viesť až k úmrtiu pacienta. Vírus sa prenáša kvapôčkami sekrétu pri kašli,
                kýchaní a rozprávaní. Ohrozuje osoby, ktoré sú v blízkom alebo dlhšie trvajúcom kontakte s nakazeným. Infekcia sa
                prenáša aj cez kontaminované predmety.</p>
        </div>
        <!-- Priznaky COVIDu -->
        <div class="col-md-4">
            <p class="main">Hlavné príznaky ochorenia COVID-19 sú uvedené na tejto infografike denníka SME:</p>
            <img src="https://m.smedata.sk/api-media/media/image/sme/8/61/6138958/6138958.jpeg" alt="Hlavné príznaky ochorenia COVID-19">
        </div>
        <!-- Aktuality -->
        <div class="col-md-4">
            <p class="main">Aktuality:</p>
            <iframe width="420" height="300"
                    src="https://www.youtube.com/embed/_4HsmRSlRiA">
            </iframe>
        </div>
    </div>
</div>

<a href="#vrchol" id="spodnyLink">Návrat na vrchol stránky</a>
</body>
</html>
@endsection
