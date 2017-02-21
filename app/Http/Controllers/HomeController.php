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

    public function index()
    {
        return view('index', [
            'articles' => \App\Article::all(),
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function article($id)
    {
        return view('article', [
            'article' => \App\article::findOrFail($id),
        ]);
    }

    public function comment(Request $request)
    {
        $user = $request->user();
        $comment = new \App\Comment;
        $comment->user_id = $user->id;
        $comment->content = $request->content;
        $article_id = $request->article_id;
        $comment->article_id = $article_id;
        $comment->save();
        $user->notify(new \App\Notifications\CommentNotification($comment));
        return redirect("article/{$article_id}");
    }

    public function notification($id)
    {
        $notification = \App\Notification::findOrFail($id);
        $notification->markAsRead();
        return redirect('article/' . $notification->data['article_id']);
    }
}
