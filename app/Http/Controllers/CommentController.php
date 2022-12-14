<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use app\Http\Controllers\Auth;

class CommentController extends Controller
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
        $posts = Comment::all();

    }
    

    public function findById($toto)
    {
        $posts = DB::table('comments')->where('post_id', $toto);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$postid)
    {

        $post = DB::table('comments')->insert([
            'body' => $request->body,
            'post_id' => $postid,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now()->format('Y-m-d'),
        ]);

        $posts = Post::all();
        return view('dashboard', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $postid)
    {
   $comments = DB::table('comments')->where('post_id', $postid);

   $posts = Post::all();
   return view('dashboard', compact('posts', 'comments'));

    }

 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $post)
    {
        $post->delete();

        return back()->with('status', 'item deleted successfully');
    }
}
