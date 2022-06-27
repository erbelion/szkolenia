@extends('layouts.base')

@section('body')

<form name="raports" action="/admin/zarobki" method="post">
    @csrf
    <p>Start date: <input type="datetime-local" name="start_date" /></p>
    <p>End date: <input type="datetime-local" name="end_date" /></p>

    <p><input type="submit" name="submit" value="confirm"/></p>
</form>
    
    


@endsection