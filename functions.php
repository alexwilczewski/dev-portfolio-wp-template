<?php
// CustomTheme = ct_

function ct_styles() {
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/bootstrap-5.1.0-optimized/build.min.css', array(), '5.1.0');
}
add_action('wp_enqueue_scripts', 'ct_styles');

function ct_remove_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'ct_remove_block_library_css', 100);

function ct_setup() {
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary menu', 'custom-theme'),
        )
    );

    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'ct_setup');

// Re-enable custom fields; Advanced Custom Fields disables them
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

// Disable search feature
function ct_filter_query($query, $error = true) {
    if (is_search()) {
        $query->is_search = false;
        $query->query_vars[s] = false;
        $query->query[s] = false;
        if ($error == true) { $query->is_404 = true; }
    }
}
add_action('parse_query', 'ct_filter_query');
add_filter('get_search_form', create_function('$a', "return null;"));
function ct_remove_search_widget() {
    unregister_widget('WP_Widget_Search');
}
add_action('widgets_init', 'ct_remove_search_widget');

// Title on Homepage should not include tagline
function ct_remove_tagline_from_homepage_title($title_parts_array) {
    if (isset($title_parts_array['tagline'])) {
        unset($title_parts_array['tagline']);
    }
    return $title_parts_array;
}
add_filter('document_title_parts', 'ct_remove_tagline_from_homepage_title');
