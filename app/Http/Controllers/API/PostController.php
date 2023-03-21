<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function ambilSemnuaPost(){
        $posts = Post::all();
        return new PostResource(true,'Data berhasil diambil',$posts);
    }

    public function ambilPostSpesifik(int $id){
        $post = Post::find($id);
        if($post){
            return new PostResource(true,'Data berhasil diambil',$post);
        }else{
            return new PostResource(false,'Data tidak ditemukan',null);
        }
    }

    public function tambahPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($validator->fails()){
            return new PostResource(false, null, $validator->errors());
        }
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());
        $storagepath = 'http://localhost:8000/storage/posts/';

        //create post
        $post = Post::create([
            'image'     => $storagepath.$image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);

        //return response
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    public function ubahPost(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return new PostResource(false, null, $validator->errors());
        }

        // upload image
        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->image);

            //set new image path
            $storagepath = 'http://localhost:8000/storage/posts/';

            //update post with new image
            $update = Post::where('id',$id)->update([
                'image'     => $storagepath.$image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);

        } else {
            //update post without image
            $update = Post::where('id',$id)->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        $post = Post::find($id);

        //return response
        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    public function hapusPost($id){
        $post = Post::find($id);
        if($post){
            $post->delete();
            return new PostResource(true,'Data berhasil dihapus',$post);
        }else{
            return new PostResource(false,'Data tidak ditemukan',null);
        }
    }
}
