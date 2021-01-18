@extends('layouts.app')

@section('title', 'Topics')

@section('content')

@if(session()->has('success'))

<div class="alert alert-success text-center">
	{{ session('success')}}
</div>
@endif

<style type="text/css">
	a:hover {
		text-decoration: none;
	}
</style>

<main class="container mt-4">
	<div class="d-flex justify-content-between">
		<h4>Toutes Les Topics</h4>
        @auth
	    <a href="{{ route('topics.create') }}" class="btn btn-outline-success">Créer une topic</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-success">S'identifier pour avoir créer une topic</a>
        @endauth
    </div>
    <div class="row d-flex justify-content-center mt-4">
    	<div class="col-md-12">
            @if($topics->count() == 0)
            <div class="alert alert-info text-center">
                Elle n'existe aucune topic pour le moment !
            </div>
            @endif
    		@foreach($topics as $topic)
    		<div class="card shadow-sm rounded mt-2">
    			<div class="card-body">
    				<div class="d-flex justify-content-between">
    					<a class="text-info" href="{{ route('topics.show', $topic->slug) }}" class="text-info"><h5><strong>{{ $topic->title }}</strong></h5></a>
    				    <span>par: {{ $topic->user->name }}</span>
    				</div>
    				<div class="badge badge-secondary">
    					Posté le: {{ $topic->created_at->format('d/m/Y à H:m') }}
    				</div>
    			</div>
    		</div>
    		@endforeach
    	</div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $topics->links() }}
    </div>
</main>

@endsection