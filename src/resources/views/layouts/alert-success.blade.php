@if(session('mensagem'))
<div class="alert alert-success">
    <p>{{session('mensagem')}}</p>
</div>
@endif