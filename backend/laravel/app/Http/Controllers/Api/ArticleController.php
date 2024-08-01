<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function index()
    {
        return response()->json($this->articleRepo->getAllPaginated(config('constants.ARTICLES_PER_PAGE')));
    }

    public function show($id)
    {
        $article = $this->articleRepo->find($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    public function store(Request $request)
    {
        $article = new Article();
        try {
            $article->validateRequest($request->all());
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 400);
        }

        $data = $this->handleImageUpload($request);
        $createdArticle = $this->articleRepo->create($data);
        $createdArticle['msg'] = "Article created successfully.";

        return response()->json($createdArticle, 201);
    }

    public function update(Request $request, $id)
    {
        $articleRecord = $this->articleRepo->find($id);

        if (!$articleRecord) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $article = new Article();
        try {
            $article->validateRequest($request->all(), $id);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 400);
        }

        $data = $this->handleImageUpload($request);

        $updatedArticle = $this->articleRepo->update($id, $data);
        return response()->json($updatedArticle);
    }

    public function destroy($id)
    {
        $article = $this->articleRepo->find($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $this->articleRepo->destroy($id);
        return response()->json(null, 204);
    }

    private function handleImageUpload(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . \Str::uuid() . '.' . $file->getClientOriginalExtension(); // Generate a unique name
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $data['image'] = $name;
        }
        return $data;
    }
}
