@extends('layouts.app')

@section('title', 'Créer Compte')

@section('content')
<main class="container mt-5">
	
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-info text-light"><i class="fas fa-user-plus"></i> Créer un nouveau compte</div>
				<div class="card-body">
					<form method="post" action="{{ route('newUser') }}">
						@csrf
						<div class="form-group">
							<label>Nom d'utilisateur</label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

							@error('name')
							    <div class="text-danger mt-2">{{ $message }}</div>
							@enderror
						</div>
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
						<div class="form-group">
							<label>Confirmer votre mot de passe</label>
							<input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">

							@error('password_confirmation')
							    <div class="text-danger mt-2">{{ $message }}</div>
							@enderror
						</div>
						<button class="btn btn-info">Créer compte</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection