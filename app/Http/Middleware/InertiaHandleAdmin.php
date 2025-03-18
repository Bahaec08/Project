<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Agency;
use App\Models\User;


class InertiaHandleAdmin extends Middleware
{


    protected array $share = [];
    
    /**
     * __construct
     *
     * Construct Shared Admin Data
     * @return void
     */
    public function __construct()
    {
        $this->share += ['AdminName' => User::where('id','=',Session('uid'))->select('firstName','lastName')->first()];
        $this->share += ['NumberOfAgencies' => Agency::Active('accepted')->count()];
        $this->share += ['PendingList' => Agency::Active('pending')->count()];
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
