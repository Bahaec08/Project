<?php

namespace App\Http\Controllers;


use App\Models\favorite;

class FavoriteController extends Controller
{
    //
    public function delete(int $id)
    {
        $fav = favorite::all()->where('car_id', '=',$id)->where('user_id','=', Session('uid'))->first();
        $fav->delete();
        return redirect()->back()->with('success','Car Removed Successfully from your favorite');
    }

    public function add(int $id)
    {
        $fav = new favorite;
        $fav->user_id = Session('uid');
        $fav->car_id = $id;
        $fav->save();
        return redirect()->back()->with('success','Car Add Successfully to your favorite');
    }
}
