@extends("admin.dashboard.layouts.app")

@section("content")
<style>
    iframe{
        margin-bottom: 1rem;
        width: 100%;
        height: 40rem;
    }

    .iframeBtn{
        max-width: 5rem;
    } 

    .contract_area{
        display: none;
    }

    .open{
        display: block;
    }
    
    
</style>
                  <div class="contract_area"><button class="btn btn-danger btn-sm">fermer</button><iframe src="http://127.0.0.1:8000/storage/contracts/aqIzH6U8PAcHnKDHBUH2cEnYNcATGAFk27o1ZoxD.pdf"  class="close" {{-- width="1200" height="500" --}}></iframe></div>

 <div class="card p-0 mb-5 ">

      <div class="card-header d-flex justify-content-between">


            <div class="d-flex">

            <select name="" id="" class="form-control">

                  <option value="">10 per page</option>

                  <option value="">20 per page</option>

                  <option value="">30 per page</option>

                  <option value="">40 per page</option>

                  <option value="">50 per page</option>

            </select>

            </div>

            <h3>Réservations: </h3>


            <form>
            <input type="text" name="client_name" class="form-control ">
            <!-- <button type="submit"></button> -->
            </form>

      </div>

      <div class="card-body" style="overflow: scroll;">

        <style>
            td, th{
                white-space: nowrap;
            }
        </style>

                @if(count($reservations))

                <table  class="table tabe-striped table-hover">
                  <thead>
                        <tr>
                            <th>reservation id</th>
                            <th>email du client</th>
                            <th>nom du client</th>
                              <th>nom client</th>
                              <th>partnaire nom</th>
                              <th>date</th>
                              <th>date debut</th>
                              <th>date fin</th>
                              <th>chambre id</th>
                              <th>type de chambre</th>
                              <th>etat de reservation</th>
                              <th>contract de marriage</th>

                              {{-- <th>Outils de comfort</th>--}}
                              <th>Action</th>  
                        </tr>
                  </thead>

                  <tbody>
                        @foreach($reservations as $reservation)
                              <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->user->email }}</td>
                                    <td>{{ $reservation->user->first_name }}</td>
                                    <td>{{ $reservation->user->last_name }}</td>
                                    <td>{{ $reservation->partner }}</td>
                                    {{-- <td>{{ $reservation->partner }}</td> --}}
                                    <td>{{ $reservation->created_at->format('Y-m-d')  }}</td>
                                    <td>{{ $reservation->start_date }}</td>
                                    <td>{{ $reservation->end_date }}</td>
                                    <td>{{ $reservation->room->id }}</td>
                                    <td>{{ $reservation->room->type }}</td>
                                    <td>{{ $reservation->status }}</td>
                                    <td><button data="{{ $reservation->marriage_contract }}" class="marriageBtn btn btn-sm btn-info">voir contract de marriage</button></td>
                                    <td class="d-flex">
                                        <form  class="mx-1" action="#">
                                            <button class="btn btn-sm btn-danger">supprimer</button>
                                        </form>
                                        <form action="#">
                                            <button class="btn btn-sm btn-info">activer</button>
                                        </form>
                                    </td>

                                    </td>
                              </tr>
                        @endforeach
                  </tbody>
                  </table>


                  {{ $reservations->links() }}

                @else 
                              <div class="alert alert-danger">Aucun client trouveé</div>
                  @endif

            </div>
      





    </div>


@endsection