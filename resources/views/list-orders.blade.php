@extends('layouts.default')

@section('content')
  <div class="form container-width">
    <div class="form-row form-group col-md-12">
      <div class="input-group col-md-4">
      Поиск по идентификатору заказа:
      </div>
      <div class="input-group col-md-4">
        <input class="form-control mr-sm-2" id="search" type="search" placeholder="Введите id заказа" aria-label="Search">
        <button onclick="search()" class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
      </div>
    </div>
  </div>
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Идентификатор</th>
        <th scope="col">Дата оформления</th>
        <th scope="col">Дата оплаты</th>
        <th scope="col">Состав</th>
        <th scope="col">Покупатель</th>
        <th scope="col">
          <select onchange="onStatusChange(arguments[0])" class="form-select" aria-label="Default select example">
            @foreach($statuses as $status)
              <option @if($currentStatus == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
          </select>
        </th>
      </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
      <tr>
        <th scope="row">{{$order->id}}</th>
        <td> {{date_format($order->sale_date, 'd.m.Y')}}</td>
        <td>
          @if($order->placing_date)
            {{date_format($order->placing_date, 'd.m.Y')}}
          @endif
        </td>
        <td>
          @foreach($order->books as $book)
            <div>
              {{$book->name}}
            </div>
            <div class="text-success">
              цена: {{$book->sale_price}}*{{$book->pivot->count}} шт.<br>
            </div>
          @endforeach
            @php
              $sum = 0;
             foreach($order->books as $book){
                 $sum += $book->sale_price * $book->pivot->count;
             }
            @endphp
            <div class="text-danger">
              Стоимость: {{$sum}}
            </div>
        </td>
        <td> {{$order->user->last_name}}</td>
        <td>
          <form method="POST" action="{{url('/orders/edit-status/')}}">
            @csrf
            <div class="form-group">
              <button class="btn btn-success dropdown-toggle" type="button"
                      id="sampleDropdownMenu" data-toggle="dropdown">
                {{$order->status->name}}
              </button>
              <div class="dropdown-menu">
                @foreach($statuses as $status)
                    @if($status->id != 0)
                      <button class="dropdown-item"
                        name="status_id"
                        value="{{$status->id}}"
                        id="{{$status->id}}"
                        type="submit">
                          {{$status->name}}
                      </button>
                    @endif
                @endforeach
              </div>
              <input type="hidden" name="order_id" value="{{$order->id}}" />
            </div>
          </form>
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

  const search = function (){
    const str = document.getElementById('search').value;

    const url = new URL(location.href)
    url.searchParams.set("id", str)
    window.location.replace(url);
  }
</script>
