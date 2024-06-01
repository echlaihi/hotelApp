@extends('layouts.main')

@section("content")

 <div class="wrapper">

            <section id="chambre">
                        <!-- <button>Réserver</button> -->

                <div id="grid-images">
                  <img id="main-image" src="images/room2.jpg">
                    <img src="images/room2.jpg">
                    <img src="/images/chambre1/chambre1_bain.webp">
                    <img src="/images/chambre1/chambre1_tele.jpg">
                    <!-- <img src="images/room2.jpg"> -->
                </div>

                <div class="description">
                    <p class="price">{{ $room->price }}DH</p>
                    <p class="type"><span>Single:</span> une chambre pour 1 personne</p>
                    <!-- <p class="price">Disponibilié</p> -->
                    <ul>
                        <li>Télévision</li>
                        <li>Bain</li>

                    </ul>
                </div>

                <button>Réserver</button>
            </section>


             <section id="reservation-form">

        <div class="wrapper">
                    <h2>Réserver</h2>
            <form>

                <fieldset>
                  <!--   <label for="email">chambre id: asad-34d-df </label>
                    <label for="">Client nom: abdelghani</label>
                    <label for="">Client prenom: echlaihi</label>
                    <label for="">Client email: abdelghani.echlaihi@gmail.com</label>
                    <label>type: double</label>
                    <label>nombre de personne: 3</label> -->
                    <!-- <div class="form-group"> -->
                            <label>date de dépard</label>
                            <input type="date" name="date_depart">
                    <!-- </div> -->
                </fieldset>
                   
                   <fieldset>
                   <!-- <div class="form-group"> -->
                        <label>date de fin</label>
                        <input type="date" name="date_fin">
                   </fieldset>



                    <!-- <input type="email" name="email"> -->
                </fieldset>
                    <button id="PayOnline">Payer on line? </button>

                <fieldset>
                    <label for="message">Numero de carte crédit :</label>
                    <input type="text" name="text" id="">
                </fieldset>

                <div>
                    <fieldset> <label>Date d'expiration: </label>
                    <input type="text" placeholder="MM/AA"></fieldset>
                   
                   <fieldset> <label for="CVV">CVV</label>
                    <input type="" name="" placeholder="CVV"></fieldset>
                </div>

                <fieldset>
                    <label>Titulaire de la carte</label>
                    <input type="text" name="name">
                </fieldset>

                <fieldset>
                    <button type="submit" name="submit">Login</button>
                </fieldset>

            </form>

        </div>
    
        
   </section>


    </div>

@endsection