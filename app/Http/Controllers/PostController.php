<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use app\Http\Controllers\Auth;

class PostController extends Controller
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
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }
    public function userPosts()
    {


        $posts = DB::table('posts')->where('user_id', auth()->id())->get();
        return view('profilePage', compact('posts'));
    }

    public function findById($toto)
    {
        $posts = DB::table('posts')->where('user_id', $toto);

        return view('posts.findById', compact('posts'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = DB::table('posts')->insert([
            'description' => $request->description,
            'img_url' => $request->img_url,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->format('Y-m-d'),
            'updated_at' => $request->updated_at
        ]);

        $posts = Post::all();
        // return view('posts.index', compact('posts'))->with('status', 'post added successfully');
        return view('dashboard', compact('posts'))->with('status', 'post added successfully');
    }
    public function likePost(Request $request)
    {
        $like = new Like;
        $like->user_id = auth()->user()->id;
        $like->post_id = $request->post_id;
        $like->save();
        $user = auth()->user()->id;

        // $check = Like::where('user_id', $user)->where('post_id', $id)->first();
        // if ($check) {
        //     // The user has already liked the item, so return an error
        //     return response()->json([
        //         'error' => 'You have already liked this item.'
        //     ], 400);
        // } else {
        //     $like = new Like;
        //     $like->user_id = auth()->user()->id;
        //     $like->post_id = $id;
        //     $like->save();
        //     return response()->json([
        //         'success' => 'Like added successfully.'
        //     ]);
        // }
    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
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
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return back()->with('status', 'item updated successfully');
    }
    public function updateForm($p)
    {
        $posts = DB::table('posts')->where('id', $p)->first();
        return view('posts.updatePost', compact('posts'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('status', 'item deleted successfully');
    }
}
