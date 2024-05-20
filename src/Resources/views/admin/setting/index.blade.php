<x-admin::layouts>
    <x-slot:title>
        @lang('blog::app.settings.title')
    </x-slot:title>

    @pushOnce('styles')

    <style type="text/css">
        .w-50 {
            width: calc(50% - 4px);
        }

        @media (max-width: 767px) {
            .w-50 {
                width: 100%;
            }

            .flex-col-box {
                flex-direction: column;
            }
        }
    </style>

    @endPushOnce

    <!-- Blog Setting Form -->
    <x-admin::form :action="route('admin.blog.setting.store')" method="POST" enctype="multipart/form-data">

        {!! view_render_event('admin.blogs.setting.before') !!}

        <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
            <p class="text-xl text-gray-800 dark:text-white font-bold">
                @lang('blog::app.settings.title')
            </p>

            <div class="flex gap-x-2.5 items-center">

                <!-- Save Button -->
                <button type="submit" class="primary-button">@lang('blog::app.settings.save')</button>
            </div>

        </div>

        <!-- Full Pannel -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">

            <div class="flex flex-wrap flex-col-box gap-2 flex-1 max-xl:flex-auto">

                <!-- Post Setting Section -->
                <div class="p-4 w-50 bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('blog::app.settings.post_setting')
                    </p>

                    <div class="mt-8">

                        <!-- Post Per Page Records -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="">
                                @lang('blog::app.settings.per_page_records')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="number" name="blog_post_per_page" id="blog_post_per_page" {{-- rules="required" --}} :value="old('blog_post_per_page') ?? $settings['blog_post_per_page']" label="Per Page Records" placeholder="Blog post per page" min="1">
                            </x-admin::form.control-group.control>

                            {{-- <x-admin::form.control-group.error control-name="blog_post_per_page"></x-admin::form.control-group.error> --}}

                        </x-admin::form.control-group>

                        <!-- Post Maximum Related Posts Allowed -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="">
                                @lang('blog::app.settings.maximum_related_posts_allowed')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="number" name="blog_post_maximum_related" id="blog_post_maximum_related" {{-- rules="required" --}} :value="old('blog_post_maximum_related') ?? $settings['blog_post_maximum_related']" label="Maximum Related Posts Allowed" placeholder="Max related posts allowed" min="1">
                            </x-admin::form.control-group.control>

                            {{-- <x-admin::form.control-group.error control-name="blog_post_maximum_related"></x-admin::form.control-group.error> --}}

                        </x-admin::form.control-group>

                        <!-- Recent Posts Order By -->
                        {{-- <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="">
                                {{ __('Recent Posts Order By') }}
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control type="select" name="blog_post_recent_order_by" id="blog_post_recent_order_by" :value="old('blog_post_recent_order_by') ?? $settings['blog_post_recent_order_by']" label="Recent Posts Order By" placeholder="Recent Posts Order By" min="1">
                            @foreach($post_orders as $post_order_key => $post_order_val)
                            <option value="{{$post_order_key}}">{{$post_order_val}}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="blog_post_recent_order_by"></x-admin::form.control-group.error>

                        </x-admin::form.control-group> --}}

                        <!-- Show Categories With Posts Count -->
                        <input type="hidden" name="blog_post_show_categories_with_count" id="blog_post_show_categories_with_count" value="@php echo $settings['blog_post_show_categories_with_count'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.settings.show_categories_with_posts_count')
                            </x-admin::form.control-group.label>

                            @php $blog_post_show_categories_with_count = old('blog_post_show_categories_with_count') ?: $settings['blog_post_show_categories_with_count'] @endphp

                            <x-admin::form.control-group.control type="switch" name="switch_blog_post_show_categories_with_count" id="switch_blog_post_show_categories_with_count" class="cursor-pointer" value="1" label="Show Categories With Posts Count" :checked="(boolean) $blog_post_show_categories_with_count">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Show Tags With Posts Count -->
                        <input type="hidden" name="blog_post_show_tags_with_count" id="blog_post_show_tags_with_count" value="@php echo $settings['blog_post_show_tags_with_count'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.settings.show_tags_with_posts_count')
                            </x-admin::form.control-group.label>

                            @php $blog_post_show_tags_with_count = old('blog_post_show_tags_with_count') ?: $settings['blog_post_show_tags_with_count'] @endphp

                            <x-admin::form.control-group.control type="switch" name="switch_blog_post_show_tags_with_count" id="switch_blog_post_show_tags_with_count" class="cursor-pointer" value="1" label="Show Tags With Posts Count" :checked="(boolean) $blog_post_show_tags_with_count">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Show Author Page -->
                        <input type="hidden" name="blog_post_show_author_page" id="blog_post_show_author_page" value="@php echo $settings['blog_post_show_author_page'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.settings.show_author_page')
                            </x-admin::form.control-group.label>

                            @php $blog_post_show_author_page = old('blog_post_show_author_page') ?: $settings['blog_post_show_author_page'] @endphp

                            <x-admin::form.control-group.control type="switch" name="switch_blog_post_show_author_page" id="switch_blog_post_show_author_page" class="cursor-pointer" value="1" label="Show Author Page" :checked="(boolean) $blog_post_show_author_page">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                    </div>

                </div>

                <!-- Comment Setting Section -->
                <div class="p-4 w-50 bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('blog::app.settings.comment_setting')
                    </p>

                    <div class="mt-8">

                        <!-- Enable Post Comment -->
                        <input type="hidden" name="blog_post_enable_comment" id="blog_post_enable_comment" value="@php echo $settings['blog_post_enable_comment'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.settings.enable_post_comment')
                            </x-admin::form.control-group.label>

                            @php $blog_post_enable_comment = old('blog_post_enable_comment') ?: $settings['blog_post_enable_comment'] @endphp

                            <x-admin::form.control-group.control type="switch" id="switch_blog_post_enable_comment" name="switch_blog_post_enable_comment" class="cursor-pointer" value="1" label="Enable Post Comment" :checked="(boolean) $blog_post_enable_comment">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Allow Guest Comment -->
                        <input type="hidden" name="blog_post_allow_guest_comment" id="blog_post_allow_guest_comment" value="@php echo $settings['blog_post_allow_guest_comment'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('blog::app.settings.allow_guest_comment')
                            </x-admin::form.control-group.label>

                            @php $blog_post_allow_guest_comment = old('blog_post_allow_guest_comment') ?: $settings['blog_post_allow_guest_comment'] @endphp

                            <x-admin::form.control-group.control type="switch" id="switch_blog_post_allow_guest_comment" name="switch_blog_post_allow_guest_comment" class="cursor-pointer" value="1" label="Allow Guest Comment" :checked="(boolean) $blog_post_allow_guest_comment">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        <!-- Enable Comment Moderation -->
                        {{-- <input type="hidden" name="blog_post_enable_comment_moderation" id="blog_post_enable_comment_moderation" value="@php echo $settings['blog_post_enable_comment_moderation'] @endphp">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                            @lang('blog::app.settings.blog_post_enable_comment_moderation')
                        </x-admin::form.control-group.label>

                        @php $blog_post_enable_comment_moderation = old('blog_post_enable_comment_moderation') ?: $settings['blog_post_enable_comment_moderation'] @endphp

                        <x-admin::form.control-group.control type="switch" id="switch_blog_post_enable_comment_moderation" name="switch_blog_post_enable_comment_moderation" class="cursor-pointer" value="1" label="Enable Comment Moderation" :checked="(boolean) $blog_post_enable_comment_moderation">
                        </x-admin::form.control-group.control>
                        </x-admin::form.control-group> --}}

                        <!-- Allowed maximum nested comment level -->
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label class="">
                                @lang('blog::app.settings.maximum_nested_comment_level')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="number" name="blog_post_maximum_nested_comment" id="blog_post_maximum_nested_comment" {{-- rules="required" --}} :value="old('blog_post_maximum_nested_comment') ?? $settings['blog_post_maximum_nested_comment']" label="Allowed maximum nested comment level" placeholder="Max nested comments" min="2" max="4">
                            </x-admin::form.control-group.control>

                            {{-- <x-admin::form.control-group.error control-name="blog_post_maximum_nested_comment"></x-admin::form.control-group.error> --}}

                        </x-admin::form.control-group>

                    </div>

                </div>

                <!-- Default Blog SEO Setting Section -->
                <div class="p-4 w-50 bg-white dark:bg-gray-900 rounded-[4px] box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('blog::app.settings.default_blog_seo_setting')
                    </p>

                    <div class="mt-8">

                        @lang('blog::app.settings.meta_title')
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label>
                                @lang('blog::app.settings.meta_title')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="text" name="blog_seo_meta_title" id="blog_seo_meta_title" :value="old('blog_seo_meta_title') ?? $settings['blog_seo_meta_title']" label="Meta Title" placeholder="SEO Meta title">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        @lang('blog::app.settings.meta_keywords')
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label>
                                @lang('blog::app.settings.meta_keywords')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="text" name="blog_seo_meta_keywords" id="blog_seo_meta_keywords" :value="old('blog_seo_meta_keywords') ?? $settings['blog_seo_meta_keywords']" label="Meta Keywords" placeholder="Meta keywords">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                        @lang('blog::app.settings.meta_description')
                        <x-admin::form.control-group class="mb-2.5">
                            <x-admin::form.control-group.label>
                            @lang('blog::app.settings.meta_description')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control type="textarea" name="blog_seo_meta_description" id="blog_seo_meta_description" :value="old('blog_seo_meta_description') ?? $settings['blog_seo_meta_description']" label="Meta Description" placeholder="Meta Description">
                            </x-admin::form.control-group.control>
                        </x-admin::form.control-group>

                    </div>

                </div>

                <v-wc-custom-js></v-wc-custom-js>

            </div>

        </div>

        {!! view_render_event('admin.blogs.setting.after') !!}

    </x-admin::form>

    @pushOnce('scripts')
    {{-- SEO Vue Component Template --}}
    <script type="text/x-template" id="v-wc-custom-js-template">

    </script>

    <script type="module">
        app.component('v-wc-custom-js', {
            template: '#v-wc-custom-js-template',

            data() {
                return {

                }
            },

            mounted() {
                let self = this;

                document.getElementById('switch_blog_post_show_categories_with_count').addEventListener('change', function(e) {
                    document.getElementById('blog_post_show_categories_with_count').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('switch_blog_post_show_tags_with_count').addEventListener('change', function(e) {
                    document.getElementById('blog_post_show_tags_with_count').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('switch_blog_post_show_author_page').addEventListener('change', function(e) {
                    document.getElementById('blog_post_show_author_page').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('switch_blog_post_enable_comment').addEventListener('change', function(e) {
                    document.getElementById('blog_post_enable_comment').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('switch_blog_post_allow_guest_comment').addEventListener('change', function(e) {
                    document.getElementById('blog_post_allow_guest_comment').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

                document.getElementById('switch_blog_post_enable_comment_moderation').addEventListener('change', function(e) {
                    document.getElementById('blog_post_enable_comment_moderation').value = (e.target.checked == true || e.target.checked == 'true') ? 1 : 0;
                });

            },
        });
    </script>
    @endPushOnce

</x-admin::layouts>