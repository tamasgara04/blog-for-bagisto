<?php

namespace Webbycrown\BlogBagisto\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webbycrown\BlogBagisto\Contracts\Tag as TagContract;

class Tag extends Model implements TagContract
{
    use HasFactory;

    protected $table = 'blog_tags';

    protected $fillable = [
        'admin_name',
        'slug',
        'status',
    ];

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
        return $this->hasMany(TagTranslation::class);
    }
}
