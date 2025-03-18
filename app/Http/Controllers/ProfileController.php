<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Http\Helpers\PasswordGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{   

    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): Response
    // {
    //     return Inertia::render('User/Profile/Edit', [
    //         // 'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
    //         // 'status' => session('status'),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {

        $phone = User::where('phone', '=', $request->phone)->exists();
        $email = User::where('email' , '=' , $request->email)->exists();

        if($email)
            redirect()->back()->with('error', 'Email Already Exist !');
        if($phone)
            redirect()->back()->with('error', 'Phone Already Exist !');
        
        $user = User::find(Session('uid'));

        if($request->picture){
            $fname = time().'_'.$request->picture->getClientOriginalName();
            $request->picture->storeAs("user", $fname , "public");
            $user->picture = $fname;
        }

        $user->fill([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
        $user->save(); 
        
        return redirect()->back()->with('success', 'Your Profile has been update successgfully');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
