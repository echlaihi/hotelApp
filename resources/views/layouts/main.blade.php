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
            <li><a href="{{ route("room.index") }}">Accueil</a></li>
            <li><a href="">About</a></li>
            <li><a href="#">Contact</a></li>

            @if(Auth::check())
                <li><a href="{{ route("user.dashboard") }}">Dashboard</a></li>

                @if(Auth::user()->is_admin) 
                    <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @endif
            @else
                <li><a href="{{ route("login") }}">Connexion</a></li>
                <li><a href="{{ route("register") }}">S'inscrir</a></li>
            @endif
        </ul>
    </nav>

    <!-- social media -->

    <main>

      @yield("content")

    </main>
    <footer>
        <div class="wrapper">        <p>abdelghani echlaihi &copy; right 2024,All right reserved</p>
        </div>
    </footer>

    {{-- <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> --}}

     <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>
</html>
</html>
