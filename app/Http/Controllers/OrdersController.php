<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{
    private $orderRepository;
    private $userRepository;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->paginate();
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminOrderRequest $request)
    {
        $this->orderRepository->create($request->all());
        return redirect()->route('admin.orders.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_status = [0=>'Pendente',1=>'A caminho',2=>'Entregue',3=>'Cancelado'];
        $order = $this->orderRepository->find($id);

        $deliveryman = $this->userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminOrderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminOrderRequest $request, $id)
    {
        $this->orderRepository->update($request->all(), $id);
        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->orderRepository->delete($id);
        return redirect()->route('admin.orders.index');
    }
}
