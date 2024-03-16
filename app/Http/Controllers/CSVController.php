<?php

namespace App\Http\Controllers;

use App\Http\Requests\csvFileValidation;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    /**
     * convert csv to array
     */
    public function convertCSVToArray(csvFileValidation $request) : string
    {
        // dd($request->hasFile("file"));
        // dd($request->file("file"));
        // dd($request->file('file')->extension());
        // if( ) {
        //     // get the file real path

        // }
    }
}
