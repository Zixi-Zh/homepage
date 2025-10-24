<?php get_header(); ?>

<main>
    <!-- Search Hero -->
    <section class="gradient-bg text-white py-16 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                Search Results
            </h1>
            <?php if (have_posts()) : ?>
                <p class="max-w-3xl mx-auto text-xl opacity-90 leading-relaxed">
                    Found <?php echo $wp_query->found_posts; ?> result(s) for "<?php echo get_search_query(); ?>"
                </p>
            <?php else : ?>
                <p class="max-w-3xl mx-auto text-xl opacity-90 leading-relaxed">
                    No results found for "<?php echo get_search_query(); ?>"
                </p>
            <?php endif; ?>
        </div>
    </section>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <!-- Search Form -->
        <div class="bg-white rounded-xl card-shadow p-6 mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Try a new search:</h2>
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex gap-4">
                <input type="search" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                       placeholder="Search for posts..." 
                       value="<?php echo get_search_query(); ?>" 
                       name="s" />
                <button type="submit" 
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:shadow-lg transition-all transform hover:scale-105 font-medium">
                    Search
                </button>
            </form>
        </div>
        
        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('block bg-white rounded-xl shadow hover:shadow-lg transition-all p-6 hover-lift'); ?>>
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="flex items-start space-x-4">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="flex-shrink-0">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'w-20 h-20 object-cover rounded-lg')); ?>
                                    </div>
                                <?php else : ?>
                                    <div class="flex-shrink-0">
                                        <span class="text-4xl text-indigo-500">🔍</span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="flex-1 min-w-0">
                                    <!-- Post type indicator -->
                                    <div class="mb-2">
                                        <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs font-medium">
                                            <?php echo get_post_type(); ?>
                                        </span>
                                    </div>
                                    
                                    <h2 class="font-bold text-lg text-indigo-700 mb-2 line-clamp-2">
                                        <?php 
                                        $title = get_the_title();
                                        echo $title ? $title : 'Untitled';
                                        ?>
                                    </h2>
                                    
                                    <div class="text-gray-500 text-sm mb-3">
                                        <span>By <?php the_author(); ?></span>
                                        <span class="mx-1">•</span>
                                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                        <?php if (get_the_category()) : ?>
                                            <span class="mx-1">•</span>
                                            <span><?php the_category(', '); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php
                                    $excerpt = get_the_excerpt();
                                    if ($excerpt) {
                                        echo '<p class="text-gray-600 text-sm line-clamp-3">' . wp_trim_words($excerpt, 20, '...') . '</p>';
                                    } else {
                                        echo '<p class="text-gray-600 text-sm line-clamp-3">' . wp_trim_words(get_the_content(), 20, '...') . '</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                <?php tailwind2_pagination(); ?>
            </div>
            
        <?php else : ?>
            <!-- No results found -->
            <div class="text-center py-16">
                <div class="bg-white rounded-xl shadow p-8 max-w-2xl mx-auto">
                    <div class="text-6xl mb-6">🔍</div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">No Results Found</h2>
                    <p class="text-gray-600 mb-8">Sorry, we couldn't find any posts matching your search. Try different keywords or browse our recent posts.</p>
                    
                    <!-- Search suggestions -->
                    <div class="text-left max-w-md mx-auto mb-8">
                        <h3 class="font-semibold mb-3 text-gray-900">Search suggestions:</h3>
                        <ul class="text-gray-600 space-y-1 text-sm">
                            <li>• Check your spelling</li>
                            <li>• Try more general keywords</li>
                            <li>• Use fewer keywords</li>
                            <li>• Browse our categories</li>
                        </ul>
                    </div>
                    
                    <!-- Recent Posts -->
                    <div>
                        <h3 class="font-semibold mb-4 text-gray-900">Recent Posts</h3>
                        <div class="grid gap-4">
                            <?php
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3,
                                'post_status' => 'publish'
                            ));
                            foreach($recent_posts as $post) :
                            ?>
                                <a href="<?php echo get_permalink($post['ID']); ?>" class="block p-3 bg-gray-50 rounded-lg hover:bg-indigo-50 transition-colors text-left">
                                    <h4 class="font-medium text-indigo-600 hover:text-purple-600"><?php echo $post['post_title']; ?></h4>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo get_the_date('M j, Y', $post['ID']); ?></p>
                                </a>
                            <?php endforeach; wp_reset_query(); ?>
                        </div>
                        
                        <div class="mt-6">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all transform hover:scale-105 font-medium">
                                View All Posts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
