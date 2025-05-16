<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }
    public function index()
    {
        return view('admin.posts.index');
    }
    public function create()
    {
        //Genera un array con solo 'name'
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'user_id' => 'required|in:' . auth()->id(),
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'category_id' => 'required_if:status,2',
            'tags' => 'required_if:status,2',
            'file' => 'nullable|image|max:2048',
            'extract' => 'required_if:status,2',
            'body' => 'required_if:status,2'
        ]);

        $post = Post::create($request->except('file', 'tags'));

        if ($request->file('file')) {
            $url = Storage::put('public/posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }
        Cache::flush();
        $tags = $request->tags ?? [];
        $post->tags()->attach($tags);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('author', $post);
        //Genera un array con solo 'name'
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('author', $post);
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'status' => 'required|in:1,2',
            'category_id' => 'required_if:status,2',
            'tags' => 'required_if:status,2',
            'file' => 'nullable|image|max:2048',
            'extract' => 'required_if:status,2',
            'body' => 'required_if:status,2'
        ]);
        $post->update($request->all());
        if ($request->file('file')) {
            $url = Storage::put('public/posts', $request->file('file'));

            if ($post->image) {
                //borra la imagen
                Storage::delete($post->image->url);
                //guarda la nueva imagen
                $post->image()->update([
                    'url' => $url
                ]);
            } else {
                //mantiene la imagen
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        Cache::flush();
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post)->with('info', 'Post actualizado con éxito');
    }

    public function destroy(Post $post)
    {
        $this->authorize('author', $post);
        $post->delete();
        Cache::flush();
        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con exito');
    }
}
