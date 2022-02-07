@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-xs-1">
                <div class="card">
                    <div class="card-header">{{ __('Manažér otázok') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="post" action="{{ route('quiz.pridat') }}">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">Otázka</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="otazka" name="otazka", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">Prvá odpoveď</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="odpoved_1" name="odpoved_1", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">Druhá odpoveď</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="odpoved_2" name="odpoved_2", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">Tretia odpoveď</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="odpoved_3" name="odpoved_3", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">Správne</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="spravne" name="spravne", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-primary form-control" style="margin-top: 15px">Ulož</button>
                                </div>
                                <br>
                            </form>

                            <form method="post" action="{{ route('quiz.odstranit') }}">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="meno" class="col-sm-2 col-md-3 col-form-label">ID Otázky</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="otazka_id" name="otazka_id", value="{{ @$model[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-primary form-control" style="margin-top: 15px">Odstráň</button>
                                </div>
                                <br>
                                <div id='chybove_hlasky'>
                                    @foreach($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
