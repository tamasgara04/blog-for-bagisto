<x-admin::layouts>
    <x-slot:title>
        @lang('blog::app.blog.edit-title')
    </x-slot:title>

    @pushOnce('styles')

    <style type="text/css">
        .v-tree-container>.v-tree-item:not(.has-children) {
            padding-left: 18px !important;
        }
    </style>

    @endPushOnce

    @php
    $channels = core()->getAllChannels();

    $currentChannel = core()->getRequestedChannel();

    $currentLocale = core()->getRequestedLocale();
    @endphp

    <!-- Blog Edit Form -->
    <x-admin::form :action="route('admin.blog.update', $blog->id)" method="POST" enctype="multipart/form-data">

        {!! view_render_event('admin.blogs.edit.before') !!}

        <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
            <p class="text-xl text-gray-800 dark:text-white font-bold">
                @lang('blog::app.blog.edit-title')
            </p>

            <div class="flex gap-x-2.5 items-center">
                <!-- Back Button -->
                <a href="{{ route('admin.blog.index') }}" class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-white">
                    @lang('admin::app.catalog.categories.edit.back-btn')
                </a>

                <!-- Save Button -->
                <button type="submit" class="primary-button">
                    @lang('blog::app.blog.edit-btn-title')
                </button>
            </div>
        </div>

        <!-- Channel and Locale Switcher -->
        <div class="flex  gap-4 justify-between items-center mt-7 max-md:flex-wrap">
            <div class="flex gap-x-1 items-center">
                <!-- Channel Switcher -->
                <x-admin::dropdown :class="$channels->count() <= 1 ? 'hidden' : ''">
                    <!-- Dropdown Toggler -->
                    <x-slot:toggle>
                        <button type="button" class="transparent-button px-1 py-1.5 hover:bg-gray-200 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-800 dark:text-white">
                            <span class="icon-store text-2xl"></span>

                            {{ $currentChannel->name }}

                            <input type="hidden" name="channel" value="{{ $currentChannel->code }}" />

                            <span class="icon-sort-down text-2xl"></span>
                        </button>
                        </x-slot>

                        <!-- Dropdown Content -->
                        <x-slot:content class="!p-0">
                            @foreach ($channels as $channel)
                            <a href="?{{ Arr::query(['channel' => $channel->code, 'locale' => $currentLocale->code]) }}" class="flex gap-2.5 px-5 py-2 text-base cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950 dark:text-white">
                                {{ $channel->name }}
                            </a>
                            @endforeach
                            </x-slot>
                </x-admin::dropdown>

                <!-- Locale Switcher -->
                <x-admin::dropdown :class="$currentChannel->locales->count() <= 1 ? 'hidden' : ''">
                    <!-- Dropdown Toggler -->
                    <x-slot:toggle>
                        <button type="button" class="transparent-button px-1 py-1.5 hover:bg-gray-200 dark:hover:bg-gray-800 focus:bg-gray-200 dark:focus:bg-gray-800 dark:text-white">
                            <span class="icon-language text-2xl"></span>

                            {{ $currentLocale->name }}

                            <input type="hidden" name="locale" value="{{ $currentLocale->code }}" />

                            <span class="icon-sort-down text-2xl"></span>
                        </button>
                        </x-slot>

                        <!-- Dropdown Content -->
                        <x-slot:content class="!p-0">
                            @foreach ($currentChannel->locales->sortBy('name') as $locale)
                            <a href="?{{ Arr::query(['channel' => $currentChannel->code, 'locale' => $locale->code]) }}" class="flex gap-2.5 px-5 py-2 text-base cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-950 dark:text-white {{ $locale->code == $currentLocale->code ? 'bg-gray-100 dark:bg-gray-950' : ''}}">
                                {{ $locale->name }}
                            </a>
                            @endforeach
                            </x-slot>
                </x-admin::dropdown>
            </div>
        </div>

        <!-- Full Pannel -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">

            <!-- Left Section -->
            <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">

                <!-- General -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('admin::app.catalog.categories.create.general')
                    </p>

                    <!-- Locales -->
                    <x-admin::form.control-group.control type="hidden" name="locale" value="{{ $currentLocale->code }}">
                    </x-admin::form.control-group.control>

                    <!-- Channel -->
                    <x-admin::form.control-group.control type="hidden" name="channels" value="1">
                    </x-admin::form.control-group.control>

                    <!-- Name -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            @lang('blog::app.blog.name')
                        </x-admin::form.control-group.label>

                        <v-field type="text" name="name" value="{{ old('name', $blog->translation($currentLocale->code)->name) }}" label="{{ trans('blog::app.blog.name') }}" rules="required" v-slot="{ field }">
                            <input type="text" name="name" id="name" v-bind="field" :class="[errors['{{ 'name' }}'] ? 'border border-red-600 hover:border-red-600' : '']" class="flex w-full min-h-[39px] py-2 px-3 border rounded-md text-sm text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 dark:bg-gray-900 dark:border-gray-800" placeholder="{{ trans('blog::app.blog.name') }}" v-slugify-target:slug="setValues">
                        </v-field>

                        <x-admin::form.control-group.error control-name="name">
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                    <!-- Slug -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            @lang('blog::app.blog.slug')
                        </x-admin::form.control-group.label>

                        <v-field type="text" name="slug" value="{{ old('slug', $blog->slug) }}" label="{{ trans('blog::app.blog.slug') }}" rules="required" v-slot="{ field }">
                            <input type="text" name="slug" id="slug" v-bind="field" :class="[errors['slug'] ? 'border border-red-600 hover:border-red-600' : '']" class="flex w-full min-h-[39px] py-2 px-3 border rounded-md text-sm text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 dark:bg-gray-900 dark:border-gray-800" placeholder="{{ trans('blog::app.blog.slug') }}" v-slugify-target:slug="setValues">
                        </v-field>

                        <x-admin::form.control-group.error control-name="slug">
                        </x-admin::form.control-group.error>
                    </x-admin::form.control-group>

                </div>

                <!-- Description and images -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('blog::app.blog.description-and-images')
                    </p>

                    <!-- Meta Description -->
                    <x-admin::form.control-group class="mb-2.5">
                        <x-admin::form.control-group.label class="required">
                            @lang('blog::app.blog.short_description')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control type="textarea" name="short_description" id="short_description" rules="required" :value="$blog->translation($currentLocale->code)->short_description" :label="trans('blog::app.blog.short_description')" :placeholder="trans('blog::app.blog.short_description')">
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="short_description"></x-admin::form.control-group.error>

                    </x-admin::form.control-group>

                    <!-- Description -->
                    <v-description>
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="required">
                                @lang('blog::app.blog.description')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="textarea" name="description" id="description" class="description" rules="required" :value="old('description', $blog->translation($currentLocale->code)->description)" :label="trans('blog::app.blog.description')" :tinymce="true" placeholder="{{ trans('blog::app.blog.description') }}" :prompt="core()->getConfigData('general.magic_ai.content_generation.category_description_prompt')">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="description">
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>
                    </v-description>

                    <div class="flex gap-12">
                        <!-- Add Logo -->
                        <div class="flex flex-col gap-2 w-2/5 mt-5">
                            <p class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.blog.image')
                            </p>

                            <x-admin::media.images name="src"></x-admin::media.images>

                            <x-admin::form.control-group.error control-name="src"></x-admin::form.control-group.error>

                        </div>

                    </div>
                </div>

                <!-- SEO Deatils -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('blog::app.blog.search_engine_optimization')
                    </p>

                    <!-- SEO Title & Description Blade Componnet -->
                    {{-- <x-admin::seo/> --}}
                    <v-seo-helper-custom></v-seo-helper-custom>

                    <div class="mt-8">
                        <!-- Meta Title -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="required">
                                @lang('blog::app.blog.meta_title')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="text" name="meta_title" id="meta_title" rules="required" :value="old('meta_title', $blog->translation($currentLocale->code)->meta_title)" :label="trans('blog::app.blog.meta_title')" :placeholder="trans('blog::app.blog.meta_title')">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="meta_title"></x-admin::form.control-group.error>

                        </x-admin::form.control-group>

                        <!-- Meta Keywords -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="required">
                                @lang('blog::app.blog.meta_keywords')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="text" name="meta_keywords" rules="required" :value="old('meta_keywords', $blog->translation($currentLocale->code)->meta_keywords)" :label="trans('blog::app.blog.meta_keywords')" :placeholder="trans('blog::app.blog.meta_keywords')">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="meta_keywords"></x-admin::form.control-group.error>

                        </x-admin::form.control-group>

                        <!-- Meta Description -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="required">
                                @lang('blog::app.blog.meta_description')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="textarea" name="meta_description" id="meta_description" rules="required" :value="old('meta_description', $blog->translation($currentLocale->code)->meta_description)" :label="trans('blog::app.blog.meta_description')" :placeholder="trans('blog::app.blog.meta_description')">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="meta_description"></x-admin::form.control-group.error>

                        </x-admin::form.control-group>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex flex-col gap-2 w-[360px] max-w-full">
                <!-- Settings -->

                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-2.5 text-gray-800 dark:text-gray-300 text-base font-semibold">
                            @lang('admin::app.catalog.categories.create.settings')
                        </p>
                    </x-slot:header>

                    <x-slot:content>

                        <!-- Published At -->
                        <x-admin::form.control-group class="w-full mb-2.5">
                            <x-admin::form.control-group.label class="required">
                                @lang('blog::app.blog.published_at')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="date" name="published_at" id="published_at" rules="required" :value="old('published_at') ?? date_format(date_create($blog->published_at),'Y-m-d')" :label="trans('blog::app.blog.published_at')" :placeholder="trans('blog::app.blog.published_at')">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="published_at">
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                        <!-- Status -->
                        <input type="hidden" name="status" id="status" value="@php echo $blog->status @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.blog.status')
                            </x-admin::form.control-group.label>

                            @php $selectedValue_status = old('status') ?: $blog->status @endphp

                            <x-admin::form.control-group.control type="switch" name="status_switch" id="status_switch" class="cursor-pointer" value="1" :label="trans('blog::app.blog.status')" :checked="(boolean) $selectedValue_status">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Allow Comments -->
                        <input type="hidden" name="allow_comments" id="allow_comments" value="@php echo $blog->allow_comments @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.blog.allow_comments')
                            </x-admin::form.control-group.label>

                            @php $selectedValue_allow_comments = old('allow_comments') ?: $blog->allow_comments @endphp

                            <x-admin::form.control-group.control type="switch" name="allow_comments_switch" class="cursor-pointer" value="1" :label="trans('blog::app.blog.allow_comments')" :checked="(boolean) $selectedValue_allow_comments">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Auther -->
                        @php

                        $loggedIn_user = auth()->guard('admin')->user()->toarray();
                        $user_id = ( array_key_exists('id', $loggedIn_user) ) ? $loggedIn_user['id'] : 0;
                        $user_name = ( array_key_exists('name', $loggedIn_user) ) ? $loggedIn_user['name'] : '';
                        $role = ( array_key_exists('role', $loggedIn_user) ) ? ( array_key_exists('name', $loggedIn_user['role']) ? $loggedIn_user['role']['name'] : 'Administrator' ) : 'Administrator';

                        @endphp

                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="required text-gray-800 dark:text-white font-medium required">
                                @lang('blog::app.blog.author')
                            </x-admin::form.control-group.label>

                            @if( $role != 'Administrator' )
                            <input type="hidden" name="author_id" id="author_id" value="{{$user_id}}">
                            <x-admin::form.control-group.control type="text" name="author" rules="required" disabled="disabled" :value="$user_name" :label="trans('blog::app.blog.author')" :placeholder="trans('blog::app.blog.author')">
                            </x-admin::form.control-group.control>
                            @else
                            <x-admin::form.control-group.control type="select" name="author_id" id="author_id" {{-- class="cursor-pointer" --}} rules="required" :value="old('author_id') ?? $blog->author_id" :label="trans('blog::app.blog.author')" {{-- :placeholder="trans('blog::app.blog.author')" --}}>
                                <!-- Options -->
                                <option value="">@lang('blog::app.blog.select_author')</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="author">
                            </x-admin::form.control-group.error>
                            @endif
                        </x-admin::form.control-group>

                    </x-slot:content>
                </x-admin::accordion>

                <!-- Default Categories -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="required p-2.5 text-gray-800 dark:text-gray-300 text-base font-semibold">
                            @lang('blog::app.blog.additional_category')
                        </p>
                    </x-slot:header>

                    <x-slot:content>

                        <!-- Category -->
                        <x-admin::form.control-group class="mb-2.5">

                            <x-admin::form.control-group.control type="select" name="default_category" id="default_category" {{-- class="cursor-pointer" --}} rules="required" :value="old('default_category') ?? $blog->default_category" :label="trans('blog::app.blog.default_category')">
                                <!-- Options -->
                                <option value="">@lang('blog::app.blog.select_category')</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" data-slug="{{$category->slug}}" id="{{'default_category'.$category->id}}" {{ $blog->default_category == $category->id ? 'selected' : '' }}>{{$category->translation($currentLocale->code)->name}}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="default_category">
                            </x-admin::form.control-group.error>
                        </x-admin::form.control-group>

                    </x-slot:content>
                </x-admin::accordion>

                <!-- Additional Category -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-2.5 text-gray-800 dark:text-gray-300 text-base font-semibold">
                            @lang('blog::app.blog.additional_category')
                        </p>
                    </x-slot:header>

                    <x-slot:content>

                        <!-- Status -->
                        <div class="flex flex-col gap-[12px]">
                            <x-admin::tree.view input-type="checkbox" name-field="categorys" id-field="id" value-field="id" :items="json_encode($additional_categories)" :value="json_encode(explode(',', $blog->categorys))" behavior="no" :fallback-locale="config('app.fallback_locale')">
                            </x-admin::tree.view>
                        </div>

                    </x-slot:content>
                </x-admin::accordion>

                <!-- Tags -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="required p-2.5 text-gray-800 dark:text-gray-300 text-base font-semibold">
                            @lang('blog::app.blog.tag_title')
                        </p>
                    </x-slot:header>

                    <x-slot:content>
                        @foreach ($tags as $tag)
                        <x-admin::form.control-group class="flex gap-2.5 !mb-0 p-1.5">
                            <x-admin::form.control-group.control type="checkbox" name="tags[]" :id="$tag->translation($currentLocale->code)->name" :value="$tag->id" rules="required" :for="$tag->translation($currentLocale->code)->name" :label="trans('blog::app.blog.tags')" :checked="in_array($tag->id, explode(',', $blog->tags))">
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.label :for="$tag->translation($currentLocale->code)->name" class="!text-sm !text-gray-600 dark:!text-gray-300 font-semibold cursor-pointer">
                                {{ $tag->translation($currentLocale->code)->name }}
                            </x-admin::form.control-group.label>
                        </x-admin::form.control-group>
                        @endforeach

                        <x-admin::form.control-group.error control-name="tags[]">
                        </x-admin::form.control-group.error>
                    </x-slot:content>
                </x-admin::accordion>

                {!! view_render_event('admin.blogs.edit.after', ['blogs' => $blog]) !!}

            </div>
        </div>

    </x-admin::form>

    @pushOnce('scripts')
    {{-- SEO Vue Component Template --}}
    <script type="text/x-template" id="v-seo-helper-custom-template">
        <div class="flex flex-col gap-[3px] mb-[30px]">
            <p 
                class="text-[#161B9D] dark:text-white"
                v-text="metaTitle"
            >
            </p>

            <p 
                class="text-[#161B9D] dark:text-white"
                style="display: none;"
                v-text="metaSlug"
            >
            </p>

            <p 
                class="text-[#161B9D] dark:text-white"
                style="display: none;"
                v-text="metaSlugCategory"
            >
            </p>

            <!-- SEO Meta Title -->
            <p 
                class="text-[#135F29]"
                v-text="'{{ URL::to('/') }}/blog' + ( ( metaSlugCategory != '' && metaSlugCategory != null && metaSlugCategory != undefined ) ? '/'+metaSlugCategory : '' ) + '/' + (metaSlug ? metaSlug.toLowerCase().replace(/\s+/g, '-') : '')"
            >
            </p>

            <!-- SEP Meta Description -->
            <p 
                class="text-gray-600 dark:text-gray-300"
                v-text="metaDescription"
            >
            </p>
        </div>
    </script>

    <script type="module">
        app.component('v-seo-helper-custom', {
            template: '#v-seo-helper-custom-template',

            data() {
                return {
                    metaTitle: this.$parent.getValues()['meta_title'],

                    metaDescription: this.$parent.getValues()['meta_description'],

                    metaSlug: this.$parent.getValues()['slug'],

                    metaSlugCategory: this.$parent.getValues()['default_category'],
                }
            },

            mounted() {
                let self = this;

                self.metaTitle = document.getElementById('meta_title').value;

                self.metaDescription = document.getElementById('meta_description').value;

                self.metaSlug = document.getElementById('slug').value;

                var d_cat_id = document.getElementById('default_category').value;

                var d_cat_slug = document.getElementById('default_category' + d_cat_id).getAttribute("data-slug");

                self.metaSlugCategory = (d_cat_slug != '' && d_cat_slug != null && d_cat_slug != undefined) ? d_cat_slug : '';

                document.getElementById('meta_title').addEventListener('input', function(e) {
                    self.metaTitle = e.target.value;
                });

                document.getElementById('meta_description').addEventListener('input', function(e) {
                    self.metaDescription = e.target.value;
                });

                document.getElementById('name').addEventListener('input', function(e) {
                    setTimeout(function() {
                        var slug = document.getElementById('slug').value;
                        self.metaSlug = (slug != '' && slug != null && slug != undefined) ? slug : '';
                    }, 1000);
                });

                document.getElementById('slug').addEventListener('input', function(e) {
                    var slug = e.target.value;
                    self.metaSlug = (slug != '' && slug != null && slug != undefined) ? slug : '';
                });

                document.getElementById('default_category').addEventListener('change', function(e) {
                    var cat_slug = document.getElementById('default_category' + e.target.value).getAttribute("data-slug");
                    self.metaSlugCategory = (cat_slug != '' && cat_slug != null && cat_slug != undefined) ? cat_slug : '';
                });

                document.getElementById('status_switch').addEventListener('change', function(e) {
                    document.getElementById('status').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('allow_comments_switch').addEventListener('change', function(e) {
                    document.getElementById('allow_comments').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

            },
        });
    </script>

    @endPushOnce

</x-admin::layouts>