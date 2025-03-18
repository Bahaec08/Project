<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Models\agoptions;


class searchController extends Controller
{
    

    public function index(Request $request){
        $request->session()->put('Periode','10');
        return Inertia::render('User/Search/Search',[
            'search' => 'a'
        ]);
    }

    public function search(SearchRequest $request)
    {
        $rentable = Car::RentableCars($request->start, $request->location, Session('uid'));
        $list = [];
        foreach($rentable as $rentcar){
            $search = (array)$rentcar;
            foreach(agoptions::avilabelOp($request->start, $rentcar->agency_id) as $op){
                $op->optionName = str_replace(' ','',$op->optionName);

                $search[strtolower($op->optionName)] = $op->av;
            }
            array_push($list, $search);
        }
        $diff = date_diff(date_create($request->start),date_create($request->end))->days;
        $request->session()->put('periode',$diff);
        $request->session()->put('start',$request->start);
        $request->session()->put('end',$request->end);
        // dd(Car::RentableCars($request->start, $request->location));
        return Inertia::render('User/Search/Search',[
                'search' => $list,
            ]
        );

    }
    
}


