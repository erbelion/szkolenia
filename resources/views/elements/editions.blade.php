@foreach ($editions as $edition)
<div class="card">
    <div class="card-header">Kurs "{{$edition->title}}"</div>
    <div class="card-body">
        Edycja nr. {{$edition->edition_no}}
        <h1>{{$edition->subtitle}}</h1>

        Sponsor:
        <a href="{{$edition->organiser_url}}">{{$edition->organiser_name}}</a>
        <br><br>

        Opis kursu:
        <br>
        {{$edition->main_description}}
        <br><br>

        Opis edycji:
        <br>
        {{$edition->description}}
        <br><br>

        Użytkownicy:
        {{$edition->users_count}}/{{$edition->users_limit}}
        <br>

        Ramy czasowe:
        {{$edition->start_date}} - {{$edition->end_date}}
        <br> <br>

        <a href="/edycja/{{$edition->id}}">
            <button class="btn btn-primary">Cena: {{$edition->price / 100}} PLN</button>
        </a>
    </div>
</div>
@endforeach