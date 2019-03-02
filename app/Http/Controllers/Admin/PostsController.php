<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;
        return view('admin.posts.index', compact('posts'));
    }

    // public function create()
    // {
    //     $categorias = Category::all();
    //     $tags = Tag::all();
    //     return view('admin.posts.create', compact('categorias', 'tags'));
    // }

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|min:3']);
        // $post = Post::create( $request->only('title') );
        $post = Post::create( $request->all() );
        
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $this->authorize('view', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'tags' => Tag::all(),
            'categorias' => Category::all()
        ]);
    }

    public function update(Post $post, StorePostRequest $request)
    {

        $post->title = $request->title;
        $post->body = $request->body;
        $post->iframe = $request->iframe;
        $post->excerpt = $request->excerpt;
        $post->published_at = $request->published_at;
        $post->category_id = $request->category_id;
        $post->save();

        $post->update($request->all());

        //etiquetas
        $post->syncTags($request->tags);


        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicacion ha sido guardada');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('flash', 'La publicacion fue eliminada');
    }

}
