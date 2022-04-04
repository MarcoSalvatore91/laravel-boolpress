@extends('layouts.app')

@section('content')

<div class="container d-flex">
    <div class="mr-5">
        @if ($post->image)
        <img src="{{ asset("storage/$post->image") }}" alt="{{ $post->title }}" width="200px" class="img-fluid">
        @else
        <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640" alt="image-null" width="200px" class="img-fluid">
        @endif
    </div>
    <div>
        <h1>{{ $post->title }}</h1>
        <p><strong>Contenuto: </strong>{{ $post->content }}</p>
        <p><strong>Creato il: </strong>{{ $post->updated_at }}</p>
        @foreach ($post->tags as $tag)
        <div class="badge" style="background-color:{{ $tag->color }}">{{ $tag->label }}</div>
        @endforeach
    </div>
</div>
<div class="container d-flex justify-content-end">
    <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Indietro</a>
</div>

@endsection