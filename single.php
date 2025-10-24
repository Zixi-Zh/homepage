<?php get_header(); ?>

<main>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-2xl card-shadow overflow-hidden'); ?>>
                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="relative">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-64 md:h-96 object-cover')); ?>
                        
                        <!-- Category overlay -->
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <div class="absolute top-4 left-4">
                                <span class="blog-category <?php echo get_category_color_class($categories[0]->name); ?>">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <div class="p-8">
                    <!-- Post Meta -->
                    <div class="flex items-center space-x-2 mb-6 blog-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        <span class="text-gray-300">•</span>
                        <span><?php echo get_reading_time(); ?></span>
                        <span class="text-gray-300">•</span>
                        <span>By <?php the_author(); ?></span>
                    </div>
                    
                    <!-- Post Title -->
                    <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800 leading-tight">
                        <?php the_title(); ?>
                    </h1>
                    
                    <!-- Post Content -->
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Post Tags -->
                    <?php if (has_tag()) : ?>
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-medium text-gray-600 mr-2">Tags:</span>
                                <?php
                                $tags = get_the_tags();
                                if ($tags) {
                                    foreach ($tags as $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="bg-gray-100 hover:bg-indigo-100 text-gray-700 hover:text-indigo-700 px-3 py-1 rounded-full text-sm transition-colors">' . $tag->name . '</a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Engagement Stats (like blog.html) -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-400 text-sm">👍 <?php echo rand(20, 80); ?></span>
                                <span class="text-gray-400 text-sm">💬 <?php echo get_comments_number(); ?></span>
                            </div>
                            
                            <!-- Share buttons -->
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600 mr-2">Share:</span>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   class="text-blue-500 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-700 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            
            <!-- Post Navigation -->
            <div class="mt-8 grid md:grid-cols-2 gap-4">
                <div>
                    <?php 
                    $prev_post = get_previous_post();
                    if ($prev_post) :
                    ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="block bg-white p-6 rounded-xl card-shadow hover:shadow-lg transition-all hover-lift">
                            <span class="text-sm text-gray-500 mb-2 block">← Previous Post</span>
                            <h3 class="font-bold text-indigo-600 hover:text-purple-600 transition-colors">
                                <?php echo get_the_title($prev_post->ID); ?>
                            </h3>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="text-right">
                    <?php 
                    $next_post = get_next_post();
                    if ($next_post) :
                    ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="block bg-white p-6 rounded-xl card-shadow hover:shadow-lg transition-all hover-lift">
                            <span class="text-sm text-gray-500 mb-2 block">Next Post →</span>
                            <h3 class="font-bold text-indigo-600 hover:text-purple-600 transition-colors">
                                <?php echo get_the_title($next_post->ID); ?>
                            </h3>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="mt-12">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>
    </div>
    
    <!-- Related Posts -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Related Posts
            </h2>
            
            <?php
            // Get related posts by category
            $categories = get_the_category();
            if ($categories) {
                $category_ids = array();
                foreach ($categories as $individual_category) {
                    $category_ids[] = $individual_category->term_id;
                }
                
                $args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 3,
                    'orderby' => 'rand'
                );
                
                $related_posts = new WP_Query($args);
                
                if ($related_posts->have_posts()) :
            ?>
                    <div class="grid md:grid-cols-3 gap-8">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                            <article class="blog-card bg-white rounded-2xl card-shadow overflow-hidden">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="relative">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover')); ?>
                                        </a>
                                        <?php
                                        $post_categories = get_the_category();
                                        if (!empty($post_categories)) :
                                        ?>
                                            <div class="absolute top-4 left-4">
                                                <span class="blog-category <?php echo get_category_color_class($post_categories[0]->name); ?>">
                                                    <?php echo esc_html($post_categories[0]->name); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-6">
                                    
                                    
                                    <h3 class="text-xl font-bold mb-3 text-gray-800 leading-tight">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-indigo-600 transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <a href="<?php the_permalink(); ?>" class="text-indigo-600 font-medium hover:underline flex items-center space-x-1">
                                            <span>Read more</span>
                                            <span>→</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
            <?php
                endif;
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
