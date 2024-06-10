 <section id="reservation-form">

        <div class="wrapper">
                    <h2>Réserver</h2>
            <form action="{{ route("reservation.make", $room->id) }}" enctype="multipart/form-data" method="POST">

                @csrf
                <fieldset>
                    <label>date de dépard</label>
                    <input type="date" name="date_depart">
                </fieldset>

                  <fieldset>
                   <!-- <div class="form-group"> -->
                        <label>date de fin</label>
                        <input type="date" name="date_fin">
                   </fieldset>
                   
                
                @if($room->capacity() > 1)
                <fieldset>
                <!-- <div class="form-group"> -->
                     <label>Prenom de votre partenaire</label>
                     <input type="text" name="partner_first_name">
                </fieldset>
                   <fieldset>
                   <!-- <div class="form-group"> -->
                        <label>Nom de votre partenaire</label>
                        <input type="text" name="partner_last_name">
                   </fieldset>

                    <fieldset>
                   <!-- <div class="form-group"> -->
                        <label>Cin de votre partenaire</label>
                        <input type="text" name="partner_cin">
                   </fieldset>

                    <fieldset>
                   <!-- <div class="form-group"> -->
                        <label>Contract de marriage</label>
                        <input type="file" name="marriage_contract">
                   </fieldset>

                  

                   @endif





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
                    <button type="submit" name="submit">Réserver</button>
                </fieldset>

            </form>

        </div>
    
        
   </section>