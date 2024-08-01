<?php
namespace App\Repositories;

interface ArticleRepositoryInterface
{
    public function getAllPaginated($perPage);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function destroy($id);
}
