@if(count($reservations))
 
    @foreach($reservations as $reservation)
        <div class="reservation">
                        <div class="reservationBtn">Voir plus</div>
                        <div class="reservation-field">
                            <strong>Date de début : </strong> 
                            {{-- {{ dd($reservation) }} --}}
                             <p>{{ $reservation->start_date }}</p>
                        </div>

                        <div class="reservation-field">
                            <strong>Date de fin : </strong> 
                            <p>{{ $reservation->end_date }}</p>
                        </div>
                        <div class="reservation-field">
                            <strong>type de chambre</strong> 
                            <p>{{ $reservation->room()->get()[0]->type }} </p>
                        </div>



                        <div class="reservation-field">
                            <strong>État de réservation : </strong> 
                            <p>{{ $reservation->status }}</p>
                        </div>


                        @if($reservation->room()->get()[0]->type != "single")
                            <div class="reservation-field">
                                <strong>Nom de votre artenaire : </strong> 
                                <p>{{ $reservation->partner->last_name }}</p>
                            </div>

                            <div class="reservation-field">
                                <strong>Prenom de votre partenaire : </strong> 
                                <p>{{ $reservation->partner->first_name }}</p>
                            </div>

                            <div class="reservation-field">
                                <strong>Numéro de cin de votre partenaire : </strong> 
                                <p>{{ $reservation->partner->cin }}</p>
                            </div>

                            {{-- {{"contract" . $reservation }} --}}
                        <iframe src="{{ asset("storage/contracts/" . $reservation->marriage_contract) }}" width="600" height="400"></iframe>
                        
                        @endif


                    </div>

    @endforeach

@else

<div class="alert alert-danger">Aucune réservation</div>
@endif