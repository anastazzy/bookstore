@extends('layouts.default')

@section('content')
<body>
<div class="align-self-center">
    <h4>Введите данные для регистрации:</h4>
    <form class="has-required w-50 p-3" method="POST" oninput='password2.setCustomValidity(password2.value != password.value ? "Passwords do not match." : "")'>
        @csrf
        <div class="form-group has-validation">
            <label class="required">Фамилия</label>
            <input required type="text" class="form-control" name="last_name">
            <div class="invalid-feedback">
                Введите фамилию
            </div>
        </div>
        <div class="form-group">
            <label class="required">Имя</label>
            <input required type="text" class="form-control" name="first_name">
            <div class="invalid-feedback">
                Введите имя
            </div>
        </div>
        <div class="form-group">
            <label>Отчество</label>
            <input type="text" class="form-control" name="patronymic">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Дата рождения</label>
                <input type="date" name="birthday" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label class="required">Номер телефона</label>
                <input required type="tel" name="phone" class="form-control">
                <div class="invalid-feedback">
                    Введите номер телефона
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required">Электронная почта</label>
                <input required type="email" class="form-control" name="email" placeholder="мояпочта@mail.ru">
                <div class="invalid-feedback">
                    Введите эл. почту
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required">Введите пароль</label>
                <input required type="password"  class="form-control" name="password" placeholder="пароль123">
                <div class="invalid-feedback">
                    Введите пароль
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="required">Подтвердите пароль</label>
                <input type="password"  class="form-control" name="password2" placeholder="пароль123">
            </div>
        </div>
        <input class="btn btn-primary" type="submit" name="Save" value="Сохранить">
    </form>
</div>
</body>
@stop

