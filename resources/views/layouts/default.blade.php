<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="{{ URL::asset('bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('app.css')}}" type="text/css">
    <script type="text/javascript" src="{{ URL::asset('jquery.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('popper.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('bootstrap.js')}}"></script>
    @stack('scripts')
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Буквожуй</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Каталог<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Корзина</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="book-service">Управление</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Администратор</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
<div class="container">
    @yield('content')
</div>
</body>
