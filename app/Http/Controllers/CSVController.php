<?php

namespace App\Http\Controllers;

use App\Http\Requests\csvFileValidation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    private $success;
    private $fail;

    public function __construct() {
        $this->success = 200;
        $this->fail = 500;
    }
    /**
     * convert csv to array
     */
    public function convertCSVToArray(csvFileValidation $request) : JsonResponse
    {
        $people = [];
        // get file path
        //  read the csv file and parse the content into a multidiamentional array
        // write conditions to build a new array with key value pair
        // return the new array

        $getFilePath = $request->file('file')->getRealPath();
        // dd($getFilePath);
        $csvData = array_filter(array_map('str_getcsv', file($getFilePath)));

        //elemenate the first item
        unset($csvData[0]);
        // dd($csvData);


        if($csvData && count($csvData) > 0) {
            foreach($csvData as $key => $owner) {
                $people[] = $this->splitOwnerStringToArray($owner[0]);
            }
            return response()->json(['data' => $people] , $this->success);
        }

        return response()->json(['No data available in the csv file'], $this->fail);
        
    }

    /**
     * @param $ower
     * return the owner details array
     */
    public function splitOwnerStringToArray( string $owner, array $details = []) : array 
    {
        if($owner) {
            // check whether and is available
            if (str_contains($owner,'and') || str_contains($owner,'&')) {

                $names = str_contains($owner,'and') ? explode('and', $owner, 2) :explode('&', $owner, 2)  ;
                foreach($names as $key=> $name) {
                    $name = trim($name);
                    $ownerNameArray = explode(' ', $name);
                    $nextOwnerNameArray = $key < count($names) - 1  ? explode(' ', trim($names[$key+1])) : 'null';
                    
                    $firstName = count($ownerNameArray) === 3 ? $ownerNameArray[1] : 'null';
                    $lastName = count($ownerNameArray) > 1 ? end($ownerNameArray) : end($nextOwnerNameArray);
                    $fullName = $ownerNameArray[0]. ' '.$firstName.' '.$lastName;
                   
                    $dataArray[] = $this->splitOwnerStringToArray($fullName, $details);
                }
                // dd($dataArray);
                $details = $dataArray;

            }else {
                $name = explode(' ', $owner);
                
                $nameArray = [
                    'title' => $name[0],
                ];
                
                if (str_contains($owner,'.')) {
                    $dot_position = strpos($owner, '.');
                    
                    // get the position of dot
                    $nameArray['first_name'] = !str_contains($name[1], '.') ? $name[1] : 'null';
                    $nameArray['initial'] = substr($owner, $dot_position -1 , 1 );
                    $nameArray['last_name'] = end($name) ?? 'null';
                } else {
                    $nameArray['first_name'] = $name[1];
                    $nameArray['last_name'] = $name[2] ?? 'null';
                }

                $details = $nameArray;

            }
            
            return $details;
        }
        return [];
    }

}
