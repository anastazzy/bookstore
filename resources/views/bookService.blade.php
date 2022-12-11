@extends('layouts.default')

@section('content')

@csrf
<div class="bg-light justify-content-around row border border-secondary p-2">
    <button data-toggle="modal" data-target="#modal-create-book" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить книгу</button>
    <button data-toggle="modal" data-target="#modal-create-author" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить автора</button>
    <button onclick="location.href='orders'" class="btn btn-outline-info my-2 my-sm-0" type="submit">Управление заказами</button>
</div>
<div class="form container-width">
  <div class="form-row form-group col-md-12">
    <div class="input-group col-md-4">
      Поиск по названию, или описанию книги:
    </div>
    <div class="input-group col-md-4">
      <input class="form-control mr-sm-2" id="search" type="search" placeholder="Введите значение поиска" aria-label="Search">
      <button onclick="search()" class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
    </div>
  </div>
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

<script>
  const search = function (){
    const str = document.getElementById('search').value;

    const url = new URL(location.href)
    url.searchParams.set("search", str)
    window.location.replace(url);
  }
</script>
