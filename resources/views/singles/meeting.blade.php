@extends('layouts.base')

@section('body')
<div class="card">
    <div class="card-header">Spotkanie {{$title}}</div>
    <div class="card-body">
        <h2>Dane adresowe</h2>
        <p>{{$id}}</p>
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
<form action="/spotkanie/{{$id}}/store" method="post">
    @csrf
    <div class="form-group">
        <label>Komentarz</label>
        <input type="text" class="form-control" name="review" required>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Dodaj</button>

</form>
@foreach ($comments as $comment)
@if ($id === $comment->meeting_id)
<div class="card-body flex-column">
        <div class="card">
            <div class="card-header h-100"></div>
            <div class="card-body">
                <p>{{$comment->message}}</p>
            </div>
        </div>
    </div>
@endif
@endforeach
@endsection