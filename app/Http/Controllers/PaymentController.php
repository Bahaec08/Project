<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\RentOptions;

class PaymentController extends Controller
{

    public function Payment(Request $request){
        // dd($request->options);
        $rent = new Rent();

        $rent->car_id = $request->carId;
        $rent->startDate =  $request->start;
        $rent->endDate =  $request->end;
        $rent->user_id = $request->session()->get('uid');

        $payment = match ($request->creditPay) {
            true => 2,
            default => 1,
        };

        if($payment === 2)
            $rent->status = 'success';

        $rent->save();

        if($request->options){
            foreach($request->options as $rentop){
                $agops = new RentOptions;
                $agops->rent_id = $rent->id;
                $agops->agop_id = $rentop;
                $agops->save();
            }
        }
        
        return redirect('/')->with('success', 'Your request has been send successfully');
    }
}
