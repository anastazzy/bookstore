@extends('layouts.default')

@section('content')
    <form class="form container-width" method="POST">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                Описание:
            </div>
            <div class="col">
                Количество товара:
            </div>
        </div>
        @foreach($books as $book)
            @csrf
            <div class="row m-3">
                <div class="col-md-3 centered">
                    <picture class="rounded mx-auto d-block">
                        <img height="120" width="90" src="{{ Storage::url($book->file->path) }}" />
                    </picture>
                </div>
                <div class="col">
                    <h5>
                        {{$book->name}}
                    </h5>
                    @foreach($book->authors as $author)
                        <h6>
                            {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
                        </h6>
                    @endforeach
                </div>
                <div class="col-md-3 justify-content-between">
                    {{$book->count}}
                    <div onclick="">
                        редактировать
                    </div>
                </div>
            </div>
        @endforeach
        <button class="btn btn-outline-success my-2 my-sm-0" name="ProcessOrder" type="submit">Оформить заказ</button>
    </form>



@stop

<style>
    .centered{
        display: flex;
        align-items: center;
    }
</style>
