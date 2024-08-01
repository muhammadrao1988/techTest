<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ValidatesRequests;

class Article extends Model
{
    use HasFactory, ValidatesRequests;

    protected $fillable = ['title', 'content', 'image'];

    public static function rules($id = null)
    {
        return [
            'title' => 'required|string|max:255|unique:articles,title' . ($id ? ",$id" : ''),
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ];
    }

    public function validateRequest($data, $id = null)
    {
        $this->validate($data, self::rules($id));
    }
}
