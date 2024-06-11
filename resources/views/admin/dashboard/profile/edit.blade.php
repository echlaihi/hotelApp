@extends("admin.dashboard.layouts.app")

@section("content")

        <div class="card p-0">
                    <div class="card-header">
                    <h3 class="p-2">Profile</h3>
                    </div>

                    <div class="card-body">
                    <form action="{{ route("profile.update") }}" method="post" class="form">

                        @csrf
                        @method("PATCH")
                        <label  lass="p-2">Prenom: </label>

                        @error("first_name")
                            <div class="alert alert-danger">{{ $message }}</div>    
                        @enderror
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">

                        <label class="p-2">Nom: </label>

                        @error("last_name")
                            <div class="alert alert-danger">{{ $message }}</div>    
                        @enderror
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">

                        <input type="submit" value="Enregister" class="btn btn-primary my-3">
                    </form>
                    </div>

        </div>


          <div class="card p-0 my-2">
            <div class="card-header">
              <h3 class="p-2">Modifier password</h3>
            </div>

            <div class="card-body">
              <form action="{{ route("password.update") }}" method="POST" class="form">

                @csrf
                @method("PUT")
                <label for="current password" class="p-2">Mot de passe actuel: </label>
                <input type="text" class="form-control" name="name">

                <label class="p-2">Nouveau mot de passe: </label>

                @error("password")
                    <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
                <input type="password" name="password" class="form-control" id="">

                <label class="p-2">Comfirmer votre mot de passe: </label>
                <input type="password" name="password_confirmation" class="form-control" id="">



                <input type="submit" value="Enregister" class="btn btn-primary my-3">
              </form>
            </div>

          </div>

@endsection

