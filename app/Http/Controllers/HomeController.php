<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function article($id)
    {
        return view('article', [
            'article' => \App\article::findOrFail($id)
        ]);
    }

    public function comment(Request $request)
    {
        $comment = new \App\Comment;
        $comment->user_id = $request->user()->id;
        $comment->content = $request->content;
        $article_id = $request->article_id;
        $comment->article_id = $article_id;
        $comment->save();
        return redirect("article/{$article_id}");
    }
}
