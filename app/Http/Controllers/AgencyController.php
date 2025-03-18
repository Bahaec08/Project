<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgencyRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Agency;
use App\Mail\AgencyConfirm;
use App\Models\Rent;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\Qrcodemail;
use App\Models\User;

class AgencyController extends Controller
{
  public function show(){
    return Inertia::render('Agency/Index', [
      'nofusers' => User::UserRents(Session('agid'))->count(),
      'rentsrevenue' =>  Rent::RentStatsRevenue(null,Session('agid'), 1)->first()->rentPrice,
      'adminrevenue' =>  Rent::RentStatsRevenue(null,Session('agid'), 0.05)->first()->rentPrice,
      'agencyrevenue' =>  Rent::RentStatsRevenue(null,Session('agid'))->first()->rentPrice,
    ]) ;
  }

  public function stats(){
        // dd(Rent::RentStatsRevenue(0,Session('agid')));
        return Inertia::render('Agency/Statistics',[
          'cWeekRents' => Rent::RentStatsWeek(0,Session('agid'))->toArray(),
          'lWeekRents' => Rent::RentStatsWeek(1,Session('agid'))->toArray(),
          'cWeekRevenue' => Rent::RentStatsRevenue(0,Session('agid'))->toArray(),
          'lWeekRevenue' => Rent::RentStatsRevenue(1,Session('agid'))->toArray()
        ]);
    }

    public function showLogin(){
        return Inertia::render('Agency/Login');
    }

  public function showRegister(){
        return Inertia::render('Agency/Register');
  }
  
    public function allRent(){
        return Inertia::render('Agency/Rents', [
          'list' => Agency::listing(Session('agid'), 'success')
        ]);
    }
    
    public function acceptwaiting(Request $request){
      $rent = Rent::find($request->id);
      $rent->status = 'success';
      $data = urlencode($rent->car()->latest()->first()->carModel." ".$rent->startDate." ".$rent->endDate);
      Mail::to($rent->user()->latest()->first()->email)->send(new Qrcodemail("  ={$data}"));
      $rent->save();
      return redirect()->back()->with('success', 'Car Rented Successfully !');
    }

    public function deletewaiting (Request $request){
      $rent = Rent::find($request->id);
      $rent->delete();
      return redirect()->back()->with('success', 'Rent has been refused Successfully');
    }


    public function waiting(){
      return Inertia::render('Agency/Waiting',[
        'list' => Agency::listing(Session('agid'), 'waiting')
      ]);
    }

    // add a new agency by admin
  public function store(StoreAgencyRequest $request) {
      $agency = new Agency();
      $agency->agencyName = $request->ag_name;
      $agency->ownerName = $request->owner_name;
      $agency->phone = $request->ag_phone;
      $agency->email = $request->ag_email;
      $agency->location = $request->location;

      if(Session('authrole') == 'admin') {
        $password = Str::random(10);
        //$password = PasswordGenerator::generateRandomPassword();
        $agency->status = 'accepted';
        $agency->password = Hash::make($password);
      }

      if($request->file("photo") && $request->file("photo")->isValid()) {
        $photo = $request->photo;
        $slugAgName = Str::slug($request->ag_name,"-");
        $padding = Str::random(5);
        $agency->license = "{$slugAgName}-{$padding}-{$photo->getClientOriginalName()}";
        $photo->storeAs("agency", $agency->license, "public");
      }

      try{
          DB::beginTransaction();
          $agency->save();
          $photo->storeAs("agency", $agency->license, "public");
           if($agency->status == 'accepted') 
           {
               Mail::to($request->ag_email)->send(new AgencyConfirm($request->ag_name, $request->ag_email, $password));
            }
           DB::commit();
           dd($password);
          return redirect()->back()->with('success', 'Agency Created Successfully !');
        }
        catch (Exception $e){
            Storage::delete($agency->license);
            DB::rollback();
        }
        return redirect()->back()->with('error', 'Agency Can not be created at this Moment !');
    }

    public function delete(Request $request){
      Agency::find($request->id)->delete();
      return redirect()->back()->with('success', 'Agency Can not be created at this Moment !');
    }

    public function accept(Request $request){
      $ag = Agency::find($request->id);
      $ag->status = 'accepted';
      $password = Str::random(10);
      //$password = PasswordGenerator::generateRandomPassword();
      $ag->password =Hash::make($password);
      Mail::to($ag->email)->send(new AgencyConfirm($ag->agencyName, $ag->email, $password));
      $ag->save();
      return redirect()->back()->with('success', 'Agency Create Successfully Moment !');
    }

}

