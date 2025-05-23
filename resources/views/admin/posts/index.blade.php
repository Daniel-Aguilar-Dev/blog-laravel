@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-outline-secondary float-right" href="{{ route('admin.posts.create') }}">Nuevo post</a>
    <h1>Listado de posts</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    @livewire('admin.post-index')
    {{--  @livewire('test-search') --}}

@stop
