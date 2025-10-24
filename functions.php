<?php
/**
 * Companion Connect Blog Theme Functions
 * Based on CCWebsite2/blog.html design
 */

// Theme setup
function tailwind2_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tailwind2-theme'),
        'footer' => __('Footer Menu', 'tailwind2-theme'),
    ));
    
    // Add support for featured images
    set_post_thumbnail_size(400, 300, true);
}
add_action('after_setup_theme', 'tailwind2_theme_setup');

// Enqueue styles and scripts
function tailwind2_theme_scripts() {
    // Enqueue Tailwind CSS
    wp_enqueue_style('tailwind-css', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    
    // Enqueue theme stylesheet
    wp_enqueue_style('tailwind2-theme-style', get_stylesheet_uri(), array('tailwind-css'));
    
    // Enqueue custom JavaScript
    wp_enqueue_script('tailwind2-theme-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'tailwind2_theme_scripts');

// Register widget areas
function tailwind2_theme_widgets() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'tailwind2-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'tailwind2-theme'),
        'before_widget' => '<div id="%1$s" class="widget bg-white p-6 rounded-xl card-shadow mb-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-xl font-bold mb-4 text-indigo-700">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'tailwind2-theme'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'tailwind2-theme'),
        'before_widget' => '<div id="%1$s" class="footer-widget mb-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-bold mb-3 text-gray-800">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'tailwind2_theme_widgets');

// Custom post excerpt length
function tailwind2_theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'tailwind2_theme_excerpt_length');

// Custom excerpt more link
function tailwind2_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'tailwind2_theme_excerpt_more');

// Add custom body classes
function tailwind2_theme_body_classes($classes) {
    $classes[] = 'bg-gray-50 text-gray-800';
    return $classes;
}
add_filter('body_class', 'tailwind2_theme_body_classes');

// Custom function to get blog category color class
function get_category_color_class($category_name) {
    $color_map = array(
        'impact' => 'category-impact',
        'tech' => 'category-tech',
        'community' => 'category-community',
        'research' => 'category-research',
        'crisis' => 'category-crisis',
        'partnership' => 'category-partnership',
    );
    
    $category_slug = strtolower($category_name);
    return isset($color_map[$category_slug]) ? $color_map[$category_slug] : 'bg-gray-600';
}

// Add reading time calculation
function get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    return $reading_time . ' min read';
}

// Custom pagination
function tailwind2_pagination() {
    global $wp_query;
    
    $total_pages = $wp_query->max_num_pages;
    
    if ($total_pages > 1) {
        $current_page = max(1, get_query_var('paged'));
        
        echo '<div class="pagination">';
        
        // Previous button
        if ($current_page > 1) {
            echo '<a href="' . get_pagenum_link($current_page - 1) . '" class="prev-page">← Previous</a>';
        }
        
        // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo '<span class="current">' . $i . '</span>';
            } else {
                echo '<a href="' . get_pagenum_link($i) . '">' . $i . '</a>';
            }
        }
        
        // Next button
        if ($current_page < $total_pages) {
            echo '<a href="' . get_pagenum_link($current_page + 1) . '" class="next-page">Next →</a>';
        }
        
        echo '</div>';
    }
}

// Add support for post formats
add_theme_support('post-formats', array(
    'aside',
    'gallery',
    'quote',
    'image',
    'video'
));

// Customize comment form
function tailwind2_comment_form($args) {
    $args['class_form'] = 'bg-white p-6 rounded-xl card-shadow';
    $args['class_submit'] = 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all transform hover:scale-105 font-medium';
    $args['title_reply'] = '<h3 class="text-2xl font-bold mb-6 text-gray-800">Leave a Comment</h3>';
    
    return $args;
}
add_filter('comment_form_defaults', 'tailwind2_comment_form');

// Add chat counter (static for now, can be made dynamic)
function get_chat_counter() {
    return '56,855 chats served'; // This could be made dynamic with a database query
}
?>
