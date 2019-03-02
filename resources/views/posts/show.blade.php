@extends('layout')
@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)
@section('content')
    

<article class="post container">

        {{-- Metodo en el modelo Post.php encargardo de general el tipo de vista (1 foto, varias fotos o iframe) --}}
        @include( $post->viewType() )

        <div class="content-post">

            @include('posts.header')

          <h1>{{$post->title}}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
              {!!$post->body!!}
            </div>
    
            <footer class="container-flex space-between">
              <div class="buttons-social-media-share">
                <ul class="share-buttons">
                <li><a href="https://www.facebook.com/sharer.php?u={{request()->fullUrl()}}&title{{$post->title}}" title="Share on Facebook" target="_blank"><img alt="Share on Facebook" src="/img/flat_web_icon_set/Facebook.png"></a></li>
                  <li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet"><img alt="Tweet" src="/img/flat_web_icon_set/Twitter.png"></a></li>
                  <li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img alt="Share on Google+" src="/img/flat_web_icon_set/Google-plus.png"></a></li>
                  <li><a href="http://pinterest.com/pin/create/button/?url=&description=" target="_blank" title="Pin it"><img alt="Pin it" src="/img/flat_web_icon_set/Pinterest.png"></a></li>
                </ul>
              </div>
              
              @include('posts.tags')
            </footer>
          
          <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
              <script>
              (function() { // DON'T EDIT BELOW THIS LINE
              var d = document, s = d.createElement('script');
              s.src = 'https://zendero.disqus.com/embed.js';
              s.setAttribute('data-timestamp', +new Date());
              (d.head || d.body).appendChild(s);
              })();
              </script>
              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                              
          </div><!-- .comments -->

        </div>
</article>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('/css/twitter-bootstrap.min.css')}}">
@endpush

@push('script')
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
<script src="{{asset('/js/twitter-bootstrap.min.js')}}"></script>
@endpush