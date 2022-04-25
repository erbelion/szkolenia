@extends('layouts.base')

@section('body')
<div class="card">
    <div class="card-header">Spotkanie {{$title}}</div>
    <div class="card-body">
        <h2>Dane adresowe</h2>
        <p>Kraj: {{$country}}</p>
        <p>Adres: {{$city}} {{$postal_code}}, {{$street_name}} {{$street_number}}</p>
        <p>Piętro: {{$apartment_number}}, {{$room ? 'Pokój nr ' . $room : ''}}</p>
        <p>Data: {{$start_date}} - {{$end_date}}</p>

        <h2>Opis spotkania</h2>
        <p>{{$description}}</p>
    </div>
</div>
<br/>
<div class="card-header">Komentarze uczestników</div>


@endsection