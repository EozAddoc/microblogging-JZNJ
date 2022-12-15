<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function follow(REQUEST $request)
    {
        $follow = new Follow();
        $follow->follower_id = auth()->user()->id;
        $follow->followed_id = $request->followz;
        $follow->save();
        return redirect()->back();
    }

    public function unfollow(REQUEST $request)
    {
        $currentUser = auth()->user()->id;

        // Delete the follow relationship between the current user
        // and the user they want to unfollow
        $follow = Follow::where('follower_id', $currentUser)
            ->where('followed_id', $request->followed)
            ->delete();

        return redirect()->back();
    }

    public function viewfollowers(REQUEST $request)
    {
        $currentUser = auth()->user()->id;
        $otherUser = $request->user;
        if ($currentUser == $otherUser) {
            // Query the follows table to get the records where the followed_id matches the current user's id
            $getFollow = DB::table('follows')->where('followed_id', $currentUser)->get();

            // Use the pluck method to get the values of the id column from the results
            $followers = $getFollow->pluck('follower_id');

            // Query the users table, filtering the results by the id column and using the collection of follower ids as the criteria
            $users = DB::table('users')->whereIn('id', $followers)->get();
        } else {
            // Query the follows table to get the records where the followed_id matches the current user's id
            $getFollow = DB::table('follows')->where('followed_id', $otherUser)->get();

            // Use the pluck method to get the values of the id column from the results
            $followers = $getFollow->pluck('follower_id');

            // Query the users table, filtering the results by the id column and using the collection of follower ids as the criteria
            $users = DB::table('users')->whereIn('id', $followers)->get();
        }

        return view('profile.users', compact('users'));
    }
    public function viewFollowedBy(REQUEST $request)
    {
        $currentUser = auth()->user()->id;
        $otherUser = $request->user;
        if ($currentUser == $otherUser) {
            // Query the follows table to get the records where the followed_id matches the current user's id
            $getFollow = DB::table('follows')->where('follower_id', $currentUser)->get();

            // Use the pluck method to get the values of the id column from the results
            $followers = $getFollow->pluck('followed_id');

            // Query the users table, filtering the results by the id column and using the collection of follower ids as the criteria
            $users = DB::table('users')->whereIn('id', $followers)->get();
        } else {
            // Query the follows table to get the records where the followed_id matches the current user's id
            $getFollow = DB::table('follows')->where('follower_id', $otherUser)->get();

            // Use the pluck method to get the values of the id column from the results
            $followers = $getFollow->pluck('followed_id');

            // Query the users table, filtering the results by the id column and using the collection of follower ids as the criteria
            $users = DB::table('users')->whereIn('id', $followers)->get();
        }
        return view('profile.users', compact('users'));
    }
    public function watch()
    {
        return view('profilePage');
    }
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
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
