<?php

return [
    [
        'key' => 'blog',
        'name' => 'admin::app.acl.blog',
        'route' => 'admin.blog.index',
        'sort' => 3
    ], [
        'key'   => 'blog.blogs',
        'name'  => 'admin::app.acl.blogs',
        'route' => 'admin.blog.index',
        'sort'  => 1,
    ], [
        'key'   => 'blog.blogs.create',
        'name'  => 'admin::app.acl.blogs-create',
        'route' => 'admin.blog.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.blogs.edit',
        'name'  => 'admin::app.acl.blogs-edit',
        'route' => 'admin.blog.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.blogs.delete',
        'name'  => 'admin::app.acl.blogs-delete',
        'route' => 'admin.blog.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.category',
        'name'  => 'admin::app.acl.category',
        'route' => 'admin.blog.category.index',
        'sort'  => 2,
    ], [
        'key'   => 'blog.category.create',
        'name'  => 'admin::app.acl.category-create',
        'route' => 'admin.blog.category.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.category.edit',
        'name'  => 'admin::app.acl.category-edit',
        'route' => 'admin.blog.category.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.category.delete',
        'name'  => 'admin::app.acl.category-delete',
        'route' => 'admin.blog.category.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.tag',
        'name'  => 'admin::app.acl.tag',
        'route' => 'admin.blog.tag.index',
        'sort'  => 3,
    ], [
        'key'   => 'blog.tag.create',
        'name'  => 'admin::app.acl.tag-create',
        'route' => 'admin.blog.tag.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.tag.edit',
        'name'  => 'admin::app.acl.tag-edit',
        'route' => 'admin.blog.tag.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.tag.delete',
        'name'  => 'admin::app.acl.tag-delete',
        'route' => 'admin.blog.tag.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.comment',
        'name'  => 'admin::app.acl.comment',
        'route' => 'admin.blog.comment.index',
        'sort'  => 4,
    ], [
        'key'   => 'blog.comment.edit',
        'name'  => 'admin::app.acl.comment-edit',
        'route' => 'admin.blog.comment.edit',
        'sort'  => 1,
    ], [
        'key'   => 'blog.comment.delete',
        'name'  => 'admin::app.acl.comment-delete',
        'route' => 'admin.blog.comment.delete',
        'sort'  => 2,
    ], [
        'key'   => 'blog.setting',
        'name'  => 'admin::app.acl.setting',
        'route' => 'admin.blog.setting.index',
        'sort'  => 5,
    ], [
        'key'   => 'blog.import_export',
        'name'  => 'admin::app.acl.import_export',
        'route' => 'admin.blog.import.export',
        'sort'  => 6,
    ]
];