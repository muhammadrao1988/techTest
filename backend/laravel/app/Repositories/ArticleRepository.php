<?php
namespace App\Repositories;

use App\Http\Resources\Api\ArticleCollection;
use App\Http\Resources\Api\ArticleResource;
use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getAllPaginated($perPage)
    {
        return $this->article->orderBy('id','desc')->paginate($perPage);

        return new ArticleCollection($articles);
    }

    public function find($id)
    {
        $article = $this->article->find($id);
        if($article){
            return new ArticleResource($article);
        }
    }

    public function create(array $data)
    {
        return $this->article->create($data);
    }

    public function update($id, array $data)
    {
        $article = $this->article->find($id);
        if ($article) {
            return $article->update($data);
        }
        return false;
    }

    public function destroy($id)
    {
        return $this->article->destroy($id);
    }
}
