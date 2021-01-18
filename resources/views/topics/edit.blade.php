@extends('layouts.app')

@section('title', 'Modifier topic')

@section('content')

<main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h4 class="text-center bg-success text-light py-2 border border-success mb-2">Modifier une topic</h4>
      <div class="card border border-success">
        <div class="card-body">
            <form method="post" action="{{ route('topics.update', $topic->slug)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Titre</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $topic->title }}">

                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Contenu</label>
                    <textarea name="content" cols="20" rows="8" class="form-control @error('content') is-invalid @enderror">{{ $topic->content }}</textarea>

                    @error('content')
                         <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
        </div>
      </div>    
      </div>
    </div>
</main>

@endsection