@extends('layouts.default')

@section('content')
<body>
<div class="align-self-center">
    <h4>Введите данные для регистрации:</h4>
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger align-middle">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="w-50 p-3" method="POST">
        @csrf
        <div class="form-group">
            <label>Фамилия</label>
            <input type="text" class="form-control" name="last_name" placeholder="Иванов">
        </div>
        <div class="form-group">
            <label>Имя</label>
            <input type="text" class="form-control" name="first_name" placeholder="Иван">
        </div>
        <div class="form-group">
            <label>Отчество</label>
            <input type="text" class="form-control" name="patronymic" placeholder="Иванович">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Дата рождения</label>
                <input type="date-local" name="birthday" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Номер телефона</label>
                <input type="tel" name="phone" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Электронная почта</label>
                <input type="email" class="form-control" name="email" placeholder="мояпочта@mail.ru">
            </div>
            <div class="form-group col-md-6">
                <label>Пароль</label>
                <input type="password"  class="form-control" name="password" placeholder="пароль123">
            </div>
        </div>
        <input class="btn btn-primary" type="submit" name="Save" value="Сохранить">
    </form>
</div>
</body>
@stop
