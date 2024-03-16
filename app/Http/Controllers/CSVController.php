<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSVController extends Controller
{
    /**
     * convert csv to array
     */
    public function convertCSVToArray(Request $request) 
    {
        dd($request->all());
    }
}
