<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\User;


class InertiaHandelUser extends Middleware
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
        $this->share += ['user' => User::where('id','=',Session('uid'))->first()];
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
