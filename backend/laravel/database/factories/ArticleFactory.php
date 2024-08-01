<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence,
            'content' => $this->faker->paragraph,
            'image' => 'placeholder.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
