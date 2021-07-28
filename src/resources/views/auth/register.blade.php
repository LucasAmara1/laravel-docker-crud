@include('layouts.head')

<body class="c-app flex-row align-items-center" cz-shortcut-listen="true">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div style="display: flex; justify-content: center;">
                    <a href="/">
                        <img src="{{asset('icons/group.svg')}}">
                    </a>
                </div>
                <div class="card-group" style="margin-top: 35px;">
                    <div class="card p-4 shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <h1 style="color:#254b75;">Cadastro</h1>
                                <p class="text-muted">Informe os dados para cadastro</p>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{asset('icons/user1.svg')}}">
                                        </span>
                                    </div>
                                    <input id="nome" type="text" name="nome" class="form-control" type="text" placeholder="Nome">
                                    <div>
                                        @error('nome')
                                        <small id="nome_aviso" class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{asset('icons/email.svg')}}">
                                        </span>
                                    </div>
                                    <input id="email" type="text" name="email" class="form-control" type="text" placeholder="Email">
                                    <div>
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
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Senha">
                                    <div>
                                        @error('password')
                                        <small id="senha_aviso" class="text-danger">
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
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmar Senha">
                                    <div>
                                        @error('password_confirmation')
                                        <small id="comfirmar_senha_aviso" class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-outline-light px-4" style="color:white; background-color: #487cb9; border-color: #487cb9;">Cadastrar</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="btn btn-link px-0" href="{{ route('login') }}"> Já possui cadastro?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>