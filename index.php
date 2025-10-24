<?php get_header(); ?>

<main>
    <!-- Hero Section - matching blog.html -->
    <section class="gradient-bg text-white py-20 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                <?php if (is_home()) : ?>
                    Blog & Updates
                <?php else : ?>
                    <?php echo get_bloginfo('name'); ?>
                <?php endif; ?>
            </h1>
            <p class="max-w-3xl mx-auto text-xl md:text-2xl opacity-90 leading-relaxed">
                <?php if (is_home()) : ?>
                    Stories, dev logs, and community highlights from our journey to connect teens worldwide.
                <?php else : ?>
                    <?php echo get_bloginfo('description'); ?>
                <?php endif; ?>
            </p>
            <div class="mt-8">
                <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                    <span class="text-sm font-medium">📝 Fresh insights and updates weekly</span>
                </div>
            </div>
        </div>
    </section>

    <div class="section-divider"></div>

    <!-- Blog Posts List -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('block bg-white rounded-xl shadow hover:shadow-lg transition-all p-6 hover-lift'); ?>>
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="flex items-center space-x-4">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="flex-shrink-0">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'w-16 h-16 object-cover rounded-lg')); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="flex-shrink-0">
                                        <?php
                                        // Get the first category and assign a book emoji based on it
                                        $categories = get_the_category();
                                        $category_name = !empty($categories) ? strtolower($categories[0]->name) : 'default';
                                        
                                        $book_emojis = array(
                                            'impact' => '📗',
                                            'tech' => '📘',
                                            'community' => '📙',
                                            'research' => '📕',
                                            'crisis' => '📒',
                                            'partnership' => '📔',
                                            'default' => '📖'
                                        );
                                        
                                        $emoji = isset($book_emojis[$category_name]) ? $book_emojis[$category_name] : $book_emojis['default'];
                                        ?>
                                        <span class="text-3xl text-indigo-500"><?php echo $emoji; ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex-1 min-w-0">
                                    <h2 class="font-bold text-lg text-indigo-700 mb-1 line-clamp-2">
                                        <?php the_title(); ?>
                                    </h2>
                                    <div class="text-gray-500 text-sm mb-2">
                                        <span>By <?php the_author(); ?></span>
                                        <?php if (get_the_date()) : ?>
                                            <span class="mx-1">•</span>
                                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                        <?php endif; ?>
                                        <span class="mx-1">•</span>
                                        <span><?php echo get_reading_time(); ?></span>
                                    </div>
                                    
                                    <?php if (has_excerpt()) : ?>
                                        <p class="text-gray-600 text-sm line-clamp-2">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <!-- Categories -->
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                    ?>
                                        <div class="mt-2">
                                            <?php foreach ($categories as $category) : ?>
                                                <span class="blog-category <?php echo get_category_color_class($category->name); ?> mr-2">
                                                    <?php echo esc_html($category->name); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Load More / Pagination -->
            <div class="text-center mt-12">
                <?php
                global $wp_query;
                if ($wp_query->max_num_pages > 1) :
                ?>
                    <div class="mb-8">
                        <button class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl hover:shadow-lg transition-all transform hover:scale-105 font-bold" onclick="loadMorePosts()">
                            📚 Load More Posts
                        </button>
                    </div>
                    
                    <!-- Traditional pagination as fallback -->
                    <?php tailwind2_pagination(); ?>
                <?php endif; ?>
            </div>
            
        <?php else : ?>
            <!-- No posts found -->
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow p-8 max-w-md mx-auto">
                    <div class="text-6xl mb-4">📝</div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">No Posts Yet</h2>
                    <p class="text-gray-600 mb-6">We're working on some great content. Check back soon!</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all transform hover:scale-105 font-medium">
                        Back to Home
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Section Divider -->
    <div class="section-divider"></div>
</main>

<!-- Custom JavaScript for load more functionality -->
<script>
function loadMorePosts() {
    // This can be enhanced with AJAX functionality
    // For now, it will just navigate to the next page
    const currentPage = <?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?>;
    const nextPage = currentPage + 1;
    const maxPages = <?php echo $wp_query->max_num_pages; ?>;
    
    if (nextPage <= maxPages) {
        window.location.href = '<?php echo get_pagenum_link(999999999); ?>'.replace('999999999', nextPage);
    }
}
</script>

<?php get_footer(); ?>
