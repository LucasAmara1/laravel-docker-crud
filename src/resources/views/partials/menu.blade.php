<link rel="stylesheet" href="{{ asset('css/switchery.css') }}">
<script type="text/javascript" src="{{ asset('js/switchery.js') }}"></script>

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <img src="{{asset('icons/group.svg')}}" width="75px" alt="Logo">
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/dashboard">
                <i class="fas fa-home c-sidebar-nav-icon"></i>
                Inicio
            </a>
        </li>
        <li class="c-sidebar-nav-title">Gestão</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link " href="/">
                <i class="fas fa-capsules c-sidebar-nav-icon"></i>
                Produtos
            </a>
        </li>
        <li class="c-sidebar-nav-title">USUÁRIO</li>
        <li class="c-sidebar-nav-item">
            <form class="" method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="c-sidebar-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt c-sidebar-nav-icon"></i>
                    Sair
                </a>
            </form>
        </li>
    </ul>
</div>