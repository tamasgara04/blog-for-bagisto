<?php

namespace Webbycrown\BlogBagisto\Models;

use Astrotomic\Translatable\Model as TranslatableModel;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    // Specify the table associated with the model
    protected $table = 'blog_translations';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // Indicates if the model should be timestamped
    public $timestamps = false;

    /**
     * Get the blog that owns the translation.
     */
    public function blog()
    {
        // Define the inverse of the one-to-many relationship
        return $this->belongsTo(Blog::class);
    }
}