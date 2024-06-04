@php
    $channel = core()->getCurrentChannel();
@endphp


{{-- SEO Meta Content --}}
@push ('meta')
    <meta name="title" content="{{ $category->meta_title ?? ( $blog_seo_meta_title ?? ( $channel->home_seo['meta_title'] ?? '' ) ) }}" />

    <meta name="description" content="{{ $category->meta_description ?? ( $blog_seo_meta_keywords ?? ( $channel->home_seo['meta_description'] ?? '' ) ) }}" />

    <meta name="keywords" content="{{ $category->meta_keywords ?? ( $blog_seo_meta_description ?? ( $channel->home_seo['meta_keywords'] ?? '' ) ) }}" />
@endPush

@php
$channels = core()->getAllChannels();

$currentChannel = core()->getRequestedChannel();

$currentLocale = core()->getRequestedLocale();
@endphp

<x-shop::layouts>
    {{-- Page Title --}}
    <x-slot:title>
        @lang('blog::app.shop.category.page_title')
    </x-slot>

    @push ('styles')

        @include ('blog::custom-css.custom-css')

    @endpush

    <div class="main">

        <div>
            <div class="row col-12 remove-padding-margin"><!---->
                <div id="home-right-bar-container" class="col-12 no-padding content">
                    <div class="container-right row no-margin col-12 no-padding">
                        <div id="blog" class="container mt-5">
                            <div class="full-content-wrapper">
                                <!-- <div class="col-lg-12"><h1 class="mb-3 page-title">Our Blog</h1></div> -->
                                <section class="blog-hero-wrapper">
                                    <div class="blog-hero-image">
                                        <h1 class="hero-main-title">{{ $category->translation($currentLocale->code)->name }}</h1>
                                        <img
                                        src="{{ '/storage/' . ( ( isset($category->image) && !empty($category->image) && !is_null($category->image) ) ? $category->image : 'placeholder-banner.jpg' ) }}"
                                        alt="Blog Image"
                                        class="card-img img-fluid img-thumbnail bg-fill">
                                    </div>
                                </section>
                                <div class="flex flex-wrap grid-wrap">

                                    <div class="column-12">
                                        <div class="text-justify blog-post-content">
                                            {!! $category->translation($currentLocale->code)->description !!}
                                        </div>
                                    </div>
                                    
                                    <div class="column-9">

                                        @if( !empty($blogs) &&  count($blogs) > 0 )

                                            <div class="flex flex-wrap blog-grid-list">

                                                @foreach($blogs as $blog)
                                                    <div class="blog-post-item">
                                                        <div class="blog-post-box">
                                                            <div class="card mb-5">
                                                                <div class="blog-grid-img"><img
                                                                    src="{{ '/storage/' . ( ( isset($blog->src) && !empty($blog->src) && !is_null($blog->src) ) ? $blog->src : 'placeholder-thumb.jpg' ) }}"
                                                                    alt="{{ $blog->translation($currentLocale->code)->name }}"
                                                                    class="card-img-top">
                                                                </div>
                                                                <div class="card-body">
                                                                    <h2 class="card-title"><a href="{{route('shop.article.view',[$blog->category->slug . '/' . $blog->slug])}}">{{ $blog->translation($currentLocale->code)->name }}</a></h2>
                                                                    <div class="post-meta">
                                                                        <p>
                                                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->created_at)->format('M j, Y') }} by
                                                                            @if( (int)$show_author_page == 1 )
                                                                                <a href="{{route('shop.blog.author.index',[$blog->author_id])}}">{{ $blog->author }}</a>
                                                                            @else
                                                                                <a>{{ $blog->author }}</a>
                                                                            @endif
                                                                        </p>
                                                                    </div>

                                                                    @if( !empty($blog->assign_categorys) && count($blog->assign_categorys) > 0 )
                                                                        <div class="post-categories">
                                                                            <p>
                                                                                @foreach($blog->assign_categorys as $assign_category)
                                                                                    <a href="{{route('shop.blog.category.index',[$assign_category->slug])}}" class="cat-link">{{$assign_category->translation($currentLocale->code)->name}}</a>
                                                                                @endforeach
                                                                            </p>
                                                                        </div>
                                                                    @endif

                                                                    <div class="card-text text-justify">
                                                                        {!! $blog->translation($currentLocale->code)->short_description !!}
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <a href="{{route('shop.article.view',[$blog->category->slug . '/' . $blog->slug])}}" class="text-uppercase btn-text-link">@lang('blog::app.shop.category.read_more')</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="w-full col-lg-12 mt-5 mb-5">
                                                    {!! $blogs->links() !!}
                                                </div>

                                            </div>

                                        @else

                                            <div class="post-not-available">@lang('blog::app.shop.category.no_posts')</div>

                                        @endif

                                    </div>

                                    <div class=" column-3 blog-sidebar">
                                        <div class="row">
                                            <div class="col-lg-12 mb-4 categories"><h3>@lang('blog::app.shop.category.categories')</h3>
                                                <ul class="list-group">
                                                    @foreach($categories as $category)
                                                        <li><a href="{{route('shop.blog.category.index',[$category->slug])}}" class="list-group-item list-group-item-action">
                                                                <span>{{ $category->translation($currentLocale->code)->name }}</span> 
                                                                @if( (int)$show_categories_count == 1 )
                                                                    <span class="badge badge-pill badge-primary">{{ $category->assign_blogs }}</span>
                                                                @endif
                                                        </a></li>
                                                    @endforeach
                                                </ul>

                                                <div class="tags-part">
                                                    <h3>@lang('blog::app.shop.category.tags')</h3> 
                                                    <div class="tag-list">
                                                        @foreach($tags as $tag)
                                                            <a href="{{route('shop.blog.tag.index',[$tag->slug])}}" role="button" class="btn btn-primary btn-lg">{{ $tag->translation($currentLocale->code)->name }} 
                                                                @if( (int)$show_tags_count == 1 )
                                                                    <span class="badge badge-light">{{ $tag->count }}</span>
                                                                @endif
                                                            </a> 
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-shop::layouts>
