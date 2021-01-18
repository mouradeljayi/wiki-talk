@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<main class="container mt-5">
	@if(session()->has('success'))

	<div class="alert alert-success text-center">
	  {{ session('success')}}
	</div>

	@endif
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-info text-light"><i class="fas fa-sign-in-alt"></i> Connexion</div>
				<div class="card-body">
					<form method="post" action="{{ route('authenticate') }}">
						@csrf
						<div class="form-group">
							<label>Adresse E-mail</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

							@error('email')
							    <div class="text-danger mt-2">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label>Mot de passe</label>
							<input type="password" name="password" class="form-control @error('password') is-invalid @enderror">

							@error('password')
							    <div class="text-danger mt-2">{{ $message }}</div>
							@enderror
						</div>
						<button class="btn btn-info">S'identifier</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection