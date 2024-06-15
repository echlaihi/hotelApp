<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    {{-- <script src="../assets/js/color-modes.js"></script> --}}

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.122.0">
        <link rel="icon" href="/images/favicon.ico" type="image/icon ico">

    <title>Hotel dashboard | @yield("title") </title>

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">  --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"> --}}

      <link href="/css/bootstrap5.3.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="p-2 mb-3 border-bottom bg-secondary"><!-- ===== header ================================================================================================== -->
    <div class="container">

      <div class="d-flex flex-wrap align-items-center justify-content-between">

        <div class="d-block" id="toggler">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
              </svg>
        </div>

        <div class="dropdown text-center text-light font-weight-bold h4">
          Bienvenu {{ Auth::user()->first_name }}
        </div>
      </div>

    </div>
</header><!-- end Header ============================================================================================================ -->

  @include("admin.dashboard.components.aside")

  <main class="">

      <section class="container">

        <div class="row">

          @yield("content")
            
        </div>

      </section>

  </main>

  <footer>
    <p>abdelghaniechlaihi &copy; all right reserved</p>
  </footer>

  <script src="/js/jquery-3.7.1.min.js"></script>
  <script src="/js/bootstrap5.3.min.js"></script>
  <script src="/js/script.js"></script>
  <script src="https://kit.fontawesome.com/99d030ebb4.js" crossorigin="anonymous"></script>
</body>
</html>
