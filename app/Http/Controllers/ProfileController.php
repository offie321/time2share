<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Lending;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function show(User $id)
    {
        // This is so some content can only be shown when user profile is of the current logged-in user
        $currentUserId = Auth::id();
        $currentUser = Auth::user();

        $user = $id;

        // Show all products from this user
        $userWithProducts = User::with('products')->findOrFail($user->id);

        $borrowed_products = Product::where('borrower_id', $id->id)->get();

        $reviews = Review::where('reviewer_id', $id->id)->get();

//        $userLendings = Lending::with('borrower', 'lender')->where('borrower_id', $id->id)->get();
        $userLendings = Lending::with(['product', 'borrower'])
            ->where('lender_id', $currentUser->id)
            ->get();



        $products = $userWithProducts->products;
        return view('profile.show', compact('user', 'products', 'currentUserId', 'borrowed_products', 'userLendings', 'reviews'));
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
