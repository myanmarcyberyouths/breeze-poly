<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\PostResource;
use App\Http\Requests\V1\Post\PostSaveRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\V1\Post\PostFavoriteRequest;
use App\Http\Requests\V1\Post\PostUnfavoriteRequest;

class PostController extends Controller
{
    public function save(PostSaveRequest $request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('post-images');
        }

        return json_response(Response::HTTP_CREATED, 'Post has been created successfully',new PostResource($post));
    }

    public function favorite(PostFavoriteRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $post = Post::find($request->post_id); 

        if ($user->hasFavorited($post)) {
            throw ValidationException::withMessages([
                'post_id' => 'Post already favorited',
            ])->status(Response::HTTP_BAD_REQUEST);
        }
        
        $user->toggleFavorite($post);
        
        return json_response(Response::HTTP_CREATED,'Post have been favorited successfully',[
            'favorites_count' =>  $post->favoriters()->count()
        ]);
    }

    public function unfavorite(PostUnfavoriteRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $post = Post::find($request->post_id);
        $user->unfavorite($post);

        return json_response(Response::HTTP_CREATED,'Post have been unfavorited successfully');
        
    }
}
