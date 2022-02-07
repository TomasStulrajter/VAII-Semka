@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quiz</title>

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
<h1 class="faq">Quiz</h1>
<p class="faq">Na tejto stránke si môžete otestovať svoje vedomosti ohľadne vírusu Covid-19 a ochorenia, ktoré spôsobuje.
    Z našeho zoznamu vám náhodne vygenerujeme niekoľko otázok a vašou úlohou je zaškrtnúť všetky správne odpovede spomedzi
    ponúkaných možností. Quiz môžete kedykoľvek reštartovať kliknutím na príslušné tlačidlo v rohu stránky. Po dokončení
    sa vám zobrazí dosiahnuté skóre ako počet správnych odpovedí. Ak otázku nevyplníte alebo zaškrtnete viac odpovedí ako
    je potrebné, systém to zaráta ako nesprávnu odpoveď.</p>

<?php $pocitadlo = 0; ?>
<form action="/quiz/vyhodnot" method="post" id="quiz_formular">
    @csrf
    @for ($i = 0; $i < 4; $i++)
        <p style="margin-bottom: 0; color: orange"><b>{{ $data[$i]['otazka'] }}</b></p>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $pocitadlo ?>" id="<?php echo $pocitadlo ?>" name="odpovede[]">
            <label class="form-check-label" for="flexCheckDefault" style="color: white">
                {{ $data[$i]['odpovede'][0]['odpoved'] }}
            </label>
        </div>
        <?php $pocitadlo++; ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $pocitadlo ?>" id="<?php echo $pocitadlo ?>" name="odpovede[]">
            <label class="form-check-label" for="flexCheckChecked" style="color: white">
                {{ $data[$i]['odpovede'][1]['odpoved'] }}
            </label>
        </div>
        <?php $pocitadlo++; ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $pocitadlo ?>" id="<?php echo $pocitadlo ?>" name="odpovede[]">
            <label class="form-check-label" for="flexCheckChecked" style="color: white">
                {{ $data[$i]['odpovede'][2]['odpoved'] }}
            </label>
        </div>
        <?php $pocitadlo++; ?>
        <hr id="ciara_<?php echo $pocitadlo ?>" style="height:10px; border-top: 0px">
    @endfor
</form>

<button type="button" id="vyhodnot_tlacidlo" class="btn btn-primary">Vyhodnoť quiz</button>
<br>

<script>
    $(document).ready(function () {
        for (let i = 0; i < 12; i++) {
            var checkbox = document.getElementById(i.toString());
            if (checkbox.checked) {
                checkbox.checked = false;
            }
        }

        for (let i = 3; i < 13; i+=3) {
            var id_ciary = "ciara_" + i.toString();
            var farba = Math.floor(Math.random()*16777215).toString(16);
            var ciara = document.getElementById(id_ciary);
            ciara.style.color = "#" + farba;
        }

        $(document).on('click', '#vyhodnot_tlacidlo', function() {
            var odpovede = []
            for (let i = 0; i < 12; i++) {
                var checkbox = document.getElementById(i.toString());
                if (checkbox.checked) {
                    odpovede.push(i);
                }
            }

            var odpovede = {
                'odpovede' : odpovede,
            };
            //console.log(novy_zaznam);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/quiz/vyhodnot',
                data:odpovede,
                dataType:'json',
                success:function(response) {
                    var formular = document.getElementById('quiz_formular');
                    formular.remove();
                    var tlacidlo = document.getElementById('vyhodnot_tlacidlo');
                    tlacidlo.remove();

                    var obal = document.createElement('div');
                    obal.id = "obal";
                    obal.style.marginLeft = "15px";
                    obal.style.fontSize = "1.6em";

                    var hlaska1 = document.createElement('p');

                    if (response.pocet_spravnych_odpovedi == 0 || response.pocet_spravnych_odpovedi == 1) {
                        hlaska1.style.color = "red";
                    } else if (response.pocet_spravnych_odpovedi == 2 || response.pocet_spravnych_odpovedi == 3){
                        hlaska1.style.color = "orange";
                    } else {
                        hlaska1.style.color = "light-green";
                    }

                    var text1 = "Počet správne zodpovedaných otázok: " + response.pocet_spravnych_odpovedi.toString();
                    hlaska1.id = "hlaska_1";
                    hlaska1.innerText = text1;

                    var hlaska2 = document.createElement('p');
                    var text2 = "Správne zodpovedané otázky : "
                    for (let i = 0; i < response.spravne_odpovede.length; i++) {
                        text2 += response.spravne_odpovede[i] + ", "
                    }
                    hlaska2.id = "hlaska_2";
                    hlaska2.innerText = text2;

                    var hlaska3 = document.createElement('p');
                    var pomer = (response.pocet_spravnych_odpovedi / 4) * 100;
                    var text3 = "To predstavuje úspešnosť " + pomer.toString() + "%."
                    hlaska3.id = "hlaska_3";
                    hlaska3.innerText = text3;

                    obal.appendChild(hlaska1);
                    obal.appendChild(hlaska2);
                    obal.appendChild(hlaska3);
                    document.getElementById('vrchol').appendChild(obal);
                }
            });
        });
    });
</script>

</body>
</html>
@endsection
