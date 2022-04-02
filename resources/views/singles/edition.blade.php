@extends('layouts.base')

@section('body')
<div class="card">
    <div class="card-header">Edycja kursu "{{$edition->course->title}}"</div>
    <div class="card-body">
        Edycja nr. {{$edition->edition_no}}
        <h1>{{$edition->subtitle}}</h1>

        Sponsor:
        <a href="{{$edition->course->organiser_url}}">{{$edition->course->organiser_name}}</a>
        <br><br>

        Opis kursu:
        <br>
        {{$edition->course->description}}
        <br><br>

        Opis edycji:
        <br>
        {{$edition->description}}
        <br><br>

        Uczestnicy:
        {{$edition->users_count}}/{{$edition->users_limit}}
        <br>

        Ramy czasowe:
        {{$edition->start_date}} - {{$edition->end_date}}
        <br> <br>

        @if($isUserStudent)
            Zakupiono dostęp!
        @else
            <form action="/edycja/{{$edition->id}}/kup" method="post">
                @csrf
                <input type="submit" class="btn btn-primary" value="Kup dostęp za {{$edition->price/100}} PLN">
            </form>
        @endif
    </div>
</div>

@if($isUserStudent)
    <div class="card">
        <div class="card-header">Lista spotkań</div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Tytuł</th>
                    <th scope="col">Start</th>
                    <th scope="col">Miejsce</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($meetings as $meeting)
                    <tr>
                        <td>{{$meeting->title}}</td>
                        <td>{{$meeting->start_date}}</td>
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
        <div class="card-header">Lista uczestników</div>
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">E-mail</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif


@endsection