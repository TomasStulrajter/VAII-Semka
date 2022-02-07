@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-sm-1 row-cols-xs-1">
                <div class="card">
                    <div class="card-header">{{ __('Upraviť užívateľa') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @include('uzivatelia.formular')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
