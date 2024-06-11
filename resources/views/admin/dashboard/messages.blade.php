@extends('admin.dashboard.layouts.app')

@section("content")

   <div class="card p-0 mb-5 ">

                <div class="card-header d-flex justify-content-between">
                    <h3>Messages</h3>
                </div>
                <div class="card-body">

                    @if(count($messages))

                             <div class="accordion" id="accordionExample">

                        @foreach($messages as $msg)
                            <div class="accordion-item my-3">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $msg->id }}" aria-expanded="true">
                                        {{ $msg->title }} recu par {{ $msg->sender }} le {{ $msg->created_at }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $msg->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {{ $msg->body }}
                                </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $messages->links() }}
                    </div>

                    @else 
                        <div class="alert alert-danger">Aucun messages</div>
                    @endif

                </div>

    </div>

@endsection