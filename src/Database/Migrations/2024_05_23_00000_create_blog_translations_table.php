<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('blog_id');
            $table->string('locale')->index();

            // Translatable attributes
            $table->string('name');
            $table->text('short_description');
            $table->text('description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keywords');

            $table->unique(['blog_id', 'locale']);
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_translations');
    }
}
?>