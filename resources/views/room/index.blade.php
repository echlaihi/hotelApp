@extends("layouts.main")
@section("content")
    
        <section id="banner">

            <div class="wrapper">
                <h1>Hôtel flambant neuf qui sort de l'ordinaire</h1>
            </div>
       </section>
    
       <section id="rooms">
           <div class="wrapper">
                <h1>Notre chambres</h1>

                @if(count($rooms))
               <div class="container">


                    @foreach($rooms as $room)
                        <div class="room">
                            <img src="{{ asset("/storage/images/" . $room->initial_image->name) }}" alt="">

                                <div class="meta">
                                    <p>chambre pour {{ $room->capacity() }} personne(s)</p>
                                        <a href="{{ route('room.show', $room->id) }}">voir details</a>
                                </div>
                        </div>
                    @endforeach
               

               </div>

                @else

                <div class="alert alert-danger">Aucun chambre trouvée.</div>

                @endif
                

            </div>

       </section>

       <section id="contact">

            <div class="wrapper">
                        <h1>Contacter Nous</h1>
                <form action="{{ route('message.send') }}" method="POST">
                    @csrf


                    <fieldset>
                        <label for="email">Votre email: </label>
                        @error("sender")
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="email" name="sender" value="{{ old("sender") }}">
                        <input type="hidden" name="receiver" value="{{ env("MAIL_FROM_ADDRESS") }}">
                    </fieldset>

                     <fieldset>
                        <label>Votre titre de message: </label>
                        @error("title")
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="title" value="{{ old("title") }}">
                    </fieldset>

                    <fieldset>
                        <label for="message">Votre message: </label>

                        @error("body")
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <textarea name="body" id="" cols="30" rows="10" >{{ old("body") }}</textarea>
                    </fieldset>

                    <fieldset>
                        <button type="submit" name="submit">Envoyer</button>
                    </fieldset>

                </form>

            </div>
        
            
       </section>


       <section id="about">
            <div class="wrapper">

                <h1>À propos de notre hôtel</h1>

<p>

Bienvenue à  Hotel, votre havre de paix au cœur de béni mellal. Que vous voyagiez pour affaires ou pour le plaisir, notre hôtel vous offre un cadre élégant et confortable pour vous détendre et recharger vos batteries.

Notre histoire

Hotel a été fondé en 2000 par ABDELGHANI ECHLAIHI avec la vision de créer un lieu d'accueil chaleureux et raffiné pour les voyageurs. Depuis lors, nous sommes devenus une référence dans la région, réputés pour notre service attentionné et notre engagement envers le confort de nos clients.

Notre emplacement

Situé à béni mellal, Hotel bénéficie d'un emplacement idéal pour découvrir les charmes de . Que vous souhaitiez explorer les sites historiques, vous adonner aux plaisirs du shopping ou profiter de la gastronomie locale, tout est à portée de main.

</p>
            </div>
       </section>



    </main>


@endsection