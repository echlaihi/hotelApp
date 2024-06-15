@extends("admin.dashboard.layouts.app")

@section("title", "")
@section("content")
<div class="card ">
                <div class="card-header m-0">
                  <h4 class="py-2">Overview</h4>
                </div>

                    <div class="card-body d-flex justify-content-around row">

                          <div class="col-sm-2 col-xs-5 well p-3">
                          <h1><i class="fa-solid fa-user"></i></h1>
                          <h4>Clients</h4>

                          {{ $num_users }}
                          </div>

                          <div class="col-sm-2 col-xs-5 well p-3">
                            <h1><i class="fa-solid fa-bed"></i></h1>
                            <h4>Chambres</h4>

                            {{ $num_rooms }}
                          </div>

                          <div class="col-sm-2 col-xs-5 well p-3">
                            <h1><i class="fa-regular fa-note-sticky"></i></h1>
                            <h4>Réservations</h4>
                            {{ $num_reservations }}
                            
                          </div>




                          <div class="col-sm-2 col-xs-5 well p-3">
                            <h1><i class="fa-regular fa-message"></i></h1>
                            <h4>Messages</h4>
                              {{ $num_messages }}
                          </div>










                    </div>

            </div>
@endsection