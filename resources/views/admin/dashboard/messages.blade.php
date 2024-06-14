@extends('admin.dashboard.layouts.app')

@section("content")

   <div class="card p-0 mb-5 ">

                <div class="card-header d-flex justify-content-between">
                    <h3>Messages {{ $type }}</h3>
                </div>
                <div class="card-body">

                    @if(count($messages))

                          @foreach($messages as $message)
                          <div class="card">
                              <div class="card-body message">
                                    <button class="cardBtn btn btn-sm btn-info">Voir plus</button>
                              {{-- <button class="read">marquer comme lu</button> --}}
                              
                              <div class="card-text"><b style="padding-right: 10px; ">récepteur :</b> {{ $message->receiver }}</div>
                              <div class="card-text"><b style="padding-right: 10px; ">émetteur  :</b>   {{ $message->receiver }}</div>
                              <div class="card-text"><b style="padding-right: 10px; ">titre du message :</b>  {{ $message->title }}</div>
                              <div class="card-text"><b style="padding-right: 10px; ">cops du message :</b>  {{ $message->body }}</div>
                              <div class="card-text"><b style="padding-right: 10px; ">envoyé : </b>   {{ $message->created_at->diffForHumans() }}</div>
                                </div>
                          </div>

                          @endforeach

                          <div class="mt-4">{{ $messages->links() }}</div>

                        @else
                            <div class="alert alert-danger">Auncun message {{ $type }}</div>
                        @endif

                </div>

    </div>

    <style>

        .cardBtn{
            position: absolute;
            top: .5rem;
            right: .5rem;
        }

        .card-text{
            padding: .5rem;
        }

        .card{
            position: relative;

        }

        .message{
            height: 2.8rem;
            overflow-y: hidden;
            border: 1px solid black; 
            padding: 0;
        }

        .open{
            height: fit-content;
        }

    </style>



    {{-- contacter un utilisateur --}}
    <div class="card p-0 mb-5">
        <div class="card-header p-4"><h3>Contacter un utilisateur</h3></div>

        <div class="card-body">
            <form class="form" action="{{ route('message.send') }}" method="POST">
                @csrf

                <fieldset class="mt-3">
                     <label class="m-1">récepteur</label>
                    <input  class="form-control" type="text" name="receiver">
                    <input type="hidden" name="sender" value="{{ env('MAIL_FROM_ADDRESS') }}">
                </fieldset>

                <fieldset class="mt-3">
                     <label class="m-1">Titre de votre message</label>
                    <input  class="form-control" type="text" name="title">
                </fieldset>

                <fieldset class="mt-3">
                     <label class="m-1">Votre message</label>
                    <textarea class="form-control" rows="7" name="body"></textarea>
                </fieldset> 

                <fieldset class="mt-3">
                    <button class="btn btn-primary">Envoyer</button>
                </fieldset>

            </form>
        </div>
    </div>

        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
     <script src="https://kit.fontawesome.com/99d030ebb4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>


@endsection