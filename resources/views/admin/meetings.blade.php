@extends('layouts.base')

@section('body')
    <a href="/admin/kurs/{{$edition->course->id}}">
        <button class="btn btn-primary">Powrót do kursu</button>
    </a>
    <br>
    <br>
    <div class="card">
        <div class="card-header">Edycja #{{$edition->edition_no}}</div>
        <div class="card-body">
            <h1>{{$edition->subtitle}}</h1>

            Cena:
            {{$edition->price / 100}} PLN
            <br>

            Uczestnicy:
            {{$edition->users_count}}/{{$edition->users_limit}}
            <br>

            Ramy czasowe:
            {{$edition->start_date}} - {{$edition->end_date}}
            <br>

            Opis:
            <br>
            {{$edition->description}}
        </div>
    </div>
    <div class="card">
        <div class="card-header">Lista spotkań</div>
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Start</th>
                    <th scope="col">Koniec</th>
                    <th scope="col">Miejsce</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    <tr>
                        <td>{{$meeting->title}}</td>
                        <td>{{$meeting->start_date}}</td>
                        <td>{{$meeting->end_date}}</td>
                        <td>{{$meeting->place->getNiceName()}}</td>
                        <td>
                            <a href="/spotkanie/{{$meeting->id}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    {{ $meetings->links() }}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Dodawanie spotkania</div>
        <div class="card-body">
            <form action="/admin/edycja/{{$edition->id}}/nowe-spotkanie" method="post">
                @csrf
                <div class="form-group">
                    <label>Tytuł</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>Opis</label>
                    <textarea type="text" class="form-control" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Start</label>
                    <input type="datetime-local" class="form-control" name="start_date" required>
                </div>
                <div class="form-group">
                    <label>Koniec</label>
                    <input type="datetime-local" class="form-control" name="end_date" required>
                </div>
                <div class="form-group">
                    <label>Miejsce</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="place_id">
                        @foreach ($places as $place)
                            <option value="{{$place->id}}">{{$place->getNiceName()}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection