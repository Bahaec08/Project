<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Http\RedirectResponse;

class AuthAgencyController extends Controller
{
  public function authenticateAgency(LoginRequest $request): RedirectResponse
  {
    
    if (Auth::guard('agency')->attempt($request->only('email','password'))){
      $agency = Agency::where('email', $request->input('email'))->first()->id;
      $request->session()->regenerate();
      $request->session()->put('islogedin',true);
      $request->session()->put('agid',$agency);
      $request->session()->put('authrole','agency');
      return redirect()->intended(route('agencyHome'));
    
    }
    else {
      Auth::logout();
      return redirect()->back()->withErrors([
        'error' => 'You are not authorized to access this resource',
      ])->onlyInput('email');
    }
  }
  public function logout(Request $request): RedirectResponse
  {
    Auth::guard('agency')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->back();
  }

}

