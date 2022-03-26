@extends('layouts.base')

@section('body')
    <div class="card">
        <div class="card-header">Kurs #{{$course->id}}</div>
        <div class="card-body">
            <h1>{{$course->title}}</h1>

            Sponsor:
            <a href="{{$course->organiser_url}}">{{$course->organiser_name}}</a>
            <br>

            Limit edycji: {{$course->editions_limit}}
            <br>

            Opis:
            <br>
            {{$course->description}}
        </div>
    </div>
@endsection