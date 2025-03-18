<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{



     public function authenticateAdmin(LoginRequest $request): RedirectResponse
     {
         $credentials = $request->only('email', 'password');
         if (Auth::attempt($credentials)) {
              $user = Auth::user();
              if ($user->type === 'admin') {
                  $admin = User::where('email', $request->input('email'))->first()->id;
                  $request->session()->regenerate();
                  $request->session()->put('islogedin',true);
                  $request->session()->put('islogedin',true);
                  $request->session()->put('uid',$admin);
                  $request->session()->put('authrole','admin');
                  return redirect()->intended('/');
                 }
                 else {
                  Auth::logout();
                  return redirect()->back()->withErrors([
                      'aerror' => 'You are not authorized to access this resource',
                  ])->onlyInput('email');
              }
          }

          return redirect()->back()->withErrors([
              'aerror' => 'Wrong information!',
          ])->onlyInput('email');
     }

    public function logout(Request $request): RedirectResponse
       {
           Auth::guard('admin')->logout();
           $request->session()->invalidate();
           $request->session()->regenerateToken();
           return redirect()->back();
       }
}

