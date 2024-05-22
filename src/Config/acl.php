<?php

return [
    [
        'key' => 'blog',
        'name' => 'blog::app.acl.blog',
        'route' => 'admin.blog.index',
        'sort' => 3
    ], [
        'key'   => 'blog.blogs',
        'name'  => 'blog::app.acl.blogs',
        'route' => 'admin.blog.index',
        'sort'  => 1,
    ], [
        'key'   => 'blog.blogs.create',
        'name'  => 'blog::app.acl.blogs-create',
        'route' => 'admin.blog.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.blogs.edit',
        'name'  => 'blog::app.acl.blogs-edit',
        'route' => 'admin.blog.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.blogs.delete',
        'name'  => 'blog::app.acl.blogs-delete',
        'route' => 'admin.blog.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.category',
        'name'  => 'blog::app.acl.category',
        'route' => 'admin.blog.category.index',
        'sort'  => 2,
    ], [
        'key'   => 'blog.category.create',
        'name'  => 'blog::app.acl.category-create',
        'route' => 'admin.blog.category.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.category.edit',
        'name'  => 'blog::app.acl.category-edit',
        'route' => 'admin.blog.category.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.category.delete',
        'name'  => 'blog::app.acl.category-delete',
        'route' => 'admin.blog.category.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.tag',
        'name'  => 'blog::app.acl.tag',
        'route' => 'admin.blog.tag.index',
        'sort'  => 3,
    ], [
        'key'   => 'blog.tag.create',
        'name'  => 'blog::app.acl.tag-create',
        'route' => 'admin.blog.tag.create',
        'sort'  => 1,
    ], [
        'key'   => 'blog.tag.edit',
        'name'  => 'blog::app.acl.tag-edit',
        'route' => 'admin.blog.tag.edit',
        'sort'  => 2,
    ], [
        'key'   => 'blog.tag.delete',
        'name'  => 'blog::app.acl.tag-delete',
        'route' => 'admin.blog.tag.delete',
        'sort'  => 3,
    ], [
        'key'   => 'blog.comment',
        'name'  => 'blog::app.acl.comment',
        'route' => 'admin.blog.comment.index',
        'sort'  => 4,
    ], [
        'key'   => 'blog.comment.edit',
        'name'  => 'blog::app.acl.comment-edit',
        'route' => 'admin.blog.comment.edit',
        'sort'  => 1,
    ], [
        'key'   => 'blog.comment.delete',
        'name'  => 'blog::app.acl.comment-delete',
        'route' => 'admin.blog.comment.delete',
        'sort'  => 2,
    ], [
        'key'   => 'blog.setting',
        'name'  => 'blog::app.acl.setting',
        'route' => 'admin.blog.setting.index',
        'sort'  => 5,
    ], [
        'key'   => 'blog.import_export',
        'name'  => 'blog::app.acl.import_export',
        'route' => 'admin.blog.import.export',
        'sort'  => 6,
    ]
];