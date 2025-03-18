<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Agency;
use App\Models\Option;


class InertiaHandleAgency extends Middleware
{


    private array $share = [];
    
    /**
     * __construct
     *
     * Construct Shared Admin Data
     * @return void
     */
    public function __construct(){


        $agency = Agency::where('id','=', Session('agid'))->first();

        $this->share += ['AgencyName' => $agency->agencyName];
        $this->share += ['NumberOfCars' => $agency->car()->count()];
        $this->share += ['Waiting' => $agency->rents()->where('status','=','waiting')->count()];
        $this->share += ['RentHistory' => $agency->rents()->where('status','=','success')->count()];
        $this->share += ['Nop' => Option::NoOption(Session('agid'))];

    }
        
    /**
     * Push Admin shared Data to Props List
     *
     * @param  mixed $request
     * @return array
     */


    public function share(Request $request): array
    {
        return array_merge(parent::share($request), $this->share);

    }
}
