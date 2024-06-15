@extends("admin.dashboard.layouts.app")

@section("title", 'Chambres')

@section("content")

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

            <h3>Chambre</h3>


            <form>
            <input type="text" name="client_name" class="form-control ">
            <!-- <button type="submit"></button> -->
            </form>

      </div>

      <div class="card-body">
            @if(count($rooms))
            

                  <table class="table tabe-striped table-hover">
                  <thead>
                        <tr>
                              <th>Chambre id</th>
                              <th>Prix</th>
                              <th>Disponibilité</th>
                              <th>Type</th>
                              <th>Outils de comfort</th>
                              <th>Action</th>
                        </tr>
                  </thead>

                  <tbody>
                        @foreach($rooms as $room)
                              <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->price }}</td>
                                    <td>{{ $room->is_available }}</td>
                                    <td>{{ $room->type }}</td>
                                    <td>{{ $room->conforts }}</td>
                                    <td>
                                          <a href="{{ route('room.show', $room->id) }}" class="btn btn-sm btn-success">Voir</a>
                                          <a href="{{ route("room.edit", $room->id) }}" class="btn btn-sm btn-info">Modifer</a>

                                          <form  class="d-inline" action="{{ route('room.delete', $room->id) }}" 
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                
                                          <button onclick="
                                                if (confirm('Est ce que vous etre sur?')){
                                                      form.submit();
                                                }
                                          " class="btn btn-sm btn-danger">Supprimer</button>
                                          </form>
                                         
                                    </td>
                              </tr>
                        @endforeach
                  </tbody>
                  </table>


                  {{-- <ul class="pagination">
                        <li class="page-item"><a href="#" class="page-link">previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">next</a></li>
                  </ul> --}}

                  {{ $rooms->links() }}
            
                  @else 
                              <div class="alert alert-danger">Aucun chambre trouveé</div>
                  @endif

            </div>
      





 </div>


@endsection