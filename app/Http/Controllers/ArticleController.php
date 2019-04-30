<?php

namespace App\Http\Controllers;

use App\Helper\Article;
use App\Http\Requests\ArticleStoreRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store(ArticleStoreRequest $request)
    {
        Article::postArticle($request->user()->id, $request->input('title', ''), $request->input('url', '/'));
        return redirect('/home');
    }

    public function add()
    {
        return view('article.add');
    }

    public function index(Request $request)
    {
        $articles = Article::getArticles($request->input('page', 1), $request->input('order', 'score:'));
        return view('article.index', ['articles' => $articles]);
    }

    public function edit()
    {

    }

    public function update()
    {

    }


    public function delete()
    {

    }
}
