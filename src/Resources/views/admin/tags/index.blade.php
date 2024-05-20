<x-admin::layouts>
    <x-slot:title>
        @lang('blog::app.tag.title')
    </x-slot:title>

    <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
        <p class="text-xl text-gray-800 dark:text-white font-bold">
            @lang('blog::app.tag.title')
        </p>

        <div class="flex gap-x-2.5 items-center">
            @if (bouncer()->hasPermission('blog.tag.create'))
            <a href="{{ route('admin.blog.tag.create') }}">
                <div class="primary-button">
                    @lang('blog::app.tag.add-title')
                </div>
            </a>
            @endif
        </div>
    </div>

    {!! view_render_event('bagisto.admin.catalog.categories.list.before') !!}

    <x-admin::datagrid src="{{ route('admin.blog.tag.index') }}"></x-admin::datagrid>

    {!! view_render_event('bagisto.admin.catalog.categories.list.after') !!}

</x-admin::layouts>