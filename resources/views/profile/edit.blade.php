@extends("layouts.main")

@section("content")
    <main id="dashboard">

        <div class="wrapper">
                
               @include("profile.aside")


                  <div class="container">
                        
                          <section class="" id="edit-profile">
                            
                            <h2>Modifier le profile</h2>
                            <form class="" method="POST">
                                <fieldset>
                                <input type="text"  placeholder="Enter you new name .." name="">
                                </fieldset> <fieldset>
                                <input type="text"  placeholder="Enter you new Email .." name="">
                                </fieldset>
                                <fieldset><button>Enregisterer</button></fieldset>
                            </form>

                    </section>

                      <section class="" id="edit-profile">
                            <h2>Modifier le mot de passe</h2>
                            
                            <form class="" method="POST">
                                <fieldset>
                                <input type="text"  placeholder="Votre mot de passe actuel .." name="">
                                </fieldset>
                                 <fieldset>
                                <input type="text"  placeholder="Nouveau mot de passe .." name="">
                                </fieldset>
                                  <fieldset>
                                <input type="text"  placeholder="Confirmer votre nouveau mot de passe .." name="">
                                </fieldset>
                                <fieldset><button>Enregisterer</button></fieldset>
                            </form>

                    </section>

                  </div>

        </div>



    </main>





@endsection