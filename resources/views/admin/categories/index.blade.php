@extends('app')

@section('content')
    <div class="container">
        <h3>Categorias</h3>
        <br>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-default">Nova Categoria</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="{{route('admin.categories.destroy', $category->id)}}" class="btn btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $categories->render() !!}
    </div>

@endsection