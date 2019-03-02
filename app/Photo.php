<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Photo extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo){
            $photoPatch = str_replace('storage', 'public', $photo->url);
            Storage::delete($photoPatch);
        });
    }
}
