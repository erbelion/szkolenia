@extends('layouts.base')

@section('body')

<a href="/">
    <button class="btn btn-primary">Powrót do strony głównej</button>
</a>

<br>

<div class="card">
    <div class="card-header">Raport</div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Miesiąc</th>
                <th scope="col">Koszty</th>
              </tr>
            </thead>
            <tbody>
                @foreach($result as $item)
                <tr>
                    <td>{{$item->Month}}</td>
                    <td>{{$item->Income/100}} PLN</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    


@endsection