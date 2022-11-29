@extends('layouts.default')

@section('content')
    <div class="container">
        <form class="row m-3 align-items-center">
            <div class="col-6 col-md-4 align-self-start">
                <picture class="rounded mx-auto d-block">
                    <img height="300" width="220" src="{{ Storage::url($book->file->path) }}">
                </picture>
                <div class="form-row">
                    <div class="form-group">
                        <label>Загрузить дргуое фото</label>
                        <input type="file" class="form-control-file" name="photo">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card  mb-3">
                    <div class="card-header border-success">
                        <input type="text" class="form-control card-title text-center" value="{{$book->name}}" name="name">
                    </div>
                    <div class="card-body row">
                        <div class="col-md-8">
                            Автор:
                            @foreach($book->authors as $author)
                                <h6>
                                    {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
                                </h6>
                            @endforeach

                            Жанры:
                            @foreach($book->genres as $genre)
                                <h7 class="text-info">
                                    {{$genre->name}}
                                </h7>
                            @endforeach
                        </div>
                        <div class="col-md-2 text-center text-success align-self-center">
                            <strong class="text-success">
                                {{ $book->sale_price }} ₽
                            </strong>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent ">
                        <div>
                            @php
                                $count = \App\Basket::getItemCount(Auth::id(), $book->id)
                            @endphp
                            <form method="POST">
                                @csrf
                                <div class="input-group mb-3 col-md-8 offset-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">В корзине</span>
                                    </div>
                                    <input type="number" name="count" min="0" value="{{$count}}" class="form-control" />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">Сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row m-3 align-items-center">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Описание
                </h5>
                <p class="card-text">
                    {{$book->description}}
                </p>
            </div>
        </div>
    </div>
@stop
