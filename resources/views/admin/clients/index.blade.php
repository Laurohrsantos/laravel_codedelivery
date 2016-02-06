@extends('app')

@section('content')
    <div class="container">
        <h3>Clientes</h3>
        <br>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo Cliente</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->state }}</td>
                    <td>
                        <a href="{{route('admin.clients.edit', $client->id)}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="{{route('admin.clients.destroy', $client->id)}}" class="btn btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $clients->render() !!}
    </div>

@endsection