@extends('layouts.default')

@section('content')
  @php
    $user = Auth::user();
  @endphp
  <div class="form container-width line centered">
    {{$user->last_name}}, Ваш заказ с номером - {{$orderId}} успешно оформлен!
  </div>
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
