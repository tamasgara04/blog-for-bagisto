<?php

return [

    /**
     * Blog.
     */
    [
        'key' => 'blog',
        'name' => 'blog::app.acl.blog',
        'route' => 'admin.blog.index',
        'sort' => 3,
        // 'icon' => 'icon-blog',
        'icon' => 'icon-attribute',
    ], [
        'key'        => 'blog.blogs',
        'name'       => 'blog::app.acl.blogs',
        'route'      => 'admin.blog.index',
        'sort'       => 1,
        'icon'       => '',
    ], [
        'key'        => 'blog.category',
        'name'       => 'blog::app.acl.category',
        'route'      => 'admin.blog.category.index',
        'sort'       => 2,
        'icon'       => '',
    ], [
        'key'        => 'blog.tag',
        'name'       => 'blog::app.acl.tag',
        'route'      => 'admin.blog.tag.index',
        'sort'       => 3,
        'icon'       => '',
    ], [
        'key'        => 'blog.comment',
        'name'       => 'blog::app.acl.comment',
        'route'      => 'admin.blog.comment.index',
        'sort'       => 4,
        'icon'       => '',
    ], [
        'key'        => 'blog.setting',
        'name'       => 'blog::app.acl.setting',
        'route'      => 'admin.blog.setting.index',
        'sort'       => 5,
        'icon'       => '',
    ], [
        'key'        => 'blog.import_export',
        'name'       => 'blog::app.acl.import_export',
        'route'      => 'admin.blog.import.export',
        'sort'       => 6,
        'icon'       => '',
    ],

];
