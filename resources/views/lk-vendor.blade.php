@extends('layouts.default')

@section('content')
<div class="form container-width">
  <div class="form-row form-group col-md-12">
    Добрый день, {{Auth::user()->first_name}}! Сегодня {{date('d.m.Y',strtotime(date('d-m-Y')))}}
  </div>
    <form method="POST" action="{{url('/profit')}}">
      @csrf
          <div class="form-row form-group col-md-12">
            <div class="form-group col-md-12">
              <label>Прибыль в интервале</label>
            </div>
            <div class="col-md-3">
              <div class="input-group">
                <label class="input-group-prepend input-group-text">
                  Старт
                </label>
                <input class="input-group-append" type="date" name="startDate">
              </div>
            </div>
            <div class="col-md-3">
              <div class="input-group">
                <label class="input-group-prepend input-group-text">
                  Конец
                </label>
                <input class="input-group-append" type="date" name="endDate">
              </div>
            </div>
            <button type="submit" class="col-md-2">
              Узнать
            </button>
          </div>
          @if(isset($profit))
            <div class="form-group col-md-6">
              <label>составила: {{$profit}} ₽</label>
            </div>
          @endif
      </form>

    <form method="POST" action="{{url('/rating')}}">
      @csrf
      <div class="form-row form-group col-md-12">
        <div class="form-group col-md-12">
          <label>Рейтинг товаров</label>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <label class="input-group-prepend input-group-text">
              Старт
            </label>
            <input class="input-group-append" type="date" name="startDate">
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <label class="input-group-prepend input-group-text">
              Конец
            </label>
            <input class="input-group-append" type="date" name="endDate">
          </div>
        </div>
        <button type="submit" class="col-md-2">
          Узнать
        </button>
      </div>
        @if(isset($rating))
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Идентификатор</th>
                <th scope="col">Сумма</th>
              </tr>
            </thead>
            <tbody>
            @php
              $index = 0;
            @endphp
            @foreach(new LimitIterator(new ArrayIterator($rating), 0, 3) as $key => $val)
              @php
              $book = \App\Models\Book::whereId($key)->firstOrFail();
              $index += 1;
              @endphp
              <tr>
                <th scope="row">{{$index}}</th>
                <td>{{$book->name}}</td>
                <td>{{$key}}</td>
                <td>{{$val['profit']}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </form>
</div>
@stop

