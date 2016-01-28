@extends('app')

@section('content')
    <div class="container">
        <h3>Editar Produto: {{ $product->name }}</h3>
        <br>

        @include('errors._check')

        {!! Form::model($product, ['route'=>['admin.products.update', $product->id],'method'=>'PUT']) !!}
        @include('admin.products._form')
        <div class="form-group">
            {!! Form::submit("Salvar produto", ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection