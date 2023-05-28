<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lending;
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
        $lending->status = "pending";


        $lending->save();

        return redirect()->route('products.index')->with('success', 'Product added');
    }
}
