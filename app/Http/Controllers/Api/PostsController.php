<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Response;
use Validator;

class PostsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $posts = PostResource::collection(Post::paginate($this->paginateNumber));

        return $this->apiResponse($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->returnSuccessPost($post);
        }
        return $this->notFoundResponse();
    }

    public function store(Request $request)
    {

        $validation = $this->validation($request);

        if ($validation instanceof Response) {
            return $validation;
        }

        $post = Post::create($request->all());

        if ($post) {
            return $this->createdResponse(new PostResource($post));
        }

        $this->unknownError();
    }

    public function update($id, Request $request)
    {
        $validation = $this->validation($request);

        if ($validation instanceof Response) {
            return $validation;
        }

        $post = Post::find($id);

        if (!$post) {
            return $this->notFoundResponse();
        }

        $post->update($request->all());
        if ($post) {
            return $this->returnSuccessPost($post);
        }
        $this->unknownError();
    }

    public function validation($request)
    {
        return $this->apiValidation($request, [
            'title' => 'required|min:3|max:191',
            'body'  => 'required|min:10',
        ]);
    }

    public function returnSuccessPost($post)
    {
        return $this->apiResponse(new PostResource($post));
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return $this->deletedResponse();
        }
        return $this->notFoundResponse();
    }
}
