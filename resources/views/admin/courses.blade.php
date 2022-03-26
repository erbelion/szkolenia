@extends('layouts.base')

@section('body')
    <a href="/admin">
        <button class="btn btn-primary">Powrót do panelu admina</button>
    </a>
    <br>
    <br>
    <div class="card">
        <div class="card-header">Lista kursów</div>
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Organizator</th>
                    <th scope="col">Limit edycji</th>
                    <th scope="col">Zobacz</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <th scope="row">{{$course->id}}</th>
                        <td>{{$course->title}}</td>
                        <td>{{$course->organiser_name}}</td>
                        <td>{{$course->editions_limit}}</td>
                        <td>
                            <a href="/admin/kurs/{{$course->id}}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    {{ $courses->links() }}
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Dodawanie kursu</div>
        <div class="card-body">
            <form action="/admin/kursy/nowy" method="post">
                @csrf
                <div class="form-group">
                    <label>Tytuł</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>Nazwa organizatora</label>
                    <input type="text" class="form-control" name="organiser_name" required>
                </div>
                <div class="form-group">
                    <label>Adres organizatora</label>
                    <input type="text" class="form-control" name="organiser_url" required>
                </div>
                <div class="form-group">
                    <label>Opis</label>
                    <textarea type="text" class="form-control" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Limit edycji</label>
                    <input type="number" class="form-control" name="editions_limit" required min=1 value=100>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
@endsection