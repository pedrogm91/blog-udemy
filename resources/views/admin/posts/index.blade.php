@extends('admin.layout')

@section('header')
    <h1>
        Listado
        <small>Posts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Posts</li>
      </ol>
@stop

@section('content')
    <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Lista de publicaciones</h3>
              <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Crear publicacion</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Titulo</th>
                  <th>Extracto</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td> {{ $post->title }} </td>
                            <td> {{ $post->excerpt }} </td>
                            <td>
                                {{-- Ver --}}
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-default btn-xs" target="_blank">
                                  <i class="fa fa-eye"></i>
                                </a>
                                {{-- Editar --}}
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info btn-xs">
                                  <i class="fa fa-pencil"></i>
                                </a>
                                {{-- Eliminar --}}
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post" onclick="confirm('¿Deseas eliminar?')" style="display: inline-block">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@stop

@push('style')
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@push('script')
<!-- bootstrap datepicker -->
<!-- DataTables -->
<script src="{{asset('/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
    $(function () {
      $('#posts-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>


@endpush