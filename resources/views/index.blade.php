@extends('layouts.default')

@section('content')
<body>
    <div>
        Добро пожаловать в интернет-магазин книг!
        Для входа в систему перейдите по ссылке ниже
    </div>
    <a href={{url('/login')}}>Войти</a>
</body>
