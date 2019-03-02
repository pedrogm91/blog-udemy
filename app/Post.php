<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'body',
        'iframe',
        'excerpt',
        'published_at',
        'category_id',
        'user_id'
    ];
    protected $dates = ['published_at'];

    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')->where('published_at', '<=', Carbon::now())->latest('published_at');
    }

    public function isPublished()
    {
        return !is_null( $this->published_at ) && $this->published_at < today();
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($post){
            $post->tags()->detach();
            $post->photos->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'url';
    }
    
    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        $post->generateUrl();
        
        return $post;
    }
    public function generateUrl()
    {
        $url = str_slug($this->title);
    
        if ($this->where('url', $url)->exists()) {
            $url = "{$url}-{$this->id}";
        }
    
        $this->url = $url;
        $this->save();

    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category = $category) ? $category : Category::create(['name' => $category])->id;
    }
    

    //Guardar tags
    public function syncTags($tags)
    {
        $tagIds = collect( $tags )->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });
        // $this->tags()->attach($request->tags);
        return $this->tags()->sync($tagIds);
    }

    // RELACIONES
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // method encargado de definir el tipo de vista a mostrar (iframe , 1 foto, o galeria)
    public function viewType($page = '')
    {
        if ($this->photos->count() === 1):
			return 'posts.photo';
		elseif($this->photos->count() > 1):
			return $page === 'home' ? 'posts.carousel-preview' : 'posts.carousel';
		elseif($this->iframe):	
            return 'posts.iframe';
        else: 
            return 'posts.text';
		endif;
    }
    

}
