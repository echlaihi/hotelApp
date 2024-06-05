@extends("layouts.main")

@section("content")
    <main id="dashboard">

        <div class="wrapper">
                
               @include("profile.aside")


                  <div class="container">
                        
                    <section class="" id="edit-profile">
                            
                        <h2>Modifier le profile</h2>
                        <form class="" action="{{ route('profile.update') }}" method="POST">
                          @csrf
                          @method("PATCH")

                            <fieldset>

                             <fieldset>
                            <input type="text"  placeholder="Enterer Votre nouveau Prenom" name="first_name">
                            </fieldset>

                            <input type="text"  placeholder="Enterer Voter Nouveau nom" name="last_name">
                            </fieldset>
                            <fieldset><button>Enregisterer</button></fieldset>
                        </form>

                    </section>

                      <section class="" id="edit-profile">
                            <h2>Modifier le mot de passe</h2>
                            
                            <form class="{{ route('password.update') }}" method="POST">

                              @csrf
                              @method("PUT")

                                <fieldset>
                                <input type="text"  placeholder="Votre mot de passe actuel .." name="current_password">
                                </fieldset>
                                 <fieldset>
                                <input type="text"  placeholder="Nouveau mot de passe .." name="password">
                                </fieldset>
                                  <fieldset>
                                <input type="text"  placeholder="Confirmer votre nouveau mot de passe .." name="password_confirmation">
                                </fieldset>
                                <fieldset><button>Enregisterer</button></fieldset>
                            </form>

                    </section>

                  </div>

        </div>



    </main>





@endsection