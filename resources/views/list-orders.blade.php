@extends('layouts.default')

@section('content')
<div class="container">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Идентификатор</th>
        <th scope="col">Дата оформления</th>
        <th scope="col">Дата оплаты</th>
        <th scope="col">Подробнее</th>
        <th scope="col">Покупатель</th>
        <th scope="col">Статус</th>
      </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
      <tr>
        <th scope="row">{{$order->id}}</th>
        <td> {{$order->sale_date}}</td>
        <td> {{$order->placing_date}}</td>
        <td>
          @php
//          if ($order->id == 2){
//            dd($order->books);
//            }
             $sum = 0
          @endphp

          @foreach($order->books as $book)
            {{$book->name}}

            @php
              $sum += $book->sale_price
            @endphp
          @endforeach
          {{$sum}} <br>
        </td>
        <td> {{$order->user_id}}</td>
        <td> {{$order->status_id}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  </div>
</div>
@stop
