  <aside class="admin-aside">
                    <form action="" id="search-form">
                        <input type="text" placeholder="search">
                        <button type="submit"></button>
                    </form>

                    <!-- <img src="images/Layer 93.jpg" alt=""> -->

                    <h3>Dashboard</h3>
                        <ul>
                            <li><a href="{{ route('login') }}">Résérvations
                            </a></li>
                            <li><a href="{{ route('profile.edit') }}">Parametre</a></li>
                            <li><a href="{{ route('room.index') }}">Réserver</a></li>
                            <li><a href="{{ route('messages.list', ['type' => 'sent']) }}">Méssages envoyées</a></li>
                            <li><a href="{{ route('messages.list', ['type' => 'received']) }}">Méssages recu</a></li>
                            <li>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <button>logout</button>
                                </form>
                            </li>
                        </ul>
</aside>