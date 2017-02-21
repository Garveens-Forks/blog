<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.articles', [
            'articles' => $request->user()->articles()->withCount('comments')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->user()->categories()->count()) {
            return redirect('admin/category');
        }
        return view('admin/article', [
            'article' => false,
            'categories' => $request->user()->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // TODO: check category owner
        ]);
        $article = new Article;
        $article->subject = $request->subject;
        $article->content = $request->content;
        $article->user_id = $request->user()->id;
        $article->status = 'draft';
        $article->save();
        $article->categories()->sync([$request->category_id]);
        return redirect('/admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('admin/article', [
            'article' => Article::findOrFail($id),
            'categories' => $request->user()->categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if ($article->user->id != $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'subject' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // TODO: check category owner
        ]);
        $article->subject = $request->subject;
        $article->content = $request->content;
        if ($request->status) {

            $article->status = $request->status;
        }
        $article->save();
        $article->categories()->sync([$request->category_id]);
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->comments()->delete();
        $article->delete();
        return redirect('admin');
    }
}
