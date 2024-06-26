<?php

namespace Webbycrown\BlogBagisto\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webbycrown\BlogBagisto\Contracts\Category as CategoryContract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class Category extends Model implements CategoryContract
{
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = [
        'admin_name',
        'slug',
        'image',
        'status',
        'parent_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = ['image_url', 'parent_category_name', 'children', 'assign_blogs'];

    public function blog()
    {
        return $this->hasMany(Blog::class, 'default_category');
    }

    /**
     * Get image url for the category image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return;
        }

        return Storage::url($this->image);
    }

    /**
     * Get parent category name for the category.
     *
     * @return string
     */
    public function getParentCategoryNameAttribute()
    {
        if (!$this->parent_id || (int)$this->parent_id <= 0) {
            return;
        }

        $category = Category::find($this->parent_id);

        $parent_category_name = $category ? $category->name : null;

        return $parent_category_name;
    }

    /**
     * Get parent category for the category.
     *
     * @return string
     */
    public function getParentCategoryAttribute()
    {
        if (!$this->parent_id || (int)$this->parent_id <= 0) {
            return;
        }

        return Category::find($this->parent_id);
    }

    /**
     * Get child category for the category.
     *
     * @return string
     */
    public function getChildrenAttribute()
    {
        if (!$this->id || (int)$this->id <= 0) {
            return;
        }

        if (Session::has('bCatEditId') && Session::get('bCatEditId') > 0) {
            return Category::where('id', '!=', Session::get('bCatEditId'))->where('parent_id', $this->id)->get();
        }

        return Category::where('parent_id', $this->id)->get();
    }

    /**
     * Get child category for the category.
     *
     * @return string
     */
    public function getAssignBlogsAttribute()
    {
        if (!$this->id || (int)$this->id <= 0) {
            return 0;
        }

        $assign_blogs = 0;

        $this_id = $this->id;

        $blogs = Blog::where('status', 1)
            ->where(
                function ($query) use ($this_id) {
                    $query->where('default_category', $this_id)
                        ->orWhereRaw('FIND_IN_SET(?, categorys)', [$this_id]);
                }
            )
            ->get();

        if (!empty($blogs) && count($blogs) > 0) {
            $assign_blogs = count($blogs);
        }

        return $assign_blogs;
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
        return $this->hasMany(CategoryTranslation::class);
    }
}
