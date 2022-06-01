@extends('layouts.base')

@section('body')
    <a href="/admin/kursy">
        <button class="btn btn-primary">Powrót do kursów</button>
    </a>
    <br>
    <br>
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
    <div class="card">
        <div class="card-header">Lista edycji</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Podytuł</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Liczba użytkowników</th>
                        <th scope="col">Zobacz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($editions as $edition)
                    <tr>
                        <th scope="row">{{$edition->edition_no}}</th>
                        <td>{{$edition->subtitle}}</td>
                        <td>{{$edition->price / 100}} PLN</td>
                        <td>{{$edition->users_count}}</td>
                        <td>
                            <a href="/admin/edycja/{{$edition->id}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    {{ $editions->links() }}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Dodawanie edycji</div>
        <div class="card-body">
            <form action="/admin/kurs/{{$course->id}}/nowa-edycja" method="post">
                @csrf
                <div class="form-group">
                    <label>Podtytuł</label>
                    <input type="text" class="form-control" name="subtitle" required>
                </div>
                <div class="form-group">
                    <label>Opis</label>
                    <textarea type="text" class="form-control" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Cena (w groszach)</label>
                    <input type="number" class="form-control" name="price" required min="1" value=5000>
                </div>
                <div class="form-group">
                    <label>Limit użytkowników</label>
                    <input type="number" class="form-control" name="users_limit" required>
                </div>
                <div class="form-group">
                    <label>Start</label>
                    <input type="datetime-local" class="form-control" name="start_date" required>
                </div>
                <div class="form-group">
                    <label>Koniec</label>
                    <input type="datetime-local" class="form-control" name="end_date" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection