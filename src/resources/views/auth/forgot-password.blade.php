@include('layouts.head')

<body class="c-app flex-row align-items-center" cz-shortcut-listen="true">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div style="display: flex; justify-content: center;">
                    <a href="/">
                        <img src="{{asset('icons/group.svg')}}">
                    </a>
                </div>
                <div class="card-group" style="margin-top: 35px;">
                    <div class="card p-4 shadow-sm p-3 mb-5 bg-white rounded">
                        <div class="card-header" style="background-color: white; border: none;">
                            <h2 style="color:#254b75;">Esqueci minha senha</h2>
                            <p class="text-muted" style="margin-top: 1rem; font-size: 16px;">Enviaremos um link de recuperação por
                                email para você redefinir sua senha.</p>
                        </div>
                        <div class="card-body" style="padding-top: 0.5rem; padding-bottom: 0.5rem;">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <img src="{{asset('icons/email.svg')}}">
                                        </span>
                                    </div>
                                    <input id="email" type="text" name="email" class="form-control" type="text"
                                        placeholder="Email">
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 text-right">
                                        <button class="btn px-4" type="submit"
                                            style="color:white; background-color: #487cb9; border-color: #487cb9;">Redefinir
                                            Senha</button>
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