<?php

namespace App\Http\Controllers;

use App\Helper\Article;
use App\Http\Requests\ArticleStoreRequest;

class ArticleController extends Controller
{
    public function store(ArticleStoreRequest $request)
    {
        return Article::postArticle(1, $request->input('title', ''), $request->input('url', '/'));
    }

    public function add()
    {
        return view('article.add');
    }

    public function index()
    {

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
