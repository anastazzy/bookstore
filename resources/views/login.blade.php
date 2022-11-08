@extends('layouts.default')

@section('content')
<body>
    <div class="w-50 p-3">
        <form method="POST">
            @csrf
            <div class="form-group">
                <label>Электронная почта</label>
                <input type="email" class="form-control" name="email"placeholder="мояпочта@mail.ru">
                <small id="emailHelp" class="form-text text-muted">Ваша почта будет использоваться каждый раз при входе на сайт</small>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password"  class="form-control" name="password" placeholder="пароль123">
            </div>
            <button type="submit" name="Login" class="btn btn-primary">Войти</button>
            <a class="btn btn-primary" href="register">Зарегистрироваться</a>
        </form>
    </div>
</body>
