<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;
    public function index(){
        $posts =  PostResource::collection(Post::get());
        return $this->apiResponse($posts,"ok","200");

    }

    public function show ($id){
        $post =Post::find($id);
        if ($post){
            return $this->apiResponse(new PostResource($post),"ok","200");
        }
        return $this->apiResponse(null,"The Post Not Found.","404");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),"400");
        }


        $post =Post::create($request->all());
        if ($post){
            return $this->apiResponse(new PostResource($post),"The Post  Save.","201");
        }
        return $this->apiResponse(null,"The Post Not Save.","400");
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),"400");
        }

        $post =Post::find($id);
        if (!$post){
            return $this->apiResponse(null,"The Post Not Found.","404");
        }


        $post->update($request->all());
        if ($post){
            return $this->apiResponse(new PostResource($post),"The Post updated.","201");
        }

    }
    public  function destroy(Request $request,$id){

        $post =Post::find($id);
        if (!$post){
            return $this->apiResponse(null,"The Post Not Found.","404");
        }

        $post->delete($id);

        if ($post){
            return $this->apiResponse(null,"The Post delete.","200");
        }

    }
}
