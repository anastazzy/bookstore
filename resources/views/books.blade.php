@extends('layouts.default')

@section('content')
    @csrf
    <div class="row">
        <x-list-books :books="$books"></x-list-books>
    </div>

@stop
