@extends('layouts.base')

@section('body')

<Form name="raports" action="RaportsController.php" method="post">
    <p>Start date: <input type="data" name="Start date" /></p>
    <p>End date: <input type="data" name="End date" /></p>

    <p><input type="submit" name="submit" value="confirm"/></p>

    
    


@endsection