<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests\AdminCupomRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\CupomRepository;
use Illuminate\Http\Request;

class CupomsController extends Controller
{
    private $cupomRepository;

    public function __construct(CupomRepository $cupomRepository)
    {
        $this->cupomRepository = $cupomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupoms = $this->cupomRepository->paginate();
        return view('admin.cupoms.index', compact('cupoms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cupoms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AdminCupomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCupomRequest $request)
    {
        $this->cupomRepository->create($request->all());
        return redirect()->route('admin.cupoms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cupom = $this->cupomRepository->find($id);

        return view('admin.cupoms.edit', compact('cupom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AdminCupomRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCupomRequest $request, $id)
    {
        $this->cupomRepository->update($request->all(), $id);
        return redirect()->route('admin.cupoms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cupomRepository->delete($id);
        return redirect()->route('admin.cupoms.index');
    }
}
