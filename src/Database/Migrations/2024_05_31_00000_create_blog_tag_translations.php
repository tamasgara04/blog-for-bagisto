<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTagTranslations extends Migration
{
    public function up()
    {
        Schema::create('blog_tags_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('blog_tags')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->unique(['tag_id', 'locale']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_tags_translations');
    }
}