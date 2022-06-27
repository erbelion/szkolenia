@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(\Session::has('message'))
                <div class="alert alert-primary show" role="alert">
                    {{ \Session::get('message') }}
                </div>
            @endif
            @if(\Session::has('errorMessage'))
                <div class="alert alert-danger show" role="alert">
                    {{ \Session::get('errorMessage') }}
                </div>
            @endif

            @yield('body')
        </div>
    </div>
</div>
@endsection
