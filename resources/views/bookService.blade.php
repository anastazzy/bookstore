@extends('layouts.default')

@section('content')

@csrf
<div class="bg-light justify-content-around row border border-secondary p-2">
    <button data-toggle="modal" data-target="#modal-create-book" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить книгу</button>
    <button data-toggle="modal" data-target="#modal-create-author" class="btn btn-outline-success my-2 my-sm-0" type="submit">Добавить автора</button>
    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Удалить товар</button>
{{--    <form class="form-inline">--}}
{{--        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>--}}
{{--    </form>--}}
</div>
    <div class="row p-2">
@foreach($books as $book)
        <div class="col-md-2">
            <div class="card">
                @php
                    $file = \App\Models\File::query()->find($book->file_id)
                @endphp
                <img class="card-img-top" src="{{ Storage::url($file->path) }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text"> {{$book->name}}</p>
                    <p class="card-text"> {{$book->sale_price}}</p>
                </div>
{{--                <button class="btn btn-outline-info my-1 my-sm-0" style="background: url(myimage.png)" type="submit"></button>--}}
            </div>
        </div>
@endforeach
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
