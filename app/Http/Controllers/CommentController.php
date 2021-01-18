<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\Comment;
use App\notifications\NewCommentPosted;

class CommentController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Topic $topic)
    {
    	request()->validate([
    		'content' => 'required'
    	]);

    	$comment = new Comment();
    	$comment->content = request('content');
    	$comment->user_id = Auth::id();

    	$topic->comments()->save($comment);

        // notification

        $topic->user->notify(new NewCommentPosted($topic, auth()->user()));

    	session()->flash('success', 'Votre commentaire à été ajouté avec succés.');

    	return back();
    }

    public function commentReply(Comment $comment)
    {
        request()->validate([
            'replyComment' => 'required'
        ]);

        $commentReply =  new Comment();
        $commentReply->content = request('replyComment');
        $commentReply->user_id =  Auth::id();

        $comment->comments()->save($commentReply);

        session()->flash('success', 'Votre réponse à été ajoutée avec succés.');

        return back();
    }

    public function commentmarkAsSoultion(Topic $topic, Comment $comment)
    {
        if(auth()->user()->id == $topic->user_id)
        {
            $topic->solution = $comment->id;
            $topic->save();
        }

        session()->flash('success', 'vous avez choisi un commentaire comme solution');
        return back();
    }

}
