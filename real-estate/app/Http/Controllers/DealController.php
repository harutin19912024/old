<?php

namespace App\Http\Controllers;

use App\Deal;
use App\DealStatus;
use App\DealParty;
use App\DealParticipant;
use Illuminate\Http\Request;
use Validator;
use Auth;

class DealController extends Controller
{
    protected $paginationCount = 1;
    protected $decimal_regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Deal::paginate($this->paginationCount);
        return view('deal/index')
             ->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dealStatuses = DealStatus::orderBy('name')->get();
        $dealParty = DealParty::orderBy('name')->get();
        
        return view('deal/add')
                ->with('dealStatuses', $dealStatuses)
                ->with('dealParty', $dealParty);
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
            'type' => 'required',
            'property_address' => 'required|max:191',
            'mls' => 'required|max:191',
            'price' => array('required','regex:'. $this->decimal_regex),
            'seller_commision' => array('required','regex:'. $this->decimal_regex),
            'buyer_commision' => array('required','regex:'. $this->decimal_regex),
            'offer_date' => 'required|date_format:m/d/Y',
            'inspection_date' => 'required|date_format:d/m/Y H:i:s',
            'pns_date' => 'required|date_format:d/m/Y H:i:s',
            'mortage_contingency_date' => 'required|date_format:d/m/Y H:i:s',
            'closing_date' => 'required|date_format:d/m/Y H:i:s',
            'deal_status_id' => 'required|integer',
            'email' => 'required|email',
        );
        $validator = Validator::make($request->all(), $rules);
//        $errors = $validator->errors();
        
         $data = $request->all();
         $data['user_id'] = Auth::user()->id;
         $data['inspection_passed'] = isset($data['inspection_passed'])?$data['inspection_passed']:0;
         $data['pns_passed'] = isset($data['pns_passed'])?$data['pns_passed']:0;
         $data['mortage_contingency_passed'] = isset($data['mortage_contingency_passed'])?$data['mortage_contingency_passed']:0;
        
        if ($validator->fails()) {
            return redirect('/deals/create')
                ->withErrors($validator)->withInput();
        }
        $deal = Deal::create($data);
        if(!empty($request['deal_participants'])){
            foreach ($request['deal_participants'] as $participant_id) {
                $dealParticipant = [
                    'deal_id' => $deal->id,
                    'deal_parties_id' => $participant_id
                ];
                DealParticipant::create($dealParticipant);
                
            }
        }
        
        
        return redirect('/deals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        $dealStatuses = DealStatus::orderBy('name')->get();
        $dealParty = DealParty::orderBy('name')->get();
        return view('deal/add')
                ->with('dealStatuses', $dealStatuses)
                ->with('dealParty', $dealParty)
                ->with('data', $deal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        $rules = array(
            'type' => 'required',
            'property_address' => 'required|max:191',
            'mls' => 'required|max:191',
            'price' => array('required','regex:'. $this->decimal_regex),
            'seller_commision' => array('required','regex:'. $this->decimal_regex),
            'buyer_commision' => array('required','regex:'. $this->decimal_regex),
            'offer_date' => 'required|date_format:m/d/Y',
            'inspection_date' => 'required|date_format:d/m/Y H:i:s',
            'pns_date' => 'required|date_format:d/m/Y H:i:s',
            'mortage_contingency_date' => 'required|date_format:d/m/Y H:i:s',
            'closing_date' => 'required|date_format:d/m/Y H:i:s',
            'deal_status_id' => 'required|integer',
            'email' => 'required|email',
        );
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->route('deals.edit', ['id' => $deal->id])
                ->withErrors($validator)->withInput();
        }
//        dd($request->all());
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['inspection_passed'] = isset($data['inspection_passed'])?$data['inspection_passed']:0;
        $data['pns_passed'] = isset($data['pns_passed'])?$data['pns_passed']:0;
        $data['mortage_contingency_passed'] = isset($data['mortage_contingency_passed'])?$data['mortage_contingency_passed']:0;
        $deal->update($data);
        DealParticipant::where('deal_id',$deal->id)->delete();
        if(!empty($request['deal_participants'])){
            foreach ($request['deal_participants'] as $participant_id) {
                $dealParticipant = [
                    'deal_id' => $deal->id,
                    'deal_parties_id' => $participant_id
                ];
                DealParticipant::create($dealParticipant);
                
            }
        }
        
        return redirect('/deals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->route('deals.index');
    }
}
