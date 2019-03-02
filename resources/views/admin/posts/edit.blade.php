@extends('admin.layout')

@section('header')
    <h1>
        Posts
        <small>Crear Posts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Lista</a></li>
        <li class="active">Crear</li>
      </ol>
@stop

@section('content')
<div class="row">
         @if ($post->photos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            @foreach ($post->photos as $photo)
                            <form method="POST" action="{{ route('admin.photo.destroy', $photo) }}">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="position: absolute;"><i class="fa fa-remove"></i></button>
                                    <img src="{{ url($photo->url) }}" alt="" class="img-responsive">
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @csrf
        @method('PUT')
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear una publicacion</h3>
                </div>
                <div class="box-body">

                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                        <label for="">Titulo de la publicacion</label>
                        <input name="title" type="text" class="form-control" value="{{old('title', $post->title)}}">
                        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
                    </div>


                    <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                        <label for="">contenido de la publicacion</label>
                        <textarea id="editor1" name="body" rows="10" class="form-control"> {{old('body', $post->body)}} </textarea>
                        {!! $errors->first('body', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group {{$errors->has('iframe') ? 'has-error' : ''}}">
                        <label for="">contenido iframe</label>
                        <textarea id="editor1" name="iframe" rows="2" class="form-control"> {{old('iframe', $post->iframe)}} </textarea>
                        {!! $errors->first('iframe', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-title"></div>
                <div class="box-body">
                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                        <label for="">Categoria</label>
                        <select name="category_id" id="" class="form-control select2">
                            <option value="">Selecciona una categoria</option>
                            @foreach ($categorias as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category_id', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group">
                            <label>Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Seleciona una o mas etiquetas" style="width: 100%;">
                              @foreach ($tags as $tag)
                                <option {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }} value="{{$tag->id}}"> {{ $tag->name }}</option>
                              @endforeach
                            </select>
                    </div>

                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Fecha de publicacion:</label>
                        
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="published_at" id="datepicker" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null)}}">
                        </div>
                        <!-- /.input group -->
                    </div>
                    
                    <div class="form-group {{$errors->has('excerpt') ? 'has-error' : ''}}">
                        <label for="">Extracto de la publicacion</label>
                        <textarea name="excerpt" class="form-control">{{old('excerpt', $post->excerpt)}}</textarea>
                        {!! $errors->first('excerpt', '<small class="help-block">:message</small>') !!}
                    </div>

                    <div class="form-group">
                        <div class="dropzone"></div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Guardar</button>
                        <p class="text-center"><small>Guardar publicacion</small></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
@endpush
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
 <!-- Select2 -->
<!-- Select2 -->
<script src="{{asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- CK Editor -->
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
//Date picker
    $(function () {
        $('#datepicker').datepicker({
            autoclose: true
        })
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        CKEDITOR.config.height = 315;
        //Initialize Select2 Elements
        $('.select2').select2({
            tags: true
        })
    })

    var myDropzone = new Dropzone('.dropzone', {
        url: '/admin/posts/{{ $post->url }}/photos',
        acceptedFiles: 'image/*',
        maxFilesize: 2,
        paramName: 'photo',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        dictDefaultMessage: 'Coloca aqui tus imagenes'
    })
    // Cambiamos el texto del error desde el servidor.
    myDropzone.on('error', (file) => {
        const msgJSON = file.xhr.response;
        var msg = JSON.parse(msgJSON);
        var elemento = document.querySelectorAll('.dz-error-message span');
        elemento[elemento.length - 1].textContent = msg.errors.photo;
    });
    Dropzone.autoDiscover = false;
</script>
@endpush