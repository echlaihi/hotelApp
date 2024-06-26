 @extends("layouts.main")

 @section("content")

    <main id="dashboard">
        <div class="wrapper">
                
                 @include("profile.aside")


                  <div class="container">
                        @if(count($messages))

                          @foreach($messages as $message)
                          <div class="card">

                              <button class="cardBtn">Voir plus</button>
                              {{-- <button class="read">marquer comme lu</button> --}}
                              
                              <div class="card-body"><b style="padding-right: 10px; ">récepteur :</b> {{ $message->receiver }}</div>
                              <div class="card-body"><b style="padding-right: 10px; ">émetteur  :</b>   {{ $message->receiver }}</div>
                              <div class="card-body"><b style="padding-right: 10px; ">titre du message :</b>  {{ $message->title }}</div>
                              <div class="card-body"><b style="padding-right: 10px; ">cops du message :</b>  {{ $message->body }}</div>
                              <div class="card-body"><b style="padding-right: 10px; ">envoyé : </b>   {{ $message->created_at->diffForHumans() }}</div>
                          </div>

                          @endforeach

                          {{ $messages->links() }}

                        @else
                            <div class="alert alert-danger">Auncun message {{ $type }}</div>
                        @endif

                        <section class="" id="contact">
                            <h2>Contacter l'administrateur</h2>
                            
                            <form action="{{ route('message.send') }}" method="POST">

                              @csrf
                                <fieldset>
                                <input type="text"  placeholder="Titre de votre message ..." name="title">
                                <input type="hidden"  value="{{ env('MAIL_FROM_ADDRESS') }}"  name="receiver">
                                <input type="hidden"  value="{{ Auth()->user()->email }}"  name="sender">
                                </fieldset>
                                 <fieldset>
                                <textarea  placeholder="Corps de votre message ..." name="body" rows="10">
                                </textarea>
                                </fieldset>
                                <fieldset><button>envoyer</button></fieldset>
                            </form>

                    </section>


                  </div>



        </div>
    </main>


 @endsection