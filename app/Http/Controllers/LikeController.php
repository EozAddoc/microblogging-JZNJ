<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use app\Http\Controllers\Auth;
use Illuminate\Support\Facades\URL;



class LikeController extends Controller
{

    public function findUser($likeId)
    {
        $like = Like::find($likeId);
        $user = $like->user;
    }

    public function likePost(Request $request, $id)
    {
        
        $user=auth()->user()->id;
var_dump($id);
        $check = Like::where('user_id', $user)->where('post_id', $id)->first();
        if ($check) {
            // The user has already liked the item, so return an error
            return response()->json([
                'error' => 'You have already liked this item.'
            ], 400);
        } else {
            $like = new Like;
            $like->user_id = auth()->user()->id;
            $like->post_id = $id;
            $like->save();
            return response()->json([
                'success' => 'Like added successfully.'
            ]);
        }
        $url = URL::previous();
    return redirect($url);
    }

    public function postLiked($id)
    {
        $post = Post::find($id);
        $likes = $post->likes;
    }

    public function delete($id)
    {
        $like = Like::where('user_id', auth()->user()->id)
            ->where('post_id', $id)
            ->first();
        $like->delete();
    }
}
