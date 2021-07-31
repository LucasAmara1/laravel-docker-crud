@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Ops!</strong> Tivemos algum problema com seus dados.
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif