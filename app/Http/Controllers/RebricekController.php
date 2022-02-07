<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vysledok;
use Faker\Core\Number;

class RebricekController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show()
    {
        $vysledky = Vysledok::all();

        $uspesnosti = [];
        $uzivatelia = [];

        for ($i = 0; $i < count($vysledky); $i++) {
            $pomer = round(($vysledky[$i]['spravne_odpovede'] / $vysledky[$i]['vsetky_odpovede']), 4);
            array_push($uspesnosti, $pomer);
            array_push($uzivatelia, $vysledky[$i]['uzivatel_id']);
        }

        array_multisort($uspesnosti, $uzivatelia);

        $prve_miesto = User::where('id', $uzivatelia[count($vysledky) - 1])->get();
        $prve_meno = $prve_miesto[0]['name'];

        $druhe_miesto = User::where('id', $uzivatelia[count($vysledky) - 2])->get();
        $druhe_meno = $druhe_miesto[0]['name'];

        $tretie_miesto = User::where('id', $uzivatelia[count($vysledky) - 3])->get();
        $tretie_meno = $tretie_miesto[0]['name'];


        $prvi_traja = ['prve_miesto' => [$prve_meno, ($uspesnosti[count($vysledky) - 1] * 100)],
            'druhe_miesto' => [$druhe_meno, ($uspesnosti[count($vysledky) - 2] * 100)],
                'tretie_miesto' => [$tretie_meno, ($uspesnosti[count($vysledky) - 3] * 100)]];

        return view('quiz.rebricek', ['prvi_traja' => $prvi_traja]);
    }
}
