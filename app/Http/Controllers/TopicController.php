<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Modesl\Comment;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

    }

    public function index()
    {
        $topics = Topic::latest()->paginate(5);

        return view('topics.index', ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|unique:topics',
        'content' => 'required'
        ]);

        Topic::create([
        'title' => $request->title,
        'content' => $request->content,
        'slug' => Str::slug($request->title),
        'user_id' => Auth::id()
        ]);

        session()->flash("success", "Votre topic à été crée avec succés.");

        return redirect()->route('topics.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('topics.show', ['topic' => $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('topics.edit', ['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update([
        'title' => $request->title,
        'content' => $request->content,
        'slug' => Str::slug($request->title),
        'user_id' => Auth::id()
        ]);

        session()->flash("success", "Votre topic à été modifiée avec succés.");

        return redirect()->route('topics.show', $topic );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        session()->flash("success", "Votre topic à été supprimée avec succés.");

        return redirect()->route('topics.index');
    }
}
