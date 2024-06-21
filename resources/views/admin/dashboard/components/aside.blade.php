 <aside id="aside" class="border d-flex flex-column flex-shrink-0 p-2 bg-body-tertiary" style="width: 280px; ">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="{{ route("room.index") }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
          Home
        </a>
      </li>
      <li>
        <a href="{{ route("admin.dashboard") }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
          Overview
        </a>
      </li>

       <li>
        <a href="{{ route("admin.reservations.list") }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"/></svg>
          Réservations
        </a>
      </li>

      <li>
        <a href="{{ route("admin.users.list") }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
          Clients
        </a>
      </li>

        <li class="py-0 nav-link link-body-enphasis nav-link">
      <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#rooms-collapse" aria-expanded="false">
          Chambres
        </button>
        <div class="collapse" id="rooms-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
             <li>
                <a href="{{ route("admin.rooms.list") }}" class="nav-link link-body-emphasis">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                  Toutes les chambres
                </a>
              </li>

               <li>
                  <a href="{{ route("room.create") }}" class="nav-link link-body-emphasis">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                    Ajouter une Chambre
                  </a>
                </li>

          </ul>
        </div> 
      </li>


        <li class="py-1 nav-link link-body-enphasis nav-link">
      <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#messages-collapse" aria-expanded="false">
          Messages
        </button>
        <div class="collapse" id="messages-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
             <li>
                <a href="{{ route("messages.list", ['type' => 'sent']) }}" class="nav-link link-body-emphasis">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                  Messages envoyées
                </a>
              </li>

               <li>
                  <a href="{{ route("messages.list", ['type' => 'received']) }}" class="nav-link link-body-emphasis">
                    <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                    Messages reçu
                  </a>
                </li>

          </ul>
        </div> 
      </li>

     

      


      <li>
        <a href="{{ route("profile.edit") }}" class="nav-link link-body-emphasis">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
          Paramètres 
        </a>
      </li>


      <li class="pl-5 nav-link link-body-emphasis">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn d-inline-flex align-items-center rounded border-0">Se déconnecter</button>
            </form>
      </li>


    </ul>
  </aside>  



 
  {{-- <aside class="flex-shrink-0 p-3 bg-light border" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
      <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-5 fw-semibold">Dashboard</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
      <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
          Home
        </button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Updates</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Reports</a></li>
          </ul>
        </div> 
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Dashboard
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Weekly</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Monthly</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Annually</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Orders
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Processed</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Shipped</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Returned</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Account
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">New...</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Profile</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Settings</a></li>
            <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Sign out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </aside> --}}