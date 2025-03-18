<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\SiteReviews;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function show()
    {

        $reviews = DB::table('reviews')
                   ->join('users', 'reviews.user_id', '=', 'users.id')
                   ->select('reviews.*', 'users.firstName as firstName', 'users.lastName as lastName')
                   ->get();


        $reviewlist = SiteReviews::all();
        $arr = [];
        foreach($reviewlist as $review){
            $rev = $review->toArray();
            $rev['full_name'] = $review->user()->first()->firstName.' '.$review->user()->first()->lastName;
            $rev['picture'] = $review->user()->first()->picture;
            array_push($arr,$rev);
        }
        
        return Inertia::render('User/Index', [
             "cars" =>  Car::RecCars(Session('uid')),
             "reviews" => $arr
           ]);
     }


    public function rent(){
        $users = User::all();
        return Inertia::render('User/carRent', [
            "users" => $users
        ]);
    }

    
    public function confrimaccount(int $id,string $token)
    {
       if($user = User::find($id)->where('id', '=' , $id)->where('remember_token','=' ,$token)->whereNull('email_verified_at')->first()){
        $user->update([
            'email_verified_at' => Carbon::now(),
            'remember_token' => null
        ]);
            return redirect()->route('home')->with('success','Your account is activated');
        }

        return redirect()->route('home');
    }

    public function checkemail(Request $request){
        
        $email = $request->input('email');

        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }
}