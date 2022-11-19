@extends('layouts.default')

@section('content')

<div class="row m-3 align-items-center">
    <div class="col-6 col-md-4">
        <picture class="rounded mx-auto d-block">
            <img class="card-img-top" height="400" width="100%" src="{{ Storage::url($book->file->path) }}">
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
            <div>
                В корзине <span> {{ \App\Basket::getItemCount(Auth::id(), $book->id) }} </span> шт.
                <form method="POST">
                    @csrf
                    <label>
                        <input type="number" name="count" placeholder="Количество"/>
                    </label>
                    <input type="submit" value="Добавить в корзину">
                </form>
            </div>

        </div>

    </div>
</div>
@stop
