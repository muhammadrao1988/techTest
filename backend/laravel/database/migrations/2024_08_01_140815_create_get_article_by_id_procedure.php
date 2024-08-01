<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::unprepared('
            CREATE PROCEDURE GetArticleById(
                IN p_id INT,
                OUT p_title VARCHAR(255),
                OUT p_content TEXT,
                OUT p_image VARCHAR(255),
                OUT p_created_at DATETIME
            )
            BEGIN
                SELECT title, content, image, created_at
                INTO p_title, p_content, p_image, p_created_at
                FROM articles
                WHERE id = p_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::unprepared('DROP PROCEDURE IF EXISTS GetArticleById');
    }
};
