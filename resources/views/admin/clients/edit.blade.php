@extends('app')

@section('content')
    <div class="container">
        <h3>Editar Cliente: {{ $client->name }}</h3>
        <br>

        @include('errors._check')

        {!! Form::model($client, ['route'=>['admin.clients.update', $client->id],'method'=>'PUT']) !!}
        @include('admin.clients._form')
        <div class="form-group">
            {!! Form::submit("Salvar cliente", ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection