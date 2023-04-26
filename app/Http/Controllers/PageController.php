<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Program;
use App\Helpers\CommonHelper;
use App\Models\Article;
use App\Models\Content;

class PageController extends Controller
{
    public function home()
    {
        $news = News::select('name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where('active', 1)->orderBy('created_at', 'desc')->take(3)->get();

        $mostUsedCategory = Program::select('parent_id')
            ->with(['parent' => function ($query) {
                $query->select('id', 'name');
            }])->groupBy('parent_id')->orderByRaw('COUNT(*) DESC')->first();

        $program = Program::select('name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where([
            ['active', '=', 1],
            ['parent_id', '=', $mostUsedCategory['parent_id']]
        ])->orderBy('created_at', 'desc')->get();

        $content = Content::select('name', 'slug', 'image', 'type', 'description', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where([
            ['active', '=', 1],
            ['is_highlight', '=', 1],
        ])->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('news', 'mostUsedCategory', 'program', 'content'));
    }

    public function liveTV()
    {
        $program = CommonHelper::getBrowseProgramLiveTV();

        return view('pages.live-tv', compact('program'));
    }

    public function news()
    {
        $news = News::select('name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where('active', 1)->orderBy('created_at', 'desc')->paginate();

        // Get popular news
        $popularNews = CommonHelper::getPopularNews(null);

        return view('pages.news.index', compact('news', 'popularNews'));
    }

    public function newsDetail($slug)
    {
        $newsDetail = News::where([
            ['active', '=', 1],
            ['slug', '=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->first(['id', 'name', 'slug', 'image', 'source', 'description', 'body', 'author', 'viewed', 'parent_id', 'created_at']);

        if (!$newsDetail) {
            abort(404);
        }

        // Check if user has viewed this news before
        $viewedNews = session('viewed_news', []);
        if (!in_array($newsDetail->id, $viewedNews)) {
            // Increment the viewed count
            $newsDetail->increment('viewed');

            // Add news ID to the viewed news list in session
            $viewedNews[] = $newsDetail->id;
            session(['viewed_news' => $viewedNews]);
        }

        $relatedNews = News::where([
            ['active', '=', 1],
            ['parent_id', '=', $newsDetail->parent_id],
            ['slug', '!=', $slug]
        ])->with('user:id,name,email', 'parent:id,name')
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'created_at']);

        // Get popular news
        $popularNews = CommonHelper::getPopularNews($slug);

        // Get latest news
        $latestNews = CommonHelper::getLatestNews($slug);

        return view('pages.news.detail', compact('newsDetail', 'relatedNews', 'popularNews', 'latestNews'));
    }

    public function program()
    {
        $program = Program::select('name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where('active', 1)->orderBy('created_at', 'desc')->paginate();

        // Get popular news
        $popularProgram = CommonHelper::getPopularProgram(null);

        return view('pages.program.index', compact('program', 'popularProgram'));
    }

    public function programDetail($slug)
    {
        $programDetail = Program::where([
            ['active', '=', 1],
            ['slug', '=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->first(['id', 'name', 'slug', 'image', 'source', 'description', 'body', 'author', 'viewed', 'parent_id', 'attr_1 as duration', 'created_at']);

        if (!$programDetail) {
            abort(404);
        }

        // Check if user has viewed this program before
        $viewedProgram = session('viewed_program', []);
        if (!in_array($programDetail->id, $viewedProgram)) {
            // Increment the viewed count
            $programDetail->increment('viewed');

            // Add news ID to the viewed news list in session
            $viewedProgram[] = $programDetail->id;
            session(['viewed_program' => $viewedProgram]);
        }

        $relatedProgram = Program::where([
            ['active', '=', 1],
            ['parent_id', '=', $programDetail->parent_id],
            ['slug', '!=', $slug]
        ])->with('user:id,name,email', 'parent:id,name')
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);

        return view('pages.program.detail', compact('programDetail', 'relatedProgram'));
    }

    public function article()
    {
        $article = Article::select('name', 'slug', 'image', 'source', 'body', 'author', 'parent_id', 'created_at')->with(['user' => function ($query) {
            $query->select('id', 'name', 'email');
        }, 'parent' => function ($query) {
            $query->select('id', 'name');
        }])->where('active', 1)->orderBy('created_at', 'desc')->paginate();

        return view('pages.article.index', compact('article'));
    }

    public function articleDetail($slug)
    {
        $articleDetail = Article::where([
            ['active', '=', 1],
            ['slug', '=', $slug]
        ])
            ->with('user:id,name,email', 'parent:id,name')
            ->first(['id', 'name', 'image', 'body', 'author', 'viewed', 'parent_id', 'created_at']);

        if (!$articleDetail) {
            abort(404);
        }

        // Check if user has viewed this program before
        $viewedArticle = session('viewed_program', []);
        if (!in_array($articleDetail->id, $viewedArticle)) {
            // Increment the viewed count
            $articleDetail->increment('viewed');

            // Add news ID to the viewed news list in session
            $viewedArticle[] = $articleDetail->id;
            session(['viewed_program' => $viewedArticle]);
        }

        $relatedArticle = Article::where([
            ['active', '=', 1],
            ['parent_id', '=', $articleDetail->parent_id],
            ['slug', '!=', $slug]
        ])->with('user:id,name,email', 'parent:id,name')
            ->get(['name', 'slug', 'image', 'source', 'description', 'body', 'author', 'parent_id', 'attr_1 as duration', 'created_at']);

        return view('pages.article.detail', compact('articleDetail', 'relatedArticle'));
    }
}
