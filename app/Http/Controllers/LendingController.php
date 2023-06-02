<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lending;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    //
    public function lend($product_id, $lender_id, $days)
    {
        $current_user = Auth::id();

        // Calculate the deadline based on the current date and time
        $deadline = Carbon::now()->addDays($days)->toDateTimeString();

        $lending = new Lending();
        $lending->product_id = $product_id;
        $lending->borrower_id = $current_user;
        $lending->lender_id = $lender_id;
        $lending->deadline = $deadline;
        $lending->status = "Borrowed";


        $lending->save();

        $product = Product::find($product_id);
        $product->borrower_id = $current_user;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added');
    }

    public function return($productId)
    {
        $lending = Lending::where('product_id', $productId)->firstOrFail();

        $lending_id = $lending->id;
        $lending->status = "Returned";
        $lending->save();

        return redirect()->route('reviews.create', ['lending_id' => $lending_id]);
    }

    public function accept($lending)
    {



        $lending = Lending::where('id', $lending)->firstOrFail();

        $product_id = $lending->product_id;

        $product = Product::find($product_id);

        $product->borrower_id = null;

        $product->save();


        $lending->delete();

        return redirect()->route('products.index')->with('success', 'lending deleted');
    }

}
