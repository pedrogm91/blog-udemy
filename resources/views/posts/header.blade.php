<header class="container-flex space-between">
    <div class="date">
        <span class="c-gray-1">
            {{ /*$post->published_at->format('M d')*/ $post->published_at->diffForHumans() }} / {{ $post->owner->name }}
        </span>
    </div>
    <div class="post-category">
        <span class="category text-capitalize">
            <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a>
        </span>
    </div>
</header>