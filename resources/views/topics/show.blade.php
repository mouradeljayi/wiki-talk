@extends('layouts.app')

@section('title', 'voir topic')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success text-center">
    {{ session('success')}}
</div>
@endif

<style type="text/css">
    p {
        font-size: 20px;
    }

    details > summary {
      padding: 4px;
      width: 200px;
      margin: 10px;
      background-color: #eeeeee;
      border: none;
      box-shadow: 1px 1px 2px #bbbbbb;
      cursor: pointer;
    }

    .solution{
        border: 6px dotted #28a745 !important;
    }
</style>

<main class="container mt-4 mb-5">
	<div class="d-flex justify-content-between">
		<h4><strong>{{ $topic->title }}</strong></h4>
	    <div class="d-flex justify-content-center">
            @can('update', $topic)
            <a href="{{ route('topics.edit', $topic) }}" class="btn btn-warning rounded-circle"><i class="fas fa-edit"></i></a>
            @endcan

            @can('delete', $topic)
            <form action="{{ route('topics.destroy', $topic) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ml-2 rounded-circle"><i class="fas fa-trash"></i></button>
            </form>
            @endcan
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
    	<div class="col-md-12">
            <div>{{ $topic->user->name }}</div>
    		<div class="card shadow mt-2">
    			<div class="card-body">
                    <p>{{ $topic->content }}</p>
    			</div>
    		</div>
            <div class="d-flex justify-content-start mt-3">
                <div class="badge badge-secondary">Posté le {{ $topic->created_at->format('d/m/Y à H:m') }}</div>
            </div>
    	</div>
    </div>
    <hr>
    <h5>Commentaires [{{ $topic->comments->count() }}]</h5>
    @forelse( $topic->comments as $comment)
    <div class="card mb-2 shadow-sm rounded border @if($topic->solution == $comment->id) solution @endif ">
        <div class="card-body">
           <div class="d-flex justify-content-between">
               <div><strong>{{ $comment->user->name }}</strong></div>
               <div class="d-flex justify-content-center">
                @auth
                @if(!$topic->solution && auth()->user()->id == $topic->user->id)
                <form action="{{ route('comments.commentmarkAsSoultion', [$topic, $comment]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-info mr-2">Marquer comme solution</button>
                </form>
                @endauth
                @else 
                  @if($topic->solution == $comment->id)
                  <div class="text-success mr-2 font-weight-bold"><i class="fas fa-check"></i> Solution</div>
                  @endif
                @endif
                <span><i class="fas fa-clock"></i> {{ $comment->created_at->diffForHumans() }}</span>
               </div>
           </div>
           <div>
               {{ $comment->content }}   
           </div>
        </div>
    </div>
    @if($comment->comments->count())
    <details>
        <summary>Afficher les réponses</summary>
    @foreach($comment->comments as $replyComment)
    <div class="border-bottom border-info mb-2 mt-2 ml-5">
        <p style="font-size: 15px;">{{ $replyComment->content }} –  <span class="font-weight-bold">{{ $replyComment->user->name }}</span></p>
    </div>
    @endforeach  
    </details>
    @endif
    @auth
    <button class="btn btn-sm btn-secondary mb-3 mt-1" onclick="toggleReplyComment( {{ $comment->id }} )">Répondre</button>
    <form action="{{ route('comments.reply', $comment) }}" method="post" id="replyComment-{{ $comment->id }}" class="d-none ml-5">
        @csrf
        <div class="form-group">
            <textarea type="text" rows="5" name="replyComment" id="replyComment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-sm btn-info mb-3">répondre</button>
    </form>
    @endauth
    @empty
    <div class="alert alert-info shadow-sm rounded">Aucun commentaire</div>
    @endforelse
    @auth
    <form method="post" class="mt-3" action="{{ route('comments.store', $topic) }}">
        @csrf
            <div class="form-group">
                <label>Votre Commentaire</label>
                <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror"></textarea>

                @error('content')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info">Ajouter commentaire</button>
        </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-outline-info">S'identifier pour avoir Ajouter un commentaire</a>
    @endauth
</main>

@endsection

@section('javascript')
<script>
    function toggleReplyComment(id)
    {
        let element = document.getElementById('replyComment-' + id);
        element.classList.toggle('d-none');
    }
</script>
@endsection