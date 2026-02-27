<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">MarketKatering</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                {{-- Guest --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest

                {{-- Auth --}}
                @auth
                    {{-- Merchant --}}
                    @if (auth()->user()->role === 'merchant')
                        <li class="nav-item">
                            <a class="nav-link" href="/merchant">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/merchant/profile">Profil</a>
                        </li>
                    @endif

                    {{-- Customer --}}
                    @if (auth()->user()->role === 'customer')
                        <li class="nav-item">
                            <a class="nav-link" href="/customer">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/menus">Menu</a>
                        </li>
                    @endif

                    {{-- Logout --}}
                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
