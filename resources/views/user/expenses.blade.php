@extends('layouts.base')

@section('body')

<a href="/">
    <button class="btn btn-primary">Powrót do strony głównej</button>
</a>

<br>

<div class="card">
    <div class="card-header">Raport</div>
    <div class="card-body">
        Poniżej wyświetlone są Twoje wydatki z podziałem na miesiące.
        <table class="table sortable">
            <thead>
              <tr>
                <th scope="col">Miesiąc</th>
                <th scope="col">Ilość kupionych rzeczy</th>
                <th scope="col">Koszta</th>
              </tr>
            </thead>
            <tbody>
                @foreach($result as $key => $item)
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$item["count"]}}</td>
                    <td>{{$item["sum"] / 100}} PLN</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            suma wydanych pieniędzy: {{$sum / 100}} PLN
        </div>
    </div>
</div>



@endsection

@section('bottom')
<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
@endsection
