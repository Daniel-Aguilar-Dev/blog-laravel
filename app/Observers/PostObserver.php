<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class PostObserver
{
    public function creating(Post $post): void
    {
        if(! App::runningInConsole()){
            $post->user_id = auth()->user()->id;
        }
    }

   

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if($post->image){
            Storage::delete($post->image->url);
        }
    }

    /* 
    public function updated(Post $post): void
    {
        //
    }

    public function restored(Post $post): void
    {
        //
    }

    public function forceDeleted(Post $post): void
    {
        //
    } */
}
