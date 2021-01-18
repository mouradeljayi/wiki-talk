@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success text-center">
    {{ session('success')}}
</div>
@endif

<div class="container-fluid mt-4 mb-5">
  <div class="card">
      <div class="card-header bg-secondary text-light"><i class="fas fa-bell"></i> Notifications</div>
      <div class="card-body">
        @forelse($notifications as $notification)
        <div class="alert alert-primary mb-2">
          <div class="d-flex justify-content-between">
            <a href="{{ route('topics.show', $notification->data['topicSlug'])}}">{{ $notification->data['username'] }} a posté(e) un commentaire sur votre topic <strong>{{ $notification->data['topicTitle'] }}</strong></a>
              <span>{{ $notification->created_at->diffForHumans() }}</span>
            </div>
          </div>
        @empty
        <div class="alert alert-primary mb-2">Aucune notification</div>
        @endforelse
      </div>
  </div>
</div>
@endsection