<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('locale');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_keywords');
            $table->string('admin_name')->after('id');
        });
    }

    public function down()
    {
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropColumn('admin_name');
            $table->string('name')->after('id');
            $table->text('description')->nullable();
            $table->string('locale');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
        });
    }
}