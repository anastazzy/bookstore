@extends('layouts.default')

@section('content')
  <div class="form container-width">
    <div class="form-row  form-group col-md-12">
      Добрый день, {{Auth::user()->first_name}}! Сегодня {{date('d.m.Y',strtotime(date('d-m-Y')))}}
    </div>
    <div class="form-row form-group col-md-12">
      <form method="POST" class="col-md-12" action="{{url('/sum-by-period')}}">
        @csrf
        <div class="form-row form-group col-md-12">
          <div class="form-group col-md-12">
            <label>Траты в интервале</label>
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
    </div>
  </div>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Идентификатор</th>
        <th scope="col">Дата оформления/оплаты</th>
        <th scope="col">Стоимость</th>
        <th scope="col">Состав</th>
        <select onchange="onStatusChange(arguments[0])" class="form-select" aria-label="Default select example">
          @foreach($statuses as $status)
            <option @if($currentStatus == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
        <th scope="col">
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
      <tr class="line">
        <th scope="row">{{$order->id}}</th>
        <td>
          @if($order->status->id == 3)
            {{date_format($order->placing_date, 'd.m.Y')}}
          @else
            {{date_format($order->sale_date, 'd.m.Y')}}
          @endif
        </td>
        <td>
          @php
          $sum = 0;
            foreach($order->books as $book){
                $sum += $book->sale_price * $book->pivot->count;
            }
          @endphp
          {{$sum}}
        </td>
        <td>
          @foreach($order->books as $book)
            <div>
              {{$book->name}}
            </div>
          <div class="text-success">
            цена: {{$book->sale_price}},{{$book->pivot->count}} шт.<br>
          </div>
          @endforeach
        </td>
        <td>
          <div class="form-group">
            {{$order->status->name}}
          </div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@stop


<script>
  const onStatusChange = function (ev){
    const url = new URL(location.href)
    url.searchParams.set("status", ev.target.value)
    window.location.replace(url);
  }

  const setDate = function () {
        $('#setterDate').submit()
  }
</script>

<style>
  .line {
    outline: 1px solid #6c757d;
  }
</style>
