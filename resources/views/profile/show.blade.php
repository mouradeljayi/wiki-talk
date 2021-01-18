@extends('layouts.app')

@section('title', 'Profile')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success text-center">
	{{ session('success')}}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger text-center">
	{{ session('error')}}
</div>
@endif

<main class="container py-5">
	<h3 class="text-info">Votre Profile</h3>
	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-start">
				<div>
					<img src="{{ asset('/storage/avatars/' . $user->avatar) }}" class="rounded-circle" width="100px" height="100px">
				</div>
				<div class="mt-2 ml-3">
					<h6>Username : <strong>{{ $user->name }}</strong></h6>
					<h6>Email : <strong>{{ $user->email }}</strong></h6>
					<form method="post" action="{{ route('deleteAvatar') }}">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-sm btn-warning">Supprimer la photo de profile</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<h5 class="text-info mt-3">Editer Vos Informations</h5>
	<div class="card">
		<div class="card-body">
			<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
				@csrf
				<div class="form-group row">
				    <label class="col-md-4 col-form-label text-md-right">Nom d'utilisateur</label>
					<div class="col-md-6">
						<input type="text" name="name" class="form-control" value="{{ $user->name }}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>
					<div class="col-md-6">
						<input type="email" name="email" class="form-control" value="{{ $user->email }}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-4 col-form-label text-md-right">Photo de profile</label>
					<div class="col-md-6">
						<input type="file" name="avatar" class="form-control">
					</div>
				</div>
				<div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-info">
                         Changer les informations
                        </button>
                        <button type="button" data-toggle="modal" data-target="#changePasswordModal" class="btn btn-outline-info">Changer le mot de passe</button>
                    </div>
                </div>
			</form>
		</div>
	</div>

	<!--Start Modal (Change Password)-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">Changement du mot de passe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('updatePassword') }}" method="post">
          @csrf
          <div class="form-group row">
			<label class="col-md-4 col-form-label text-md-right">Ancien Mot de passe</label>
		    <div class="col-md-6">
				<input type="password" name="old_password" class="form-control" placeholder="Tapez votre mot de passe actuel">
			</div>
		  </div>
		  <div class="form-group row">
			 <label class="col-md-4 col-form-label text-md-right">Nouveau Mot de passe</label>
				<div class="col-md-6">
					<input type="password" name="new_password" class="form-control" placeholder="Tapez le nouveu mot de passe">
				</div>
			</div>
           <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-info">
                         Changer Mot de passe
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Fermer</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Modal (Change Password)-->
</main>

@endsection