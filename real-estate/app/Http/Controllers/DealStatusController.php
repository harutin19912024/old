<?php

namespace App\Http\Controllers;

use App\DealStatus;
use Illuminate\Http\Request;
use Validator;

class DealStatusController extends Controller
{
    protected $paginationCount = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DealStatus::paginate($this->paginationCount);
        return view('deal-status/index')
             ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deal-status/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/deal-status/create')
                ->withErrors($validator)->withInput();
        }
        DealStatus::create($request->all());
        
        return redirect('/deal-status');
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
     * @param  \App\DealStatus  $dealStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(DealStatus $dealStatus)
    {
        return view('deal-status/add')->with('data', $dealStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DealStatus $dealStatus)
    {
        $rules = array(
            'name' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('deal-status.edit', ['id' => $dealStatus->id])
                ->withErrors($validator)->withInput();
        }
        $dealStatus->update($request->all());

        return redirect('/deal-status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
