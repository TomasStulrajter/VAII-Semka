<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\QuizOtazka;
use App\Models\User;
use App\Models\Vysledok;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\True_;

class QuizController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show()
    {
        $otazky = QuizOtazka::all();
        $vybrane_otazky = [];
        $kluc = [];

        $indexy = [];
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, count($otazky) - 1);
            if(in_array($index, $indexy)) {
                while(in_array($index, $indexy)) {
                    $index = rand(0, count($otazky) - 1);
                }
            }
            array_push($indexy, $index);

            $aktualna_otazka = $otazky[$index];
            $odpovede = [];

            for ($j = 1; $j <= 3; $j++) {
                $meno = "odpoved_";
                $meno .= strval($j);
                $odpoved = [
                    "odpoved" => $aktualna_otazka[$meno],
                    "spravna" => 0,
                ];
                array_push($odpovede, $odpoved);
            }

            for ($j = 0; $j < $aktualna_otazka['spravne']; $j++) {
                $odpovede[$j]['spravna'] = 1;
            }
            shuffle($odpovede);

            $kluc_k_otazke = [];
            for ($j = 0; $j < 3; $j++) {
                if ($odpovede[$j]['spravna'] == 1) {
                    array_push($kluc_k_otazke, strval($j + (3 * $i)));
                }
            }
            array_push($kluc, $kluc_k_otazke);

            $otazka = [
                "otazka" => $aktualna_otazka['otazka'],
                "odpovede" => $odpovede,
            ];
            array_push($vybrane_otazky, $otazka);
        }

        session()->put('kluc', $kluc);
        return view('quiz.quiz', ['data' => $vybrane_otazky]);
    }

    public function najdi_pritomne_hodnoty_v_rozmedzi($pole, $od, $do)
    {
        $vysledok = [];
        for ($i = 0; $i < count($pole); $i++) {
            if ($pole[$i] >= $od and $pole[$i] <= $do) {
                array_push($vysledok, $pole[$i]);
            }
        }
        return $vysledok;
    }

    public function vyhodnot(\Illuminate\Http\Request $request)
    {
        $kluc = session()->get('kluc');
        $odpovede = $request->input('odpovede');

        $pocitadlo_spravnych_odpovedi = 0;
        $spravne_odpovede = [];
        if (!is_null($odpovede)) {
            for ($i = 0; $i < 4; $i++) {
                $uzivatelske_vysledky = $this->najdi_pritomne_hodnoty_v_rozmedzi($odpovede, (3 * $i), (3 * $i + 2));
                if ($uzivatelske_vysledky == $kluc[$i]) {
                    $pocitadlo_spravnych_odpovedi++;
                    array_push($spravne_odpovede, $i + 1);
                }
            }
        }

        $id = auth()->user()->id;

        $celkova_uspesnot = round($pocitadlo_spravnych_odpovedi / 4, 4);
        if (Vysledok::where('uzivatel_id', $id)->exists()) {
            $uzivatel_odpovede = Vysledok::where('uzivatel_id', $id)->get();
            $vsetky = $uzivatel_odpovede[0]['vsetky_odpovede'];
            $vsetky += 4;
            $spravne = $uzivatel_odpovede[0]['spravne_odpovede'];
            $spravne += $pocitadlo_spravnych_odpovedi;
            $celkova_uspesnot = round($spravne / $vsetky, 4);

            Vysledok::where('uzivatel_id', $id)->update(['vsetky_odpovede' => $vsetky, 'spravne_odpovede' => $spravne]);
        } else {
            Vysledok::create([
                'uzivatel_id' => $id, 'vsetky_odpovede' => 4, 'spravne_odpovede' => $pocitadlo_spravnych_odpovedi
            ]);
        }

        session()->put('spravne_odpovede', $spravne_odpovede);
        return response()->json([
            'status' => 200,
            'pocet_spravnych_odpovedi' => $pocitadlo_spravnych_odpovedi,
            'spravne_odpovede' => $spravne_odpovede,
            'celkova_uspesnost' => $celkova_uspesnot
        ]);
    }

    public function otazky()
    {
        return view('quiz.index');
    }

    public function pridat(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otazka' => 'required|unique:quiz_otazky',
            'odpoved_1' => 'required|max:256',
            'odpoved_2' => 'required|max:256',
            'odpoved_3' => 'required|max:256',
            'spravne' => 'required|numeric|between:1,3'
        ]);

        if ($validator->fails()) {
            return view('quiz.index', ['errors' => $validator->messages()]);
        } else {
            $novy = $request->all();
            $otazka_nova = QuizOtazka::create($request->all());
            $otazka_nova->save();
            return redirect()->route('quiz');
        }
    }

    public function odstranit(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otazka_id' => 'required|numeric|exists:quiz_otazky,id',
        ]);

        if ($validator->fails()) {
            return view('quiz.index', ['errors' => $validator->messages()]);
        } else {
            $otazka_id = $request->input('otazka_id');
            DB::delete('delete from quiz_otazky where id = :id', ['id' => $otazka_id]);
            return redirect()->route('quiz');
        }
    }
}
