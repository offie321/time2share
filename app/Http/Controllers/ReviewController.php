<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lending;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($lending_id)
    {
        $lending = Lending::findOrFail($lending_id);
        //
        return view('reviews.create', compact('lending'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $lending_id)
    {
        // Create a new review instance
        $review = new Review;
        $review->lending_id = $lending_id;
        $review->reviewer_id = auth()->user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;

        // Save the review
        $review->save();

        // Redirect to the lending details page
        return redirect()->route('products.index')->with('success', 'Review created successfully');
    }
}
