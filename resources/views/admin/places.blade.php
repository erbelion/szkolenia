@extends('layouts.base')

@section('body')
    <a href="/admin">
        <button class="btn btn-primary">Powrót do panelu admina</button>
    </a>
    <br>
    <br>
    <div class="card">
        <div class="card-header">Lista miejsc spotkań</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Miejsce</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($places as $place)
                    <tr>
                        <th scope="row">{{$place->id}}</th>
                        <td>{{$place->getNiceName()}}</td>
                    </tr>
                    @endforeach
                    {{ $places->links() }}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Dodawanie miejsca spotkań</div>
        <div class="card-body">
            <form action="/admin/miejsca/nowy" method="post">
                @csrf
                <div class="form-group">
                    <label>Kraj</label>
                    <input type="text" class="form-control" name="country" required>
                </div>
                <div class="form-group">
                    <label>Miejscowość</label>
                    <input type="text" class="form-control" name="city" required>
                </div>
                <div class="form-group">
                    <label>Kod pocztowy</label>
                    <input type="number" class="form-control" name="postal_code" required>
                </div>
                <div class="form-group">
                    <label>Ulica</label>
                    <input type="text" class="form-control" name="street_name" required>
                </div>
                <div class="form-group">
                    <label>Numer ulicy</label>
                    <input type="number" class="form-control" name="street_number" required>
                </div>
                <div class="form-group">
                    <label>Numer mieszkania</label>
                    <input type="number" class="form-control" name="apartment_number">
                </div>
                <div class="form-group">
                    <label>Sala</label>
                    <input type="number" class="form-control" name="room">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection