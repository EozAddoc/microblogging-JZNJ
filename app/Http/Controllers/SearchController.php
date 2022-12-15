<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")->get();

        return view('search-results', ['users' => $users]);
    }
}
