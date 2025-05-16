<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){
        if(request()->page){
            $key= 'posts' . request()->page;
        }else{
            $key= 'posts';
        }

        //Busca en Cache si existe la consulta
        if(Cache::has($key)){
            $posts= Cache::get($key);
        }else{
            //si no, la genera
            $posts = Post::where('status', 2)->latest('id')->paginate(5);
            //y la guarda en cache
            Cache::put($key, $posts);
        }
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post){
        $this->authorize('published', $post);
        $similares = Post::where('category_id', $post->category_id)
            ->where('status', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->take(4)
            ->get();

        return view('posts.show', compact('post', 'similares'));
        //return $post;
    }
    public function category(Category $category){
        $posts = Post::where('category_id', $category->id)
            ->where('status', 2)
            ->latest('id')
            ->paginate(4);
        return view('posts.category', compact('posts', 'category'));
    }
    public function tag(Tag $tag){
       $posts = $tag->posts()->where('status', 2)->latest('id')->paginate(4);
        return view('posts.tag', compact('posts', 'tag'));
    }
}
