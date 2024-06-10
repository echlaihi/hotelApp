@extends("admin.dashboard.layouts.app")

@section("content")

<div class="card p-0">
            <div class="card-header">
              <h3 class="p-2">Créer un chambre</h3>
            </div>

            <div class="card-body">
              <form enctype="multipart/form-data" action="{{ route('room.store') }}" method="POST"  class="form">

                @csrf
                <label for="name" class="p-2 mt-3">Image principale: </label>
                @error('image1')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="file" class="form-control" name="image1" value="{{ old('image1') }}">

                 <label for="name" class="p-2 mt-3">Image supplémentaire 1: </label>
                  @error('image2')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                <input type="file" class="form-control" name="image2" value="{{ old('image2') }}">

                 <label for="name" class="p-2 mt-3">Image supplémentaire 2: </label>

                  @error('image3')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <input type="file" class="form-control" name="image3" value="{{ old('image3') }}">

                 <label for="name" class="p-2 mt-3">Image supplémentaire 3: </label>
                  @error('image4')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <input type="file" class="form-control" name="image4" value="{{ old('image4') }}">


                {{-- <div id="addImage" class="text-dark btn btn-info mt-3">Ajouter Image</div>
                <br> --}}

                <label class="p-2 mt-3">Prix: </label>
                 @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <input type="text" name="price" class="form-control" value="{{ old('price') }}">

                <label  class="p-2 mt-3">Type: </label>

                 @error('type')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror   

                <input type="text" name="type" class="form-control" value="{{ old('type') }}">

                <label class="p-2 mt-3">Outils de comforts: </label>
                 @error('conforts')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <input type="text" name="conforts" class="form-control" value="{{ old('conforts') }}">

                <input type="submit" value="Enregister" class="btn btn-primary my-3">
              </form>
            </div>

          </div>

@endsection