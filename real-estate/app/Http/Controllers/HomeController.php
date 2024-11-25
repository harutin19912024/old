<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;

class HomeController extends Controller
{
    protected $paginationCount = 2;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Deal::paginate($this->paginationCount);
        return view('home')
             ->with('data', $data);
             
    }
}
