<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Accesores
    // public function getNameAttribute($name)
    // {
    //     return str_slug($name);
    // }

    // //mutadores
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }

}
