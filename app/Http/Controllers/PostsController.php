<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\PostForm;
use App\Models\Post;
// use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    private $formBuilder;
    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = posts::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->formBuilder->create(\App\Forms\PostForm::class);
        // echo auth()->user();
        return view('posts.create', compact("form"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // posts::create($request->all());
        var_dump($request->all()); die;
        // $user_id = auth()->user()->id;
        // posts::create($request->$user_id + all());

        return back()->with('message', 'item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\posts $posts
     * @return \Illuminate\Http\Response
     */
    public function show(posts $posts)
    {
        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\posts $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(posts $posts)
    {
        return view('posts.edit', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\posts $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posts $posts)
    {
        $posts->update($request->all());

        return back()->with('message', 'item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posts $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(posts $posts)
    {
        $posts->delete();

        return back()->with('message', 'item deleted successfully');
    }
}
