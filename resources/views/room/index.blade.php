@extends("layouts.main")
@section("content")
    
    
       <section id="rooms">
           <div class="wrapper">
                <h1>Our Rooms</h1>

               <div class="container">

                @if(count($rooms))

                    @foreach($rooms as $room)
                        <div class="room">
                            <img src="images/room2.jpg" alt="">
                                <div class="meta">
                                    <p>chambre pour 2 personne</p>
                                        <a href="{{ route('room.show', $room->id) }}">voir details</a>
                                </div>
                        </div>
                    @endforeach
                @else

                <div class="alert alert-danger">Aucun chambre trouvée.</div>

                @endif

               </div>
                

            </div>

       </section>

       <section id="contact">

            <div class="wrapper">
                        <h1>Contact Us</h1>
                <form>

                    <fieldset>
                        <label for="name">Votre Nom: </label>
                        <input type="text" name="name">
                    </fieldset>

                    <fieldset>
                        <label for="email">Votre email: </label>
                        <input type="email" name="email">
                    </fieldset>

                    <fieldset>
                        <label for="message">Votre message: </label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </fieldset>

                    <fieldset>
                        <button type="submit" name="submit">Envoyer</button>
                    </fieldset>

                </form>

            </div>
        
            
       </section>


       <section id="about">
            <div class="wrapper">

                <h1>About Us</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam repellendus aliquam impedit iste accusantium quia quae voluptate quaerat, nihil maiores ea error necessitatibus voluptas voluptatibus in suscipit tenetur quidem fugit repellat obcaecati quo doloribus qui illum! Blanditiis ipsam laboriosam recusandae, eaque libero cum tempora, unde beatae dolores sequi repellendus quasi! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vel, autem?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis hic ipsa, aliquid voluptate sapiente aliquam possimus libero accusamus sint ea consequatur iusto vel ullam a nam iste nulla? Soluta, accusantium.lore Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam corrupti maxime enim libero incidunt numquam a laudantium, provident molestiae pariatur animi, vero aut architecto odit id consequuntur at! Recusandae sunt dolor cum, modi aut illum fugiat eos soluta dicta id iste consectetur corporis totam ratione corrupti iure ipsa qui officiis. Neque voluptate quis exercitationem rem, incidunt est adipisci optio iusto?
            </p>

            </div>
       </section>



    </main>


@endsection