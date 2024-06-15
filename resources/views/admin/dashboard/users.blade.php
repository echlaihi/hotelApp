@extends("admin.dashboard.layouts.app")

@section("title", "Clients")
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

            <h3>Clients: </h3>


            <form>
            <input type="text" name="client_name" class="form-control ">
            <!-- <button type="submit"></button> -->
            </form>

      </div>

      <div class="card-body">

 @if(count($users))
            

                  <table class="table tabe-striped table-hover">
                  <thead>
                        <tr>
                            <th>Prenom</th>
                            <th>Nom</th>
                              <th>Email</th>
                              <th>Membre depuis</th>
                              {{-- <th>Outils de comfort</th>--}}
                              <th>Action</th> 
                        </tr>
                  </thead>

                  <tbody>
                        @foreach($users as $user)
                              <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    {{-- <td>{{ $user->conforts }}</td> --}}
                                    <td>

                                          {{-- <form  class="d-inline" action="{{ route('profile.destroy', $user->id) }}" 
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                
                                          <button onclick="
                                                if (confirm('Est ce que vous etre sur?')){
                                                      form.submit();
                                                }
                                          " class="btn btn-sm btn-danger">Supprimer</button>
                                          </form> --}}
                                          actions
                                         
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

                  {{ $users->links() }}
            
                  @else 
                              <div class="alert alert-danger">Aucun client trouveé</div>
                  @endif

            </div>
      





 </div>

@endsection