@extends('layouts.base')

@section('body')
<form action="/goscie" method="post">
    @csrf
    <div class="form-group">
        <label>Nazwa użytkownika</label>
        <input type="text" class="form-control" name="user_name" value="{{auth()->user() ? auth()->user()->name : ''}}" required>
    </div>
    <div class="form-group">
        <label>Komentarz</label>
        <input type="text" class="form-control" name="review" required>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Dodaj</button>

</form>
<br>
    @foreach ($guests as $guest)
    <div class="card-body flex-column">
        <div class="card">
            <div class="card-header h-100">Komentarz użytkownika: {{$guest->name}}</div>
            <div class="card-body">
                <p>{{$guest->message}}</p>
            </div>
        </div>
    </div>
    @endforeach
@endsection