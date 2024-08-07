<?php

function load_css()
{
    wp_register_style(
        'bootstrap', 
        get_template_directory_uri() . '/css/bootstrap.min.css', 
        array(),
        false,
        'all'
    );
    wp_enqueue_style('bootstrap');

    wp_register_style(
        'main', 
        get_template_directory_uri() . '/css/main.css', 
        array(),
        false,
        'all'
    );
    wp_enqueue_style('main');
}
add_action('wp_enqueue_scripts', 'load_css');

function load_js()
{
    wp_enqueue_script('jquery');
    wp_register_script(
        'bootstrap', 
        get_template_directory_uri() . '/js/bootstrap.min.js', 
        'jquery',
        false,
        true
    );
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');

// Theme Options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// Menus
register_nav_menus(

    array(
        'top-menu' => 'Top Menu Location',
        'mob-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);

// Custom Images
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small', 300, 200, true);

// Register Sidebars
function my_sidebars()
{
    register_sidebar(

        array(
           'name' => 'Page Sidebar',
           'id' => 'page-sidebar',
           'before_title' => '<h4 class="widget-title">',
           'after_title' => '</h4>'

        )
    );

    register_sidebar(

        array(
           'name' => 'Blog Sidebar',
           'id' => 'blog-sidebar',
           'before_title' => '<h4 class="widget-title">',
           'after_title' => '</h4>'

        )
    );

}
add_action('widgets_init', 'my_sidebars');

function my_first_post_type() {

    $args = array(
        'labels' => array(
            'name' => 'Cars',
            'singular_name' => 'Car'
        ),
        'hierarchical' => true,
        'public' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'cars')
    );
    register_post_type('cars', $args);
}

add_action('init', 'my_first_post_type');

function my_first_taxonomy(){

    $args = array(
        'labels' => array(
            'name' => 'Brands',
            'singular_name' => 'Brand'
        ),
        'public' => true,
        'hierarchical' => true,
    );
    register_taxonomy('brands', array('cars'), $args);
}
add_action('init', 'my_first_taxonomy');

add_action('wp_ajax_enquiry', 'enquiry_form');
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');
function enquiry_form(){

    $formData = [];
    wp_parse_str($_POST['enquiry'], $formData);

    $admin_email = get_option('admin_email');
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: My Website <' . $admin_email . '>';
    $headers[] = 'Reply-to: ' . $formData['email'];

    $send_to = $admin_email;

    $subject = "Enquiry from " . $formData['fname'] . ' ' . $formData['lname'];

    $message = '';
    foreach($formData as $index => $field){
        $message .= '<strong>' . $index . '</strong>: ' . $field . '<br />';
    }

    try {
        if(wp_mail($send_to, $subject, $message, $headers)){
            wp_send_json_success(('Email sent'));
        } else {
            wp_send_json_success(('Email failed'));
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }

    
}