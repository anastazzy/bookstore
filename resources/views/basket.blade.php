@extends('layouts.default')

@section('content')
  @php
    $sum = 0
  @endphp
  @if(count($books) <= 0)
    Корзина пуста!
  @else
  <div class="form container-width">
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
      <div class="row m-3 line">
        <div class="col-md-3 centered">
          <picture class="rounded mx-auto d-block">
            <img height="120" width="90" src="{{ Storage::url($book->file->path) }}"/>
          </picture>
        </div>
        <div class="col-md-4">
          <h5>
            {{$book->name}}
          </h5>
          @foreach($book->authors as $author)
            <h6>
              {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
            </h6>
          @endforeach
          <h7>
            Цена: {{$book->sale_price}}
          </h7>
          <h7>
            Остаток на складе: {{$book->warehousesCount}}
          </h7>
        </div>
        <div class="col-md-5">
          <form method="POST" action="{{url('/basket/update-count/' . $book->id)}}">
            @csrf
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">В корзине</span>
              </div>
              <input type="number" name="count" min="0" value="{{$book->count}}" max="{{$book->warehousesCount}}" class="form-control"/>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Сохранить</button>
              </div>
            </div>
          </form>
          <form method="POST" action="{{url('/basket/delete/' . $book->id)}}">
            @csrf
            <div class="input-group mb-3">
              <div class="input-group-append">
                <button class="btn btn-outline-danger" type="submit">Удалить товар</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @php
      $sum += $book->sale_price * $book->count
      @endphp
      @endforeach
    <div class="row m-3">
      <label>
        Стоимость заказа: {{$sum}}
      </label>
      <form  method="POST">
        @csrf
        <button class="btn btn-outline-success my-2 my-sm-0 " name="ProcessOrder" type="submit">
          Оформить заказ
        </button>
      </form>

      <form method="POST" action="{{url('/basket/clear')}}">
        @csrf
        <button class="btn btn-outline-danger my-2 my-sm-0 " name="ClearBasket" type="submit">
          Очистить корзину
        </button>
      </form>
    </div>
  </div>
  @endif
@stop

<style>
  .centered {
    display: flex;
    align-items: center;
  }
  .line{
    box-shadow: 0 6px 4px -4px rgba(0, 0, 0, .2);
  }
</style>
