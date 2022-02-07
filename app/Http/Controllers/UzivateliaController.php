<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class UzivateliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $ziadost)
    {
        $uzivatelia = User::all();
        $tabulka = new Datagrid($uzivatelia, $ziadost->get('f', []));
        $tabulka->setColumn('name', 'Meno')->setColumn('email', 'E-mail');
        $tabulka->setActionColumn(['wrapper' => function($value, $row) {return
            '<a href="' . route('uzivatelia.edit', $row->id) . '" title="Edit" class="btn btn-sn btn-primary">Upraviť</a>
            <a href="' . route('uzivatelia.delete', $row->id) . '" title="Delete" data-method="DELETE" class="btn btn-sn btn-danger" data-confirm="Si si istý?">Vymazať</a>';}
            ]);

        return view('uzivatelia.index', ['tabulka' => $tabulka]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('uzivatelia.create', ['ukon' => route('uzivatelia.store'), 'metoda' => 'post']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return view('uzivatelia.create', ['ukon' => route('uzivatelia.store'), 'metoda' => 'post', 'errors' => $validator->messages()]);
        } else {
            $data = $request->all();
            $uzivatel_novy = User::create($request->all());
            $uzivatel_novy->save();

            return redirect()->route('uzivatelia.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(int  $id)
    {
        $user = DB::select('select * from users where id = :id', ['id' => $id]);
        return view('uzivatelia.edit', ['ukon' => route('uzivatelia.update', $user[0]->id), 'metoda' => 'put', 'model' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|exists:users,name',
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if ($validator->fails()) {
            $user = DB::select('select * from users where id = :id', ['id' => $id]);
            return view('uzivatelia.edit', ['ukon' => route('uzivatelia.update', $id), 'metoda' => 'put', 'model' => $user, 'errors' => $validator->messages()]);
        } else {
            DB::update('update users set name = :name, email = :email, password = :password where id = :id',
                ['name' => $request->get('name'), 'email' => $request->get('email'), 'password' => $request->get('password'), 'id' => $id]);

            return redirect()->route('uzivatelia.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Int $id)
    {
        DB::delete('delete from users where id = :id', ['id' => $id]);

        return redirect()->route('uzivatelia.index');
    }
}
