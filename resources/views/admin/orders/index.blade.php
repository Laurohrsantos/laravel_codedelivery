@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br>
        <a href="{{ route('admin.orders.create') }}" class="btn btn-default">Novo Pedido</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Entregador</th>
                <th>Total</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->name}}</td>
                    <td>{{ $order->deliveryman->name}}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{route('admin.orders.edit', $order->id)}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="{{route('admin.orders.destroy', $order->id)}}" class="btn btn-sm btn-danger">Remover</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $orders->render() !!}
    </div>

@endsection