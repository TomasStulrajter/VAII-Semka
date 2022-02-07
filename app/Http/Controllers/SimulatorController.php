<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SimulatorZaznam;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SimulatorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function show()
    {
        $id = auth()->user()->id;
        $zaznamy = SimulatorZaznam::where('uzivatel_id', $id)->get();
        //$test = $zaznamy[0]['pocet_nakazenych'];
        return view('legacy.simulator', ['data' => $zaznamy, 'length' => count($zaznamy)]);
    }

    public function pridaj(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datum' => 'required|date|unique:simulator_zaznamy',
            'pocet' => 'required|numeric|max:5449270|min:0' //pocet obyvatelov Slovenska
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $novy_zaznam = new SimulatorZaznam;
            $novy_zaznam->datum = $request->input('datum');
            $novy_zaznam->pocet_nakazenych = $request->input('pocet');
            $novy_zaznam->uzivatel_id= auth()->user()->id;
            $novy_zaznam->save();

            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function uprav(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'datum' => 'required|date',
            'pocet' => 'required|numeric|max:5449270|min:0' //pocet obyvatelov Slovenska
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }
        else {
            $datum = $request->input('datum');
            $pocet = $request->input('pocet');
            if (SimulatorZaznam::where('datum', '=', $datum)->where('uzivatel_id', '=', auth()->user()->id)->exists()) {
                SimulatorZaznam::where('datum', '=', $datum)->where('uzivatel_id', '=', auth()->user()->id)->update(array('pocet_nakazenych' => $pocet));
                return response()->json([
                    'status' => 202,
                ]);
            } else {
                $novy_zaznam = new SimulatorZaznam;
                $novy_zaznam->datum = $request->input('datum');
                $novy_zaznam->pocet_nakazenych = $request->input('pocet');
                $novy_zaznam->uzivatel_id= auth()->user()->id;
                $novy_zaznam->save();

                return response()->json([
                    'status' => 200,
                ]);
            }
        }
    }

    public function odstran(Request $request)
    {
        $id = $request->input('id');
        SimulatorZaznam::where('id', $id)->delete();
        return response()->json([
            'status' => 200,
        ]);
    }

    public function refresh()
    {
        $id = auth()->user()->id;
        $zaznamy = SimulatorZaznam::where('uzivatel_id', 11)->get();
        return response()->json([
            'status' => 200,
            'zaznamy' => $zaznamy,
        ]);
    }
}
