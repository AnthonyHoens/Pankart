<?php

/* ****
 *  Return the attributes of an img
 * ****/

function dw_the_img_attributes($id, $sizes = []) {
    $src = wp_get_attachment_url($id);
    $thumbnail_meta =  get_post_meta($id);


    $sizes = array_map(function($size) use ($id) {
        $data = wp_get_attachment_image_src($id, $size);

        if(is_null($src)) {
            $src = $data[0];
        }

        return $data[0] . ' ' . $data[1] . 'w';
    }, $sizes);


    $srcset = implode(', ', $sizes);
    $alt = $thumbnail_meta['_wp_attachment_image_alt'][0] ?? null;


    return 'src="' . $src . '" srcset="' . $srcset . '" alt="' . $alt . '"';
}

function dw_the_thumbnail_attributes($sizes = [])
{
    // 1. Récupérer le thumbnail pour le post courant dans the loop
    $thumbnail = get_post(get_post_thumbnail_id());
    $thumbnail_meta = get_post_meta($thumbnail->ID);
    $src = null;

    // 2. Récupérer les tailles d'image qui nous intéressent & formater les tailles pour qu'elles soient utilisables dans srcset
    $sizes = array_map(function($size) use ($thumbnail, &$src) {
        $data = wp_get_attachment_image_src($thumbnail->ID, $size);

        if(is_null($src)) {
            $src = $data[0];
        }

        return $data[0] . ' ' . $data[1] . 'w';
    }, $sizes);

    // 4. Formater les attributs
    $srcset = implode(', ', $sizes);
    $alt = $thumbnail_meta['_wp_attachment_image_alt'][0] ?? null;

    // 5. Retourner les attributs générés
    return 'src="' . $src . '" srcset="' . $srcset . '" alt="' . $alt . '"';
}

/* ****
 *  Return a compiled asset's URI
 * ****/

function dw_menu($location)
{
    $locations = get_nav_menu_locations();
    $menu = $locations[$location];

    $links = wp_get_nav_menu_items($menu);

    $links = array_map(function ($post) {
        $link = new \stdClass();

        $link->classes = $post->classes[0];
        $link->url = $post->url;
        $link->label = $post->title;

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if ($actual_link == $link->url) {
            $link->active = 'nav__active';
        } elseif ($actual_link == $link->url) {
            $link->active = 'nav__active';
        }

        return $link;
    }, $links);

    return $links;
}

/* ****
 *  Return a compiled asset's URI
 * ****/

function dw_asset($path)
{
    return rtrim(get_template_directory_uri(), '/') . '/public/' . ltrim($path, '/');
}

/* ****
 *  Register custom post type
 * ****/

add_action('init', 'dw_custom_post_type');

function dw_custom_post_type()
{
    register_post_type('album', [
        'label' => 'Albums',
        'labels' => [
            'singular_name' => 'Album',
            'add_new' => 'Ajouter un album',
            'add_new_item' => 'Ajouter un nouvel album',
            'edit_item' => 'Modifier un album',
            'new_item' => 'Nouvel album',
        ],
        'description' => 'Tous les albums de Pankart.',
        'public' => true,
        'menu_position' => 5,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-book-alt',
        'rewrite' => [
            'slug' => 'albums',
        ],
    ]);

    register_post_type('event', [
        'label' => 'Évènements',
        'labels' => [
            'singular_name' => 'Évènement',
            'add_new' => 'Ajouter une date',
            'add_new_item' => 'Ajouter une nouvelle date',
            'edit_item' => 'Modifier une date',
            'new_item' => 'Nouvelle date',
        ],
        'description' => 'Tous les évènements de Pankart.',
        'public' => true,
        'menu_position' => 6,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-tickets-alt',
        'rewrite' => [
            'slug' => 'events',
        ],
    ]);

    register_post_type('news', [
        'label' => 'Actualités',
        'labels' => [
            'singular_name' => 'Actualité',
            'add_new' => 'Ajouter une news',
            'add_new_item' => 'Ajouter une nouvelle news',
            'edit_item' => 'Modifier une news',
            'new_item' => 'Nouvelle news',
        ],
        'description' => 'Tous les actualités de Easy Spacy.',
        'public' => true,
        'menu_position' => 7,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-admin-site-alt3',
        'rewrite' => [
            'slug' => 'news',
        ],
    ]);

    register_post_type('member', [
        'label' => 'Membres',
        'labels' => [
            'singular_name' => 'Membre',
            'add_new' => 'Ajouter un membre',
            'add_new_item' => 'Ajouter un nouveau membre',
            'edit_item' => 'Modifier un membre',
            'new_item' => 'Nouveau membre',
        ],
        'description' => 'Tous les membres de Pankart.',
        'public' => true,
        'menu_position' => 7,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-groups',
        'rewrite' => [
            'slug' => 'members',
        ],
    ]);

    register_post_type('feeling', [
        'label' => 'Coups de coeurs / gueules',
        'labels' => [
            'singular_name' => 'Coup de coeur / gueule',
            'add_new' => 'Ajouter un sentiment',
            'add_new_item' => 'Ajouter un nouveau sentiment',
            'edit_item' => 'Modifier un sentiment',
            'new_item' => 'Nouveau sentiment',
        ],
        'description' => 'Tous les coups de gueules / coeurs de Pankart.',
        'public' => true,
        'menu_position' => 8,
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-megaphone',
        'rewrite' => [
            'slug' => 'feelings',
        ],
    ]);

    register_post_type('hit', [
        'label' => 'Musiques',
        'labels' => [
            'singular_name' => 'Musique',
            'add_new' => 'Ajouter une musique',
            'add_new_item' => 'Ajouter un nouvelle musique',
            'edit_item' => 'Modifier une musique',
            'new_item' => 'Nouvelle musique',
        ],
        'description' => 'Tous les musiques de Pankart.',
        'public' => true,
        'menu_position' => 9,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-media-audio',
        'rewrite' => [
            'slug' => 'hits',
        ],
    ]);
}


/* ****
 *  Register navigations menus
 * ****/
add_action('init', 'dw_custom_navigation_menus');

function dw_custom_navigation_menus()
{
    register_nav_menus([
        'main' => 'Navigation principale',
        'social' => 'Réseaux sociaux',
        'streaming' => 'Streaming',
    ]);
}

/* *****
 * Add theme supports
 * *****/

add_action('after_setup_theme', 'dw_add_theme_supports');

function dw_add_theme_supports()
{
    add_theme_support('post-thumbnails', ['member', 'hit', 'feeling', 'album', 'news', 'event']);
}


/* ****
 *  Disable Gutenberg Editor
 * ****/

add_filter("use_block_editor_for_post_type", "disable_gutenberg_editor");

function disable_gutenberg_editor()
{
    return false;
}

