@extends('layouts.default')

@section('content')
  @php
    $user = Auth::user();
  @endphp
  <div class="form container-width line centered">
    {{$user->first_name}}, Ваш заказ с номером - {{$orderId}} успешно оформлен!
  </div>
@stop

