@extends('layouts.base')

@section('body')

<a href="/admin">
    <button class="btn btn-primary">Powrót do panelu admina</button>
</a>

<br>

<div class="card">
    <div class="card-header">Raport</div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Tytuł edycji</th>
                <th scope="col">Uczestnicy</th>
                <th scope="col">$$$$</th>
              </tr>
            </thead>
            <tbody>
                @foreach($result as $item)
                <tr>
                    <td>{{$item->subtitle}}</td>
                    <td>{{$item->Students}}</td>
                    <td>{{$item->Income/100}} PLN</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    


@endsection