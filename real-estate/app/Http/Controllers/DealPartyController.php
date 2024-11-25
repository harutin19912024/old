<?php

namespace App\Http\Controllers;

use App\DealParty;
use Illuminate\Http\Request;
use Validator;

class DealPartyController extends Controller
{
    protected $paginationCount = 1;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DealParty::paginate($this->paginationCount);
        return view('deal-parties/index')
             ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deal-parties/add');
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
            'email' => 'required|email',
            'office_phone_number' => 'required|max:191|string',
            'cell_phone_number' => 'required|max:191|string',
            'role' => 'required',
            'address1' => 'required|max:191|string',
            'address2' => 'required|max:191|string',
            'city' => 'required|max:191|string',
            'state' => 'required|max:191|string',
            'zip_code' => 'required|max:191|string',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/deal-parties/create')
                ->withErrors($validator)->withInput();
        }
        DealParty::create($request->all());
        
        return redirect('/deal-parties');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DealParty  $dealParty
     * @return \Illuminate\Http\Response
     */
    public function show(DealParty $dealParty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DealParty  $dealParty
     * @return \Illuminate\Http\Response
     */
    public function edit(DealParty $dealParty)
    {
        return view('deal-parties/add')->with('data', $dealParty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DealParty  $dealParty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DealParty $dealParty)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'office_phone_number' => 'required|max:191|string',
            'cell_phone_number' => 'required|max:191|string',
            'role' => 'required',
            'address1' => 'required|max:191|string',
            'address2' => 'required|max:191|string',
            'city' => 'required|max:191|string',
            'state' => 'required|max:191|string',
            'zip_code' => 'required|max:191|string',

        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/deal-parties/create')
                ->withErrors($validator)->withInput();
        }
        $dealParty->update($request->all());

        return redirect('/deal-parties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DealParty  $dealParty
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealParty $dealParty)
    {
        $deal->delete();
        return redirect()->route('deals.index');
    }
}
