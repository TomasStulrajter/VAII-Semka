@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Zoznam užívateľov') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <a href="{{ route('uzivatelia.create') }}" class="btn btn-success" role="button" style="margin-bottom: 15px">Pridaj užívateľa</a>
                        </div>

                        {!! $tabulka->show() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
