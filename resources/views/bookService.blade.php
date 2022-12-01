@extends('layouts.default')

@section('content')

@csrf
<div class="bg-light justify-content-around row border border-secondary p-2">
    <button data-toggle="modal" data-target="#modal-create-book" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить книгу</button>
    <button data-toggle="modal" data-target="#modal-create-author" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить автора</button>
    <button onclick="location.href='orders'" class="btn btn-outline-info my-2 my-sm-0" type="submit">Управление заказами</button>
</div>
@php
    $user = Auth::user();
@endphp
    <div class="row p-2">
        <x-list-books-for-service :books="$books"></x-list-books-for-service>
    </div>
    <div class="modal fade" id="modal-create-book" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <x-create-book></x-create-book>
    </div>
    <div class="modal fade" id="modal-create-author" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <x-create-author></x-create-author>
    </div>
@stop

@push('scripts')
@endpush
