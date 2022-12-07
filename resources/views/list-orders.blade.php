@extends('layouts.default')

@section('content')
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Идентификатор</th>
        <th scope="col">Дата оформления</th>
        <th scope="col">Дата оплаты</th>
        <th scope="col">Стоимость</th>
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
          @php
           $sum = 0;
          foreach($order->books as $book){
              $sum += $book->sale_price * $book->pivot->count;
          }
          @endphp
          {{$sum}}
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
  const updateStatus = function(ev){

  }
</script>
