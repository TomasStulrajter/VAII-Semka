@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Štatistiky</title>

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link href="{{ asset('css/Styly.css') }}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#hlavneMenu" data-offset="0" id = "vrchol" style="background-image: url('{{ asset('pozadie.png')}}');">
<h1 class="stats">Štatistiky</h1>
<p class="stats">Nižšie sú uvedené hlavné štatistické informácie o výskyte ochorenia COVID-19, hospitalizáciách a očkovaní za sledované obdobie (september - október 2021),
    tak ako boli prezentované Úradom verejného zdravotníctva.</p>

<!-- Menu - Scrollspy -->
<nav id="hlavneMenu" class="navbar sticky-top navbar-dark bg-dark">
    <a class="navbar-brand" href="#podvrchol" style="text-indent: 30px">Kategórie:</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#odstavec1">7 dňová PCR incidencia po okresoch</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#odstavec2">Príjmy do nemocníc a hospitalizácie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#odstavec3">Regionálne mapy</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#odstavec4">Porovnanie trendu incidencie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#odstavec5">Vývoj zaočkovanosti po vekových skupinách</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#odstavec6">Úroveň zaočkovanosti v Európe</a>
        </li>
    </ul>
</nav>

<div id="odstavec1">
    <h3 class="stats">7 dňová PCR incidencia po okresoch</h3>
    <img src="{{ asset('statistikaObrazky/obr1.png') }}" alt="7 dňová PCR incidencia po okresoch" class="stats">
</div>

<br>

<div id="odstavec2">
    <h3 class="stats">Príjmy do nemocníc a hospitalizácie</h3>
    <p class = "napoveda">Kliknutím na šípky prepínajte obrázky</p>
    <!-- Carousel -->
    <div id="carousel1" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('statistikaObrazky/obr2.png') }}" alt="Príjmy do nemocníc" class="stats">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('statistikaObrazky/obr3.png') }}" alt="Hospitalizácie" class="stats">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Predchádzajúci</span>
        </a>
        <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Ďalší</span>
        </a>
    </div>
</div>

<br>

<div id="odstavec3">
    <h3 class="stats">Regionálne mapy</h3>
    <p class = "napoveda">Kliknutím na šípky prepínajte obrázky</p>
    <!-- Carousel -->
    <div id="carousel2" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('statistikaObrazky/obr4.png') }}" alt="Percento zaočkovanej populácie za ostatné 3 týždne" class="stats">
                <div class="carousel-caption">
                    <p class="stats">Percento zaočkovanej populácie 1.dávkou za ostatné 3 týždne</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('statistikaObrazky/obr5.png') }}" alt="Covid automat" class="stats">
                <div class="carousel-caption">
                    <p class="stats">Aktuálny Covid automat</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Predchádzajúci</span>
        </a>
        <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Ďalší</span>
        </a>
    </div>
</div>

<br>

<div id="odstavec4">
    <h3 class="stats">Porovnanie trendu incidencie (na 100 tisíc obyv.) v susedných krajinách</h3>
    <img src="{{ asset('statistikaObrazky/obr6.png') }}" alt="Porovnanie trendu incidencie" class="stats">
</div>

<br>

<div id="odstavec5">
    <h3 class="stats">Vývoj zaočkovanosti po vekových skupinách</h3>
    <p class = "napoveda">Kliknutím na šípky prepínajte obrázky</p>
    <!-- Carousel -->
    <div id="carousel3" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('statistikaObrazky/obr7.png') }}" alt="Vývoj zaočkovanosti - 1.dávka" class="stats">
                <div class="carousel-caption">
                    <p class="stats">Vývoj zaočkovanosti po vekových skupinách (1. dávkou)</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('statistikaObrazky/obr8.png') }}" alt="Vývoj zaočkovanosti - plne" class="stats">
                <div class="carousel-caption">
                    <p class="stats">Vývoj zaočkovanosti po vekových skupinách (plne)</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel3" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Predchádzajúci</span>
        </a>
        <a class="carousel-control-next" href="#carousel3" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Ďalší</span>
        </a>
    </div>
</div>

<br>

<div id="odstavec6">
    <h3 class="stats">Úroveň zaočkovanosti v Európe</h3>
    <img src="{{ asset('statistikaObrazky/obr9.png') }}" alt="Úroveň zaočkovanosti v Európe" class="stats">
</div>

<br>
<a id="spodnyLink" href="#vrchol">Návrat na vrchol stránky</a>

</body>
</html>
@endsection
