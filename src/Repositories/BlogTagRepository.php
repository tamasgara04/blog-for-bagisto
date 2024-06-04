<?php

namespace Webbycrown\BlogBagisto\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Arr;
use Webbycrown\BlogBagisto\Models\TagTranslation;

class BlogTagRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webbycrown\BlogBagisto\Models\Tag';
    }

    /**
     * Save blog tag.
     *
     * @param  array  $data
     * @return bool|\Webbycrown\BlogBagisto\Contracts\Tag
     */
    public function save(array $data)
    {
        Event::dispatch('admin.blog.tags.create.before', $data);
    
        // Extract translatable fields from the data
        $translatableFields = Arr::only($data, ['name', 'meta_title', 'meta_description', 'meta_keywords']);
    
        // Add name to admin_name
        $data['admin_name'] = $data['name'];
    
        // Create the tag
        $tag = $this->create(Arr::except($data, array_keys($translatableFields)));
    
        // Save translations
        $this->saveTranslations($tag, $translatableFields, $data['locale']);
    
        Event::dispatch('admin.blog.tags.create.after', $tag);
    
        return $tag;
    }

    protected function saveTranslations($tag, $translations, $locale)
    {
        $translation = TagTranslation::where('tag_id', $tag->id)->where('locale', $locale)->first();
        if (!$translation) {
            $translation = new TagTranslation();
            $translation->tag_id = $tag->id;
            $translation->locale = $locale;
        }
        $translation->name = $translations['name'];
        $translation->meta_title = $translations['meta_title'];
        $translation->meta_description = $translations['meta_description'];
        $translation->meta_keywords = $translations['meta_keywords'];
        $translation->save();
    }

    /**
     * Update item.
     *
     * @param  array  $data
     * @param  int  $id
     * @return bool
     */
    public function updateItem(array $data, $id)
    {
        Event::dispatch('admin.blog.tags.update.before', $id);

        // Extract translatable fields from the data
        $translatableFields = Arr::only($data, ['name', 'meta_title', 'meta_description', 'meta_keywords']);

        // Update the tag
        $tag = $this->update(Arr::except($data, array_keys($translatableFields)), $id);

        // Save translations
        $this->saveTranslations($tag, $translatableFields, $data['locale']);

        Event::dispatch('admin.blog.tags.update.after', $tag);

        return $tag;
    }

    /**
     * Delete a blog tag item and delete the image from the disk or where ever it is.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        Event::dispatch('admin.blog.tags.delete.before', $id);

        parent::delete($id);

        Event::dispatch('admin.blog.tags.delete.after', $id);
    }

    /**
     * Get only active blog tags.
     *
     * @return array
     */
    public function getActiveBlogTags()
    {
        $currentLocale = core()->getCurrentLocale();

        return $this->whereRaw("find_in_set(?, locale)", [$currentLocale->code])
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->toArray();
    }
}
