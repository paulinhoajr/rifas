<footer class="footer d-flex flex-wrap justify-content-between align-items-center py-2 my-1 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img src="{{ asset('images/favicons/apple-touch-icon.png') }}" alt="" width="60"/>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">{{ config('app.name') }}
            {{ date('Y') }} &copy; Desenvolvido por <a href="https://www.voope.com.br" target="_blank">Voope</a>
        </span>
    </div>
{{--
    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#icon_twitter"/></svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#icon_instagram"/></svg></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#icon_facebook"/></svg></a></li>
    </ul>
    --}}
</footer>

