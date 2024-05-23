<?php

namespace Webbycrown\BlogBagisto\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslations extends Model
{
    protected $table = 'blog_translations';

    protected $fillable = [
        'blog_id',
        'locale',
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        // Add other translatable fields here
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the blog that owns the translation.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
