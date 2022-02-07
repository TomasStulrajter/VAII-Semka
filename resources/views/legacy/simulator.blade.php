@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simulátor</title>

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
    <script src="https://cdn.plot.ly/plotly-2.8.3.min.js"></script>
</head>

<body class="simulator" id="body" style="background-image: url('{{ asset('pozadie.png')}}');" >
<h1 class="simulator">Simulátor šírenia ochorenia COVID-19</h1>
<p class="simulator">Na tejto stránke sa nachádza jednoduchý simulátor šírenia ochorenia COVID-19. Priamo na tejto stránke nájdete tabuľku
    denných prírastkov ochorenia spolu so sumárnymi štatistikami šírenia. Tabuľka si ukladá informácie pre každého užívateľa
    zvlášť a zobrazuej vždy len jeho údaje. Pomocou poskytnutých tlačidiel je možné s tabuľkou priamo manipulovať. </p>

<div id="graf" style="width:500px;height:250px;"></div>


<button type="button" id="pridaj_tlacidlo" class="univerzalne_tlacidlo" style="margin-left: 20px">Pridať záznam</button>

<div class="modal fade" id="pridajModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať záznam</h5>
                <button type="button" class="close" id="horny_zavri_pridajModal" aria-label="Close" style="color: white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="datum_pole">Dátum</label>
                    <input type="date" class="form-control datum" id="datum_pole">
                </div>
                <div class="form-group">
                    <label for="pocet_pole">Počet nakazených</label>
                    <input type="text" class="form-control pocet" id="pocet_pole">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="univerzalne_tlacidlo" id="zavri_pridajModal">Zavrieť</button>
                <button type="button" class="btn btn-primary pridaj_zaznam">Uložiť</button>
            </div>

            <ul id='chybove_hlasky'>
                {{-- tu sa zobrazia chybove hlasky --}}
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="upravModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upraviť zázam</h5>
                <button type="button" class="close" id="horny_zavri_upravModal" aria-label="Close"style="color: white">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="datum_pole_uprav">Dátum</label>
                    <input type="date" class="form-control datum_uprav" id="datum_pole_uprav">
                </div>
                <div class="form-group">
                    <label for="pocet_pole_uprav">Počet nakazených</label>
                    <input type="text" class="form-control pocet_uprav" id="pocet_pole_uprav">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="univerzalne_tlacidlo" id="zavri_upravModal">Zavrieť</button>
                <button type="button" class="btn btn-primary uprav_zaznam">Uložiť</button>
            </div>

            <ul id='chybove_hlasky'>
                {{-- tu sa zobrazia chybove hlasky --}}
            </ul>
        </div>
    </div>
</div>

<script>
    function vytvor_tabulku(datumy, poctyNakazenych, zaznamy) {
        if (document.getElementById('tabulka') !== null) {
            console.log("idem mazat tabulku")
            var telo = document.getElementById('body');
            var tabulka_na_zmazanie = document.getElementById('tabulka');
            telo.removeChild(tabulka_na_zmazanie);
        }

        var tabulka = document.createElement("table");
        tabulka.id = "tabulka";
        tabulka.width = "25%";

        for (let i = 0; i < zaznamy.length; i++) {
            var riadok = tabulka.insertRow(i);
            var bunka1 = riadok.insertCell(0);
            var bunka2 = riadok.insertCell(1);

            var bunka3 = riadok.insertCell(2);

            var id = zaznamy[i]['id'];
            var datum = zaznamy[i]['datum'];
            var pocet = zaznamy[i]['pocet_nakazenych'];

            bunka1.innerHTML = datum;
            bunka2.innerHTML = pocet;

            let uprav_tlacidlo_id = "uprav_tlacidlo_" + i;
            let odstran_tlacidlo_id = "odstran_tlacidlo_" + i;

            let uprav_tlacidlo = document.createElement('button');
            uprav_tlacidlo.id = uprav_tlacidlo_id;
            uprav_tlacidlo.className = 'univerzalne_tlacidlo';
            let uprav_text = document.createTextNode("Uprav");
            uprav_tlacidlo.appendChild(uprav_text);
            bunka3.appendChild(uprav_tlacidlo);

            let odstran_tlacidlo = document.createElement('button');
            odstran_tlacidlo.id = odstran_tlacidlo_id;
            odstran_tlacidlo.className = 'univerzalne_tlacidlo';
            let odstran_text = document.createTextNode("Odstráň");
            odstran_tlacidlo.appendChild(odstran_text);
            bunka3.appendChild(odstran_tlacidlo);

            //console.log(odstran_tlacidlo.id);
            (function(nastav_datum, nastav_pocet) {
                uprav_tlacidlo.onclick = function(){
                    $('#upravModal').modal('show');
                    var datum_pole = document.getElementById('datum_pole_uprav');
                    var pocet_pole = document.getElementById('pocet_pole_uprav');
                    datum_pole.value = nastav_datum;
                    pocet_pole.value = nastav_pocet;
                };
            })(datum, pocet);

            (function(ktore_id) {
                odstran_tlacidlo.onclick = function(){

                    var zaznam = {
                        'id' : ktore_id
                    };
                    //console.log(novy_zaznam);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:'POST',
                        url: '/simulator/odstran',
                        data:zaznam,
                        dataType:'json',
                        success:function(response) {
                            //console.log(response.status);
                            if (response.status == 400) {
                                console.log("Sem sa nesmies dostať");
                            } else {
                                datumy = [];
                                poctyNakazenych = [];
                                obnov_data(datumy, poctyNakazenych);
                            }
                        }
                    });
                };
            })(id);


            datumy.push(datum);
            poctyNakazenych.push(pocet);
        }
        const element = document.getElementById("body");
        element.appendChild(tabulka);
    }

    function vypis_statistiky(poctyNakazenych) {
        if (document.getElementById('nadoba_na_statistiku') !== null) {
            var statistika = document.getElementById('nadoba_na_statistiku');
            statistika.remove();
        }

        var maximum = Math.max(...poctyNakazenych);
        var minimum = Math.min(...poctyNakazenych);

        var priemer = 0;
        for (var j = 0; j < poctyNakazenych.length; j++)
            priemer += poctyNakazenych[j];
        var sucet = priemer;
        console.log(sucet);
        priemer /= poctyNakazenych.length;
        priemer = Math.round(priemer);

        var trvanie_do_konca = Math.round((5449270- sucet) / priemer);

        console.log(minimum, maximum, minimum + maximum, priemer, sucet);

        var text_statistiky_min = "Minimálny počet nových denných nákaz je " + String(minimum);
        var text_statistiky_max = "Maximálny počet nových denných nákaz je " + String(maximum);
        var text_statistiky_priemer = "Priemerný počet nových denných nákaz je " + String(priemer);
        var text_statistiky_trvanie = "Pri súčasnom tempe prírastku dôjde k úplnému premoreniu populácie o " + String(trvanie_do_konca) + " dní.";

        var statistika = document.createElement("div");
        statistika.id = "nadoba_na_statistiku"

        var statistika_min = document.createElement("pre");
        statistika_min.innerText = text_statistiky_min;

        var statistika_max = document.createElement("pre");
        statistika_max.innerText = text_statistiky_max;

        var statistika_priemer = document.createElement("pre");
        statistika_priemer.innerText = text_statistiky_priemer;

        var statistika_trvanie = document.createElement("pre");
        statistika_trvanie.innerText = text_statistiky_trvanie;

        var medzera1 = document.createElement("br");
        var medzera2 = document.createElement("br");

        statistika.appendChild(medzera1);
        statistika.appendChild(statistika_min);
        statistika.appendChild(statistika_max);
        statistika.appendChild(statistika_priemer);
        statistika.appendChild(statistika_trvanie);
        statistika.appendChild(medzera2);

        const element = document.getElementById("body");
        element.appendChild(statistika);
    }

    function vykresli_graf(datumy, poctyNakazenych) {
        GRAF = document.getElementById('graf');

        var list = [];
        for (var j = 0; j < datumy.length; j++)
            list.push({'datum': datumy[j], 'pocetNakazenych': poctyNakazenych[j]});

        list.sort(function(a, b) {
            return ((a.datum < b.datum) ? -1 : ((a.datum == b.datum) ? 0 : 1));
        });

        for (var k = 0; k < list.length; k++) {
            datumy[k] = list[k].datum;
            poctyNakazenych[k] = list[k].pocetNakazenych;
        }

        Plotly.newPlot( GRAF, [{

            x: datumy,

            y: poctyNakazenych }], {

            margin: { t: 0 } } );
    }

    function obnov_data(datumy, poctyNakazenych) {
        var donesene_data = []
        $.ajax({
            type:'GET',
            url: '/simulator/refresh',
            success:function(response) {
                donesene_data = response.zaznamy;
                vytvor_tabulku(datumy, poctyNakazenych, donesene_data);
                vykresli_graf(datumy, poctyNakazenych);
                vypis_statistiky(poctyNakazenych);
            }
        });
        // console.log('fetched data before returning from function');
        // console.log(donesene_data);
        return donesene_data;
    }

    $(document).ready(function () {
        let datumy = [];
        let poctyNakazenych = [];

        let zaznamy = {!! json_encode($data->toArray(), JSON_HEX_TAG) !!};
        vytvor_tabulku(datumy, poctyNakazenych, zaznamy);
        vykresli_graf(datumy, poctyNakazenych);
        vypis_statistiky(poctyNakazenych);

        $("#pridaj_tlacidlo").click(function () {
            $('#pridajModal').modal('show');
        });

        $("#zavri_pridajModal").click(function () {
            $('#pridajModal').modal('hide');
        });

        $("#horny_zavri_pridajModal").click(function () {
            $('#pridajModal').modal('hide');
        });


        $("#zavri_upravModal").click(function () {
            $('#upravModal').modal('hide');
        });

        $("#horny_zavri_upravModal").click(function () {
            $('#upravModal').modal('hide');
        });

         $(document).on('click', '.pridaj_zaznam', function(udalost) {
            udalost.preventDefault();

            var novy_zaznam = {
                'datum' : $('.datum').val(),
                'pocet' : $('.pocet').val()
            };
            //console.log(novy_zaznam);

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $.ajax({
                 type:'POST',
                 url: '/simulator',
                 data:novy_zaznam,
                 dataType:'json',
                 success:function(response) {
                     //console.log(response.status);
                     if (response.status == 400) {
                         $('#chybove_hlasky').html("");
                         $.each(response.errors, function (key, err_values) {
                             $('#chybove_hlasky').append('<li>'+err_values+'</li>');
                         });
                     } else {
                         $('#pridajModal').find('input').val("");
                         $('#pridajModal').modal('hide');
                         datumy = [];
                         poctyNakazenych = [];
                         obnov_data(datumy, poctyNakazenych);
                     }
                 }
             });
         });

        $(document).on('click', '.uprav_zaznam', function(udalost) {
            udalost.preventDefault();

            var novy_zaznam = {
                'datum' : $('.datum_uprav').val(),
                'pocet' : $('.pocet_uprav').val()
            };
            //console.log(novy_zaznam);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url: '/simulator/uprav',
                data:novy_zaznam,
                dataType:'json',
                success:function(response) {
                    //console.log(response.status);
                    if (response.status == 400) {
                        $('#chybove_hlasky').html("");
                        $.each(response.errors, function (key, err_values) {
                            $('#chybove_hlasky').append('<li>'+err_values+'</li>');
                        });
                    } else {
                        console.log(response.status);
                        $('#upravModal').find('input').val("");
                        $('#upravModal').modal('hide');
                        datumy = [];
                        poctyNakazenych = [];
                        obnov_data(datumy, poctyNakazenych);
                    }
                }
            });
        });
    });
</script>

</body>
</html>
@endsection
