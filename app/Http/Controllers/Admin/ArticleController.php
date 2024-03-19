<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleModel;

    public function __construct(Article $article)
    {
        $this->articleModel = $article;
    }

    public function index()
    {
        $articles = $this->articleModel->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }
    public function addarticle()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:200',
            'desc' => 'required|string',
        ]);
        $this->articleModel::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'status' => ($request->show) ? 1 : 0,
        ]);

        return redirect(route('articales'))->with('message', 'تم اضافة المقال بنجاح');
    }
    public function verify(Request $request)
    {
        $article = $this->articleModel->findOrFail($request->article_id);

        $article->update([
            'status' => ($article->status == 1) ? 0 : 1,
        ]);

        session()->flash('message', ($article->status == 1) ? 'تم تفعيل المقال بنجاح' : 'تم تعطيل المقال بنجاح');
        return redirect()->back();
    }

    public function edit($id)
    {
        $article = $this->articleModel->find($id);
        return view('admin.articles.edit', compact('article'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'title' => 'required|string|min:3|max:200',
            'desc' => 'required|string',
        ]);

        $article = $this->articleModel::find($request->article_id);

        $article->update([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        return redirect(route('articales'))->with('message', 'تم تعديل بيانات المقال بنجاح');

    }

    public function delete(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        $article = $this->articleModel::find($request->article_id);
        $article->delete();
        return back()->with('message', 'تم حذف المقال بنجاح');
    }
}
