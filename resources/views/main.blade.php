@extends('layouts.default')

@section('content')

@csrf
    <div class="row">
@foreach($items as $item)
    <div class="col-md-3">
        <div>
            YOUR IMAGE HERE
        </div>
        <div class="card">
            <img class="card-img-top" src="https://dictionary.cambridge.org/ru/images/thumb/shirt_noun_002_33400.jpg?version=5.0.273" alt="Card image cap">
            <div class="card-body">
                <p>{{$item}}</p>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
@endforeach
    </div>

@stop
