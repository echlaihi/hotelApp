<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Headers · Bootstrap v5.3</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/"> -->



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

      <link href="/css/bootstrap5.3.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<header class="p-2 mb-3 border-bottom"><!-- ===== header ================================================================================================== -->
    <div class="container">

      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <!-- <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a> -->

        <div class="d-block" id="toggler">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
              </svg>
        </div>

        <!-- <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
        </ul> -->

        <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form> -->

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
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
