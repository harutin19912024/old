<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Throwable;

class DocumentController extends Controller
{
    private static $currentYearId = NULL;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        if (!self::$currentYearId) {
            $currentYear = SchoolYear::where('is_current', 1)->first();
            self::$currentYearId = $currentYear->id;
        }
    }

}
