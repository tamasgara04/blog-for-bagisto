<?php

namespace Webbycrown\BlogBagisto\Datagrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;
use Webbycrown\BlogBagisto\Models\Category;
use Webbycrown\BlogBagisto\Models\Tag;

class BlogDataGrid extends DataGrid
{
    /**
     * Set index columns, ex: id.
     *
     * @var int
     */
    protected $index = 'blogs.id';

    /**
     * Default sort order of datagrid.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Locale.
     *
     * @var string
     */
    protected $locale = 'all';

    /**
     * Channel.
     *
     * @var string
     */
    protected $channel = 'all';

    /**
     * Contains the keys for which extra filters to render.
     *
     * @var string[]
     */
    protected $extraFilters = [
        'channels',
        'locales',
    ];

    public function prepareQueryBuilder()
    {
        $loggedIn_user = auth()->guard('admin')->user();
        $user_id = $loggedIn_user ? $loggedIn_user->id : 0;
        $role = $loggedIn_user && $loggedIn_user->role ? $loggedIn_user->role->name : 'Administrator';

        $locale = $this->locale;

        $queryBuilder = DB::table('blogs')
            ->leftJoin('blog_translations', function ($join) use ($locale) {
                $join->on('blogs.id', '=', 'blog_translations.blog_id')
                    ->where('blog_translations.locale', '=', $locale);
            })
            ->select(
                'blogs.id',
                'blog_translations.name',
                'blogs.slug',
                'blog_translations.short_description',
                'blog_translations.description',
                'blogs.channels',
                'blogs.default_category',
                'blogs.categorys',
                'blogs.published_at',
                'blogs.author',
                'blogs.tags',
                'blogs.src',
                'blogs.status',
                'blogs.allow_comments',
                'blogs.published_at',
                'blog_translations.meta_title',
                'blog_translations.meta_description',
                'blog_translations.meta_keywords'
            );

        if ($role != 'Administrator') {
            $queryBuilder->where('blogs.author_id', $user_id);
        }

        return $queryBuilder;
    }

    public function prepareColumns()
    {
        $this->addColumn([
            'index' => 'blogs.id',
            'label' => trans('blog::app.datagrid.id'),
            'type' => 'integer',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'blog_translations.name',
            'label' => trans('blog::app.datagrid.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($row) {
                // Get the current locale
                $locale = App::getLocale();
        
                // Find the translation for the current locale
                $translation = $row->translations->firstWhere('locale', $locale);
        
                // Return the name of the translation, or a default value if the translation doesn't exist
                return $translation ? $translation->name : 'No translation';
            },
        ]);

        $this->addColumn([
            'index' => 'default_category',
            'label' => trans('blog::app.datagrid.category'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($value) {
                $categories = '-';
                $categories_ids = array_values(array_unique(array_merge(explode(',', $value->default_category), explode(',', $value->categorys))));
                if (is_array($categories_ids) && !empty($categories_ids)) {
                    $categories = Category::whereIn('id', $categories_ids)->pluck('name')->implode(', ');
                }
                return $categories ?: '-';
            },
        ]);

        $this->addColumn([
            'index' => 'tags',
            'label' => 'Tags',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($value) {
                $tags = '-';
                $tags_ids = array_values(array_unique(explode(',', $value->tags)));
                if (is_array($tags_ids) && !empty($tags_ids)) {
                    $tags = Tag::whereIn('id', $tags_ids)->pluck('name')->implode(', ');
                }
                return $tags ?: '-';
            },
        ]);

        $this->addColumn([
            'index' => 'status',
            'label' => trans('blog::app.datagrid.status'),
            'type' => 'boolean',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($value) {
                return $value->status
                    ? '<span class="badge badge-md badge-success label-active">' . trans('blog::app.blog.status-true') . '</span>'
                    : '<span class="badge badge-md badge-danger label-info">' . trans('blog::app.blog.status-false') . '</span>';
            },
        ]);

        $this->addColumn([
            'index' => 'allow_comments',
            'label' => trans('blog::app.datagrid.allow_comments'),
            'type' => 'boolean',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($value) {
                return $value->allow_comments
                    ? '<span class="badge badge-md badge-success label-active">' . trans('blog::app.blog.yes') . '</span>'
                    : '<span class="badge badge-md badge-danger label-info">' . trans('blog::app.blog.no') . '</span>';
            },
        ]);

        $this->addColumn([
            'index' => 'published_at',
            'label' => 'Published At',
            'type' => 'datetime',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($value) {
                return $value->published_at ? date('j F, Y', strtotime($value->published_at)) : '-';
            },
        ]);

        $this->addColumn([
            'index' => 'author',
            'label' => 'Author',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        if (bouncer()->hasPermission('blog.blogs.edit')) {
            $this->addAction([
                'title' => 'edit',
                'method' => 'GET',
                'icon' => 'icon-edit',
                'route' => 'admin.blog.edit',
                'url' => function ($row) {
                    return route('admin.blog.edit', $row->id);
                },
            ]);
        }

        if (bouncer()->hasPermission('blog.blogs.delete')) {
            $this->addAction([
                'title' => 'delete',
                'method' => 'POST',
                'icon' => 'icon-delete',
                'route' => 'admin.blog.delete',
                'url' => function ($row) {
                    return route('admin.blog.delete', $row->id);
                },
            ]);
        }
    }

    public function prepareMassActions()
    {
        if (bouncer()->hasPermission('blog.blogs.delete')) {
            $this->addMassAction([
                'type' => 'delete',
                'label' => trans('admin::app.datagrid.delete'),
                'title' => 'Delete',
                'action' => route('admin.blog.massdelete'),
                'url' => route('admin.blog.massdelete'),
                'method' => 'POST',
            ]);
        }
    }
}
