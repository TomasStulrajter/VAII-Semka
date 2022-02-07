@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FAQ</title>

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

<body class="faq" id = "vrchol" style="background-image: url('{{ asset('pozadie.png')}}');">
<h1 class="faq">Často kladené otázky</h1>
<p class="faq">Na tejto stránke nájdete odpovede na základné otázky ohľadne nového koronavírusu a ochorení COVID-19, ktoré tento
    vírus spôsobuje.</p>

<!-- Karta 1 -->
<div class="card border-white" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Čo je COVID-19?</h5>
        <hr>
        <p class="card-text">
            Nový kmeň vírusu, ochorenie sa prenáša kvapôčkovou infekciou.
            Koronavírus spôsobujúci ochorenie COVID-19 bol identifikovaný v Číne na konci roka 2019. Predstavuje nový kmeň
            vírusu, ktorý u ľudí nebol doposiaľ známy. Ochorenie sa prenáša kvapôčkovou infekciou, odhadovaný inkubačný
            čas ochorenia je 2 až 14 dní.
        </p>
    </div>
</div>

<!-- Karta 2 -->
<div class="card border-white" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Aké su prejavy ochorenia COVID-19?</h5>
        <hr>
        <p class="card-text">
            Nový koronavírus spôsobuje akútne respiračné ochorenie.
            Ide o všeobecné príznaky virózy, respektíve klasických respiračných ochorení, napríklad aj chrípky – teplota
            nad 38 °C, kašeľ, bolesť svalov, bolesť kĺbov, sťažené dýchanie. Spôsobuje infekcie dýchacích ciest až zápal pľúc.
            Inkubačný čas pri tomto type koronavírusu sa udáva 2 až 14 dní. Vo väčšine prípadov je priebeh ochorenia len mierny.
            Ukazuje sa však, že vírus môžu prenášať aj infikované osoby, ktoré nemajú vonkajšie prejavy ochorenia.
        </p>
    </div>
</div>

<!-- Karta 3 -->
<div class="card border-white" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Aký je postup pri trnasporte pacienta s podozrením na ochorenie COVID-19?</h5>
        <hr>
        <p class="card-text">
            Telesná teplota 38 °C je pre transport pacienta s podozrením na COVID-19 rozhodujúcim faktorom.
            Pacienti s pozitívnou cestovateľskou anamnézou a symptómami respiračného ochorenia, ktorí majú telesnú teplotu
            nižšiu ako 38 °C, majú zostať v domácej izolácii. V prípade zhoršenia zdravotného stavu spojeného so vzostupom telesnej teploty,
            lekár KOS ZZS po konzultácii s infektológom rozhodne o hospitalizácii prostredníctvom poskytovateľa záchrannej zdravotnej služby.
        </p>
    </div>
</div>

<!-- Karta 4 -->
<div class="card border-white" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Oznámia mi výsledok odberu aj v prípade, ak je negatívny?</h5>
        <hr>
        <p class="card-text">
            Národné centrum zdravotníckych informácií zabezpečuje oznámenie výsledkov pacientovi (len negatívny),
            jeho ošetrujúcemu lekárovi, príslušnému RÚVZ a ÚVZ SR.
        </p>
    </div>
</div>

<a href="#vrchol" class="faq">Návrat na vrchol stránky</a>
</body>
</html>
@endsection
