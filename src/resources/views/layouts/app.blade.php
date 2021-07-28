<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="c-app">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
                <img width="20px" src="{{asset('icons/bars-solid.svg')}}" alt="">
            </button>
            {{-- <ul class="c-header-nav d-md-down-none" style="font-weight: 600;">
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{route('dashboard')}}">Inicio</a></li>
                <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{route('dashboard')}}">Produtos</a></li>
            </ul> --}}
        </header>
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script type="text/javascript" defer src="{{ asset('js/all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/coreui.bundle.min.js') }}" defer></script>
</body>

</html>