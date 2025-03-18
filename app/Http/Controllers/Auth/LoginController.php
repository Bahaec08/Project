<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\passwordGenerator;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ConfirmEmail;

class LoginController extends Controller
 {

    public function register(Request $request)
    { 
        $encrypted_password = Hash::make($request->input('password'));

        $RegisterData=[
            'firstName' => $request->firstname,
            'lastName' => $request->lastname,
            'email' => $request->email,
            'password' => $encrypted_password,
            'phone' => $request->phone,
            'remember_token' => Str::random(55)
        ];

        $user = User::create($RegisterData);
        Mail::to($user->email)->send(new ConfirmEmail($user->id, $user->remember_token));      
        return redirect()->back()->with('success', 'Email has been sent! Please activate your account');
    }




 public function authenticate(Request $request): RedirectResponse
 {

     if (Auth::attempt($request->only('email', 'password'))) {
        

        
         if (Auth::user()->type === 'user') {
            if(Auth::user()->email_verified_at == null)
                return redirect()->back()->with('error','Please confirm your account');


            $request->session()->regenerate();
            $request->session()->put('islogedin',true);
            $request->session()->put('uid',Auth::user()->id);
            $request->session()->put('authrole','user');

            return redirect()->back();
            
        }
            else {
                
             Auth::logout();

             return redirect()->back()->withErrors([
                 'error' => 'You are not authorized to access this resource',
             ])->onlyInput('email');
         }
     }

     return redirect()->back()->withErrors([
         'error' => 'Wrong information!',
     ])->onlyInput('email');
 }



 public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }

 }



