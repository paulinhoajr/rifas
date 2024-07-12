<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="{{ route('site.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="{{ asset('images/favicons/apple-touch-icon.png') }}" alt="" width="60"/>
        <span class="fs-4 ms-4">{{ config('app.name') }}</span>
    </a>

    <ul class="nav nav-pills">

        <li class="nav-item">
            <a href="{{ route('site.index') }}" class="nav-link {{ setActive('home') }}">Inicial</a>
        </li>



        @if(Auth::check())

            <li class="nav-item">
                <a href="{{ route('site.usuarios.campanhas') }}" class="nav-link {{ setActive('usuarios/campanhas') }}">Minhas Campanhas</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('site.usuarios.edit') }}" class="nav-link {{ setActive('usuarios/edit') }}">Meus Dados</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('usuario.logout') }}" class="nav-link">Sair</a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link {{ setActive('login') }}">Entrar</a>
            </li>
        @endif

        <li class="nav-item">
            <a href="https://wa.me/5554981037463" class="nav-link" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
        </li>

        <li class="nav-item">
            <a href="https://www.instagram.com/" class="nav-link" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        </li>

    </ul>

</header>
