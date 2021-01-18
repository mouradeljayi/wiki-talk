@extends('layouts.app')

@section('title', 'Créer topic')

@section('content')

<main class="container py-5">
	<div class="row justify-content-center">
	  <div class="col-md-8">
	  	<h4 class="text-center bg-success text-light py-2 border border-success mb-2">Créer une nouvelle topic</h4>
	  <div class="card border border-success">
	  	<div class="card-body">
	  		<form method="post" action="{{ route('topics.store')}}">
	  			@csrf
	  			<div class="form-group">
	  				<label>Titre</label>
	  				<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">

	  				@error('title')
						<div class="text-danger mt-2">{{ $message }}</div>
					@enderror
	  			</div>
	  			<div class="form-group">
	  				<label>Contenu</label>
	  				<textarea name="content" cols="20" rows="8" class="form-control @error('content') is-invalid @enderror"></textarea>

	  				@error('content')
					     <div class="text-danger mt-2">{{ $message }}</div>
					@enderror
	  			</div>
	  			<button type="submit" class="btn btn-success">Ajoutez</button>
	  		</form>
	  	</div>
	  </div> 	
	  </div>
	</div>
</main>

@endsection