@extends('admin.layout')

@section('content')
    <h1>dashboard</h1>
    <p>Usuario : {{ auth()->user()->email }}</p>
@stop