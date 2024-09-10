<?php

/*
Plugin Name: kd2
Description: kd2
Version: 1.0
Author: kd
Author URI: www.github.com/kdan80
*/

if ( !defined('ABSPATH')) exit;

class AreYouPayingAttention {
    function __construct() {
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets() {
        wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
        register_block_type('ourplugin/are-you-paying-attention', array(
            'editor_script' => 'ournewblocktype',
            'render_callback' => array($this, 'theHTML')
        ));
    }

    function theHTML($attributes) {
        ob_start(); ?>
            <p>
                The sky above is <?php echo $attributes['skyColor']; ?> and the grass is <?php echo $attributes['grassColor']; ?>
            </p>

        <?php return ob_get_clean();
    }
}

$areYouPayingAttention = new AreYouPayingAttention;