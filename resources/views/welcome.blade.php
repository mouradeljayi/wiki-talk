@extends('layouts.app')

@section('title', 'Home')

@section('content')

<style type="text/css">
  .welcome{
    margin-top: 100px;
    margin-bottom: 0;
    padding: 15px;
  }

  .footer{
    margin-top: 75px;
    border-top: 1px solid #bdc3c7;
    padding: 10px;
    font-size: 14px;
  }
</style>

<div class="container welcome">
  <div class="row justify-content-center">
    <div class="text-center text-info">
    <i class="fab fa-forumbee fa-9x"></i>
    <h1><strong>Wiki Talk</strong></h1>
   </div>
  </div>
   <div class="row justify-content-center">
    <div class="text-center">
    <h4>Bienvenue !</h4>
    <p>S'identifier ou Créer un compte pour participer dans la platforme Wiki Talk</p>
    <div class="d-flex justify-content-center align-items-center">
      <a href="{{ route('login') }}" class="btn btn-info">S'identifier</a>
      <a href="{{ route('register') }}" class="btn btn-outline-info ml-2">Créer un compte</a>
    </div>
   </div>
  </div>
</div>

<div class="text-center footer">
  <span>Copyright &copy;  2020 Developed by Mourad Eljayi</span>
</div>
@endsection