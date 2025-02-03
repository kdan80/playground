<?php
function kdtheme_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}

add_action('after_setup_theme', 'kdtheme_theme_setup');

// Enqueue styles and scripts
function kdtheme_enqueue_scripts() {
    wp_enqueue_style('kdtheme-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'kdtheme_enqueue_scripts');
?>