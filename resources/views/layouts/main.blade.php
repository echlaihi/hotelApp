<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/main.css') }}" >        
    </head>
    <body>

    <header>

        <div class="icon-toggler">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>

        <div class="logo">
            <span>H</span>otel
        </div>

        <form><input type="text"></form>

    </header>

    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </nav>

    <!-- social media -->

    <main>

      @yield("content")

    <footer>
        <div class="wrapper">        <p>abdelghani echlaihi &copy; right 2024,All right reserved</p>
        </div>
    </footer>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/app.js"></script>
    
</body>
</html>
</html>
