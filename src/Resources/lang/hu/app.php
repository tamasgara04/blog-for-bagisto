<?php

return [
    'shop' => [
        'seo' => [
            'meta' => [
                'title' => 'SEO Meta Cím',
                'description' => 'SEO Meta Leírás',
                'keywords' => 'SEO Meta Kulcsszavak',
            ],
        ],
        'author' => [
            'author_page' => 'Blog Szerzői Oldal',
            'read_more' => 'Olvass tovább >',
            'posts_by_author' => 'Bejegyzések :author által',
            'no_posts' => 'Még nincs közzétett bejegyzés!!',
            'categories' => 'Kategóriák',
            'tags' => 'Címkék',
        ],
        'category' => [
            'page_title' => 'Blog Kategória Oldal',
            'read_more' => 'Olvass tovább >',
            'posts_by_author' => 'Bejegyzések :author által',
            'no_posts' => 'Még nincs közzétett bejegyzés!!',
            'categories' => 'Kategóriák',
            'tags' => 'Címkék',
        ],
        'comment' => [
            'reply' => 'Válasz',
            'cancel_reply' => 'Válasz törlése',
            'leave_comment' => 'Szólj hozzá',
            'your_name' => 'Neved',
            'your_email' => 'Email címed',
            'your_comment' => 'Hozzászólásod',
            'comment' => 'Hozzászólás',
        ],
        'index' => [
            'article' => 'Cikk',
        ],    
        'tag' => [
            'page_title' => 'Blog Címke Oldal',
            'read_more' => 'Olvass tovább >',
            'no_posts' => 'Még nincs közzétett bejegyzés!!',
            'categories' => 'Kategóriák',
            'tags' => 'Címkék',
        ],
        'velocity' => [
            'page_title' => 'Blogoldal',
            'our_blog' => 'Blogunk',
            'read_more' => 'Olvass tovább',
            'no_posts' => 'Még nincs bejegyzés közzétéve!',
            'categories' => 'Kategóriák',
            'tags' => 'Címkék',
            'single_blog' => 'Egyedi blogoldal',
            'related_blog' => 'Kapcsolódó blog',
            'leave_comment' => 'Szólj hozzá',
            'comment' => 'Hozzászólás',
            'comment-login' => 'A hozzászóláshoz be kell jelentkezned. Kattints <a href=":login_url" target="_blank">ide</a> a bejelentkezéshez.',
            'comments_off' => 'A hozzászólások ki vannak kapcsolva.',
        ],                 
    ],

    'acl' => [
        'dashboard' => 'Irányítópult',
        'blog' => 'Blog',
        'blogs' => 'Blogok',
        'blogs-create' => 'Hozzáadás',
        'blogs-edit' => 'Szerkesztés',
        'blogs-delete' => 'Törlés',
        'category' => 'Kategória',
        'category-create' => 'Létrehozás',
        'category-edit' => 'Szerkesztés',
        'category-delete' => 'Törlés',
        'tag' => 'Címke',
        'tag-create' => 'Létrehozás',
        'tag-edit' => 'Szerkesztés',
        'tag-delete' => 'Törlés',
        'comment' => 'Megjegyzés',
        'comment-edit' => 'Szerkesztés',
        'comment-delete' => 'Törlés',
        'setting' => 'Beállítás',
        'import_export' => 'Import/Export',
    ],    
    'blog' => [
        'select_author'                 => 'Válasszon egy irot',
        'additional_category'           => 'További kategória',
        'select_category'               => 'Válasszon egy kategóriát',
        'index-title'                   => 'Blogok',
        'title'                         => 'Bejegyzések',
        'add-title'                     => 'Blog hozzáadása',
        'edit-title'                    => 'Blog szerkesztése',
        'create-btn-title'              => 'Blog mentése',
        'edit-btn-title'                => 'Blog mentése',
        'general'                       => 'Általános',
        'name'                          => 'Név',
        'slug'                          => 'URL-azonosító',
        'channels'                      => 'Csatornák',
        'author'                        => 'Szerző',
        'select_an_author'              => 'Válasszon szerzőt',
        'published_at'                  => 'Közzététel ideje',
        'status'                        => 'Állapot',
        'status-true'                   => 'Aktív',
        'status-false'                  => 'Inaktív',
        'allow_comments'                => 'Hozzászólások engedélyezése',
        'yes'                           => 'Igen',
        'no'                            => 'Nem',
        'categories_tag'                => 'Kategóriák és Címkék',
        'categories_title'              => 'Kategóriák',
        'tag_title'                     => 'Címkék',
        'default_category'              => 'Alapértelmezett kategória',
        'tags'                          => 'Címkék',
        'description-and-images'        => 'Leírás és Képek',
        'short_description'             => 'Rövid leírás',
        'description'                   => 'Leírás',
        'image'                         => 'Kép',
        'add-image'                     => 'Kép hozzáadása',
        'search_engine_optimization'    => 'SEO optimalizáció',
        'meta_title'                    => 'Meta Cím',
        'meta_description'              => 'Meta Leírás',
        'meta_keywords'                 => 'Meta Kulcsszavak',
        'created-fault'                 => 'Hiba történt a blog létrehozása közben.',
        'updated-fault'                 => 'Hiba történt a blog frissítése közben.',
        'delete-success'                => 'Blog sikeresen törölve',
        'delete-failure'                => 'Blog nem törölhető',
    ],

    'category' => [
        'parent-category'               => 'Szülőkategória',
        'title'                         => 'Kategóriák',
        'add-title'                     => 'Blog kategória hozzáadása',
        'edit-title'                    => 'Blog kategória szerkesztése',
        'create-btn-title'              => 'Kategória mentése',
        'edit-btn-title'                => 'Kategória mentése',
        'general'                       => 'Általános',
        'name'                          => 'Név',
        'slug'                          => 'URL-azonosító',
        'status'                        => 'Állapot',
        'status-true'                   => 'Aktív',
        'status-false'                  => 'Inaktív',
        'description'                   => 'Leírás',
        'image'                         => 'Kép',
        'add-image'                     => 'Kép hozzáadása',
        'search_engine_optimization'    => 'SEO optimalizáció',
        'meta_title'                    => 'Meta Cím',
        'meta_description'              => 'Meta Leírás',
        'meta_keywords'                 => 'Meta Kulcsszavak',
        'created-fault'                 => 'Hiba történt a kategória létrehozása közben.',
        'updated-fault'                 => 'Hiba történt a kategória frissítése közben.',
        'delete-success'                => 'Kategória sikeresen törölve',
        'delete-failure'                => 'Kategória nem törölhető',
    ],

    'tag' => [
        'title'                         => 'Címkék',
        'add-title'                     => 'Blog címke hozzáadása',
        'edit-title'                    => 'Blog címke szerkesztése',
        'create-btn-title'              => 'Címke mentése',
        'edit-btn-title'                => 'Címke mentése',
        'general'                       => 'Általános',
        'name'                          => 'Név',
        'slug'                          => 'URL-azonosító',
        'status'                        => 'Állapot',
        'status-true'                   => 'Aktív',
        'status-false'                  => 'Inaktív',
        'description'                   => 'Leírás',
        'image'                         => 'Kép',
        'add-image'                     => 'Kép hozzáadása',
        'search_engine_optimization'    => 'SEO optimalizáció',
        'meta_title'                    => 'Meta Cím',
        'meta_description'              => 'Meta Leírás',
        'meta_keywords'                 => 'Meta Kulcsszavak',
        'created-fault'                 => 'Hiba történt a címke létrehozása közben.',
        'updated-fault'                 => 'Hiba történt a címke frissítése közben.',
        'delete-success'                => 'Címke sikeresen törölve',
        'delete-failure'                => 'Címke nem törölhető',
    ],

    'comment' => [
        'title'                         => 'Hozzászólások',
        'edit-title'                    => 'Hozzászólás szerkesztése',
        'edit-btn-title'                => 'Hozzászólás mentése',
        'general'                       => 'Általános',
        'post'                          => 'Bejegyzés',
        'name'                          => 'Név',
        'email'                         => 'Email',
        'comment_date'                  => 'Hozzászólás dátuma',
        'status'                        => 'Állapot',
        'status-pending'                => 'Függőben',
        'status-approved'               => 'Elfogadva',
        'status-rejected'               => 'Elutasítva',
        'comment'                       => 'Hozzászólás',
        'delete-success'                => 'Hozzászólás sikeresen törölve',
        'delete-failure'                => 'Hozzászólás nem törölhető',
    ],

    'datagrid' => [
        'id'                            => 'Azonosító',
        'name'                          => 'Név',
        'content'                       => 'Tartalom',
        'author'                        => 'Szerző',
        'category'                      => 'Kategóriák',
        'status'                        => 'Állapot',
        'allow_comments'                => 'Hozzászólások engedélyezése',
        'published_at'                  => 'Közzététel ideje',
        'actions'                       => 'Műveletek',
        'pending'                       => 'Függőben',
        'approved'                      => 'Elfogadva',
        'rejected'                      => 'Elutasítva',
        'edit'                          => 'Szerkesztés',
        'delete'                        => 'Törlés',
        'view'                          => 'Megtekintés',
    ],

    'import-export' => [
        'title' => 'Blog import/export',
        'import' => 'Importálás',
        'export' => 'Exportálás',
        'import_file' => 'Importálási fájl',
        'sample_csv_file' => 'Csak csv fájlt tölthet fel, és itt töltheti le a minta csv fájlt.',
        'import_errors' => 'Importálási hibák',
        'click_here' => 'Kattintson ide',
    ],
    
    'settings' => [
        'title' => 'Blog beállítások',
        'save' => 'Beállítások mentése',
        'post_setting' => 'Bejegyzés beállításai',
        'per_page_records' => 'Oldalankénti bejegyzések száma',
        'maximum_related_posts_allowed' => 'Engedélyezett maximális kapcsolódó bejegyzések',
        'show_categories_with_posts_count' => 'Kategóriák megjelenítése bejegyzések számlálóval',
        'show_tags_with_posts_count' => 'Címkék megjelenítése bejegyzések számlálóval',
        'show_author_page' => 'Szerző oldal megjelenítése',
        'comment_setting' => 'Hozzászólás beállításai',
        'enable_post_comment' => 'Hozzászólás engedélyezése',
        'allow_guest_comment' => 'Vendég hozzászólás engedélyezése',
        'maximum_nested_comment_level' => 'Engedélyezett maximális beágyazott hozzászólás szint',
        'default_blog_seo_setting' => 'Alapértelmezett blog SEO beállítás',
        'meta_title' => 'Meta cím',
        'meta_keywords' => 'Meta kulcsszavak',
        'meta_description' => 'Meta leírás',
        'click_here' => 'Kattintson ide',
    ],
];
