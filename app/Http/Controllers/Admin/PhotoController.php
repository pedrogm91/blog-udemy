<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'image|max:2048|required'
        ]);
        
        $photo = request()->file('photo')->store('posts', 'public');
        
        $photoUrl = Storage::url($photo);
        $post->photos()->create([
            'url' => $photoUrl,
        ]); 
        
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        
        return back()->with('flash', 'foto eliminada');
    }
}
