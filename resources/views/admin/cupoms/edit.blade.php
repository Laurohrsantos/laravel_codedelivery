@extends('app')

@section('content')
    <div class="container">
        <h3>Editar Cupom: {{ $cupom->name }}</h3>
        <br>

        @include('errors._check')

        {!! Form::model($cupom, ['route'=>['admin.cupoms.update', $cupom->id],'method'=>'PUT']) !!}
        @include('admin.cupoms._form')
        <div class="form-group">
            {!! Form::submit("Salvar cupom", ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection