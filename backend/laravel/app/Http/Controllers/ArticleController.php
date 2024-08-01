<?php
namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function index()
    {
        $articles = $this->articleRepo->getAllPaginated(config('constants.ARTICLES_PER_PAGE'));
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.form');
    }

    public function edit($id)
    {
        $article = $this->articleRepo->find($id);
        if(!$article){
            return abort(404);
        }
        return view('articles.form', compact('article'));
    }

    public function showArticle(Request $request)
    {
        $article = null;

        if ($request->isMethod('post')) {
            $request->validate([
                'id' => 'required|integer',
            ]);

            $id = $request->input('id');

            $article = \DB::select('CALL GetArticleById(?, @p_title, @p_content, @p_image, @p_created_at)', [$id]);
            $result = \DB::select('SELECT @p_title as title, @p_content as content, @p_image as image, @p_created_at as created_at');

            if ($result) {
                $article = $result[0];
            }
        }

        return view('articles.show', compact('article'));
    }
}
