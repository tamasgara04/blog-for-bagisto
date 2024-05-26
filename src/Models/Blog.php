<?php

namespace Webbycrown\BlogBagisto\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webbycrown\BlogBagisto\Contracts\Blog as BlogContract;
use Webkul\Core\Models\ChannelProxy;
use Illuminate\Support\Facades\Storage;
use Webbycrown\BlogBagisto\Models\Category;
use Webbycrown\BlogBagisto\Models\BlogTranslation;
use Astrotomic\Translatable\Translatable;

class Blog extends Model implements BlogContract
{

    protected $table = 'blogs';
    public $translatedAttributes = ['name', 'short_description', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $fillable = [
        'slug',
        'channels',
        'default_category',
        'author',
        'author_id',
        'categorys',
        'tags',
        'src',
        'status',
        'allow_comments',
        'published_at'
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = ['src_url', 'assign_categorys'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'default_category');
    }

    /**
     * Get the channels.
     */
    public function channels()
    {
        return $this->belongsToMany(ChannelProxy::modelClass(), 'channels');
    }

    /**
     * Get image url for the category image.
     *
     * @return string
     */
    public function getSrcUrlAttribute()
    {
        if (!$this->src) {
            return;
        }

        return Storage::url($this->src);
    }

    public function getAssignedCategoriesAttribute()
    {
        $categories = array();
        $categoriesIds = array_values(array_unique(array_merge(explode(',', $this->default_category), explode(',', $this->categorys))));
        if (is_array($categoriesIds) && !empty($categoriesIds) && count($categoriesIds) > 0) {
            $categories = Category::whereIn('id', $categoriesIds)->get();
            $categorys = (!empty($categories) && count($categories) > 0) ? $categories : array();
        }
        return $categorys;
    }

    public function translation($locale)
    {
        // Try to get the translation for the given locale
        $translation = $this->translations->where('locale', $locale)->first();

        // If there's no translation for the given locale, use the fallback locale
        if (!$translation) {
            $fallbackLocale = config('app.fallback_locale');
            $translation = $this->translations->where('locale', $fallbackLocale)->first();
        }

        return $translation;
    }
    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }
}
