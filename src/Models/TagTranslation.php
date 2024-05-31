<?php

namespace Webbycrown\BlogBagisto\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webbycrown\BlogBagisto\Contracts\Tag as TagContract;

class TagTranslation extends Model implements TagContract
{
    use HasFactory;

    protected $table = 'blog_tags_translations';

    protected $fillable = [
        'name',
        'description',
        'locale',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
