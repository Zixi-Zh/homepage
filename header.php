<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header - Exact copy from blog.html -->
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-2 sm:px-4">
        <!-- Mobile Layout -->
        <div class="md:hidden flex justify-between items-center py-3">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-lg font-bold tracking-tight bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
            
            <div class="flex items-center space-x-2">
                <a href="<?php echo esc_url(home_url('/donate')); ?>" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1.5 rounded-lg text-sm">Donate</a>
                <button id="menuBtn" class="p-2 text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-white border-t border-gray-200">
            <nav class="py-2">
                <?php
                // Custom mobile menu
                $menu_items = wp_get_nav_menu_items('primary');
                if ($menu_items) {
                    foreach ($menu_items as $item) {
                        $current_class = ($item->url == get_permalink()) ? 'bg-gray-50' : '';
                        echo '<a href="' . esc_url($item->url) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 ' . $current_class . '">' . esc_html($item->title) . '</a>';
                    }
                } else {
                    // Fallback menu if no menu is set
                    echo '<a href="' . esc_url(home_url('/')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Home</a>';
                    echo '<a href="' . esc_url(home_url('/programs')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Programs</a>';
                    echo '<a href="' . esc_url(home_url('/impact')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Impact</a>';
                    echo '<a href="' . esc_url(home_url('/volunteer')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Volunteer</a>';
                    echo '<a href="' . esc_url(home_url('/blog')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Blog</a>';
                    echo '<a href="' . esc_url(home_url('/about')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">About Us</a>';
                    echo '<a href="' . esc_url(home_url('/ethics')) . '" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">AI Ethics & Privacy</a>';
                }
                ?>
            </nav>
            <div class="px-4 py-3 border-t border-gray-100 text-center">
                <span class="text-xs font-medium text-gray-600 bg-gray-100 px-3 py-1 rounded-full"><?php echo get_chat_counter(); ?></span>
            </div>
        </div>

        <!-- Desktop Layout -->
        <div class="hidden md:flex justify-between items-center p-4">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-3xl font-bold tracking-tight text-indigo-600 hover:text-purple-600 transition-all transform hover:scale-105">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
            
            <nav class="flex space-x-2 text-base font-bold">
                <?php
                // Custom desktop menu with icons
                $menu_items = wp_get_nav_menu_items('primary');
                if ($menu_items) {
                    foreach ($menu_items as $item) {
                        $current_class = (get_permalink() == $item->url || (is_home() && $item->url == home_url('/'))) ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-indigo-100 hover:text-indigo-700';
                        echo '<a href="' . esc_url($item->url) . '" class="nav-link px-4 py-3 rounded-xl ' . $current_class . ' transition-all">' . esc_html($item->title) . '</a>';
                    }
                } else {
                    // Fallback menu with icons
                    $current_url = get_permalink();
                    $home_url = home_url('/blog');
                    
                    $menu_items = array(
                        array('url' => home_url('/'), 'title' => '🏠 Home'),
                        array('url' => home_url('/programs'), 'title' => '🤖 Programs'),
                        array('url' => home_url('/impact'), 'title' => '📊 Impact'),
                        array('url' => home_url('/volunteer'), 'title' => '🤝 Volunteer'),
                        array('url' => home_url('/blog'), 'title' => '📝 Blog'),
                        array('url' => home_url('/about'), 'title' => '👥 About'),
                        array('url' => home_url('/ethics'), 'title' => '🔒 Ethics'),
                    );
                    
                    foreach ($menu_items as $item) {
                        $current_class = ($current_url == $item['url'] || (is_home() && $item['url'] == $home_url)) ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-indigo-100 hover:text-indigo-700';
                        echo '<a href="' . esc_url($item['url']) . '" class="nav-link px-4 py-3 rounded-xl ' . $current_class . ' transition-all">' . esc_html($item['title']) . '</a>';
                    }
                }
                ?>
            </nav>
            
            <div class="flex items-center space-x-4">
                <span class="text-sm font-bold text-gray-600 bg-gray-100 px-4 py-2 rounded-full"><?php echo get_chat_counter(); ?></span>
                <a href="<?php echo esc_url(home_url('/donate')); ?>" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-110 font-bold">💝 Donate</a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close menu when clicking nav links
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }
});
</script>
