@extends('layouts.default')

@section('content')
<body>
    <div>
        Добро пожаловать в интернет-магазин книг!
        Для перехода в личный кабинет нажмите на ссылку ниже
    </div>
    <a href={{url('/login')}}>Войти</a>
</body>
