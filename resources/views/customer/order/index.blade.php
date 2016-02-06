@extends('app')

@section('content')
    <div class="container">
        <h3>Meus Pedidos</h3>
        <br>

        <a href="{{route('customer.order.create')}}" class="btn btn-default">Novo pedido</a>
        <br><br>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Total</td>
                <td>Items</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total }}</td>
                <td>
                    @foreach($order->items as $item)
                        <li>{{$item->product->name}}</li>
                    @endforeach
                </td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {!! $orders->render() !!}

    </div>
@endsection