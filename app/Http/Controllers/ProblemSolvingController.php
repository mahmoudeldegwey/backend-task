<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{
    public function lowestIntegerPositive(Request $request){
        
        $numbers = $request->arr_values;

        //remove negitive numbers from the array
        $positiveNumbers =  array_filter($numbers,function($value){
            return $value > -1;
        });       

        // remove dublicate numbers from array 
        $uniqueNumbers = array_unique($positiveNumbers);
        
        $correctNumbersArray = range(min($uniqueNumbers), max($uniqueNumbers));        
        
        $diffNumbers = array_diff($correctNumbersArray,$uniqueNumbers);        
        
        return response()->json([
            'value' => min($diffNumbers)
        ],200);
    }

    public function countNumbers(Request $request){

        $start_number = $request->start;
        $end_number = $request->end;

        //create array numbers from start and end numbers
        $generateArray = range($start_number, $end_number);

        // remove any number contian 5 number
        $filterNumbers = array_filter($generateArray,function($value){
            if (str_contains(strval($value),'5') == false) {
                return $value;
            };
        });

        return response()->json([
            'value' => count($filterNumbers)
        ],200);
    }
}
