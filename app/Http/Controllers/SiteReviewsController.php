<?php

namespace App\Http\Controllers;

use App\Models\SiteReviews;
use Illuminate\Http\Request;

class SiteReviewsController extends Controller
{


    public function store(Request $request)
    {
        $review = new SiteReviews;
        $review->user_id = Session('uid');
        $review->content = $request->content;
        $review->save();
        return redirect()->back()->with('success', 'Review Add Successfully ! ');
    }
}
