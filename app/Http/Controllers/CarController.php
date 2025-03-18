<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCarRequest;
use Inertia\Inertia;
use App\Models\Car;
use App\Models\agoptions;

use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchMark = $request->mark;
        $searchModel = $request->model;
        $cars = Car::where('agency_id', session('agid'))
        ->when($searchMark, function($query) use($searchMark){
            $query->where("carMark", "like", "%{$searchMark}%");
        })
        ->when($searchModel, function($query) use($searchModel){
            $query->where("carModel", "like", "%{$searchModel}%");
        })
        ->paginate(4);
        
        return Inertia::render('Agency/cars/CarsList', [
            'cars' => $cars,

            'Marks' => Car::Where('agency_id', session('agid'))
                        ->select('carMark')
                        ->distinct()
                        ->get(),

            'Models' => Car::Where('agency_id', session('agid'))
                        ->select('carModel')
                        ->distinct()
                        ->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Agency/cars/NewCar',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {


        if($request->file("photo")->isValid()) {
          $photo = $request->photo;
          $fileName = str_replace(' ', '_', $request->input('mark').'_'.$request->input('model').'_'.$photo->getClientOriginalName());
          //$request->input('carMark').'_'.$request->input('model').'_'.$photo->getClientOriginalName();
          $photo->storeAs("car", $fileName, "public");
        }
          $CarData=[
              'carMark' => $request->input('mark'),
              'carModel' => $request->input('model'),
              'consumption' => $request->input('consumption'),
              'Kilometrage' => $request->input('Kilometrage'),
              'price' => $request->input('price'),
              'gearbox' => $request->input('gearbox'),
              'petrolType' => $request->input('petrolType'),
              'nofplaces' => $request->input('nofplaces'),
              'photo' => $fileName,
              'agency_id'=> $request->session()->get('agid')
          ];
  
          try{
            DB::beginTransaction();
            $c = Car::create($CarData);
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
        }
          return redirect()->back()->with('success', 'Car Created Successfully !');
      }

    /**
     * Display the specified resource.
     */
    public function show(Request $r,int $id)

    {
        if(!session('periode'))
            return redirect('/');
        // dd();s
        return Inertia::render('User/carRent', [
            'car' => Car::find($id),
            'start' => Session('start'),
            'end' => Session('end'),
            'periode' => Session('periode'),
            'options' => agoptions::avilabelOp(Session('start'), Car::find($id)->agency()->first()->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {  
        
        $car = Car::find($request->id)->fill($request->all())->save(); 
        return redirect()->back()->with('success', 'Car has been update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diff = date_diff(date_create(date('Y-m-d')), date_create(Car::LastCarRents($id)->first()?->endDate));
        if(($diff->days == 0 && $diff->invert == 0) || $diff->invert)
         {
            $car = Car::where('id', $id)->get()->first();
            if ($car->photo && Storage::exists($car->photo)){
                    Storage::delete($car->photo);
            }
            $delete = $car->delete();
            return redirect()->route('carslist')->with('success','Car deleted Successfully !');
        }
        return  redirect()->route('carslist')->with('error','You can Not delete this car at the moment');
    }

}
