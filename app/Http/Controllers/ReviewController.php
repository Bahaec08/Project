<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;

use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $id)
    {  
        // dd(User::RentedBy($id,Session('uid')));
        return Inertia::render('User/Components/Review',[
           'car' => Car::find($id),
           'reviews' => User::RentedBy($id,Session('uid')),
           'rented' => Car::RentedBy($id,Session('uid'))
        ]);
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r,int $id)
    {
        $review = new Review;
        $review->user_id = Session('uid');
        $review->car_id = $id;
        $review->description = $r->text;
        $review->rating = $r->rat;
        $review->save();
        return redirect()->back()->with('success', 'Review Add Successfully !');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
