@extends('layouts.main')

@section("content")

 <div class="wrapper">

            <section id="chambre">
                        <!-- <button>Réserver</button> -->

                <div id="grid-images">


                    @if($initial_image)
                        <img id="main-image" src="{{ asset('storage/images/'. $initial_image->name) }}">
                    @endif
                    @if( count($images) )

                        @foreach($images as $image)
                        <img src="{{ asset('storage/images/' . $image->name) }}">
                        @endforeach
                    @endif
                </div>

                <div class="description">
                    <p class="price">{{ $room->price }}DH</p>
                    <p class="type"><span>{{ $room->type }} </span>Une chambe pour {{ $room->capacity() }} personne(s)</p>
                    <!-- <p class="price">Disponibilié</p> -->
                    <ul>
                        <li>Télévision</li>
                        <li>Bain</li>

                    </ul>
                </div>

                <button id="reserveBtn">Réserver</button>
            </section>


            @include("components.reservationForm")


    </div>

@endsection