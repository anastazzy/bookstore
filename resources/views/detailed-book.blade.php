@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row m-3 align-items-center">
            <div class="col-6 col-md-4 align-self-start">
                <picture class="rounded mx-auto d-block">
                    <img class="card-img-top" height="400" width="200" src="{{ Storage::url($book->file->path) }}">
                </picture>
            </div>
            <div class="col-12 col-md-8">
                <div>
                    <h2>
                        {{$book->name}}
                    </h2>
                    @foreach($book->authors as $author)
                        <h4>
                            {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
                        </h4>
                    @endforeach
                    <h6>
                        {{$book->description}}
                    </h6>
                </div>
                <div>
                    @php
                        $count = \App\Basket::getItemCount(Auth::id(), $book->id)
                    @endphp
                    {{--                В корзине <span> {{ $count }} </span> шт.--}}
                    <form method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">В корзине</span>
                            </div>
                            <input type="number" name="count" value="{{$count}}" class="form-control" />
                            {{--                        <label class="form-label" for="typeNumber">Number input</label>--}}
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
