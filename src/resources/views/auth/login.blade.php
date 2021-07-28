@include('layouts.head')

<body class="c-app flex-row align-items-center" cz-shortcut-listen="true">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div style="display: flex; justify-content: center;">
                    <a href="/">
                        <img src="{{asset('icons/group.svg')}}">
                    </a>
                </div>
                <div class="card-group" style="margin-top: 35px;">
                    <div class="card m-auto col-6 align-content-center p-4 shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h1 style="color:#254b75;">Login</h1>
                                <p class="text-muted">Entre na sua conta</p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{asset('icons/email.svg')}}">
                                        </span>
                                    </div>
                                    <input id="email" type="text" name="email" value="{{old('email')}}"
                                        class="form-control" type="text" placeholder="Email">
                                    <div class="container">
                                        @error('email')
                                        <small id="email_aviso" class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{asset('icons/key.svg')}}">
                                        </span>
                                    </div>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Senha">
                                    <div class="container">
                                        @error('password')
                                        <small id="senha_aviso" class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-outline-light px-4"
                                            style="color:white; background-color: #487cb9; border-color: #487cb9;">Login</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="btn btn-link px-0" href="{{ route('password.request') }}"> Esqueceu a
                                            senha?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card p-4 shadow-sm p-3 bg-white rounded" style="width:50%">
                        <div class="card-body text-center mt-4">
                            <div>
                                <h3 class="mt-5" style="color:#254b75;">Ainda não possui cadastro?</h3>
                                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mt-4"
                                    style="color:white; background-color: #487cb9; border-color: #487cb9;">Cadastre-se
                                    agora!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
