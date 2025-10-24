<?php get_header(); ?>

<main>
    <!-- Hero Section for Pages -->
    <section class="gradient-bg text-white py-16 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
                <?php the_title(); ?>
            </h1>
            <?php if (has_excerpt()) : ?>
                <p class="max-w-3xl mx-auto text-xl opacity-90 leading-relaxed">
                    <?php the_excerpt(); ?>
                </p>
            <?php endif; ?>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <?php while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class('bg-white rounded-2xl card-shadow overflow-hidden'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-w-16 aspect-h-9">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-64 object-cover')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="p-8">
                    <!-- Page Content -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Page Links (for paginated content) -->
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links mt-8 pt-6 border-t border-gray-200"><span class="font-semibold text-gray-900">Pages:</span>',
                        'after'  => '</div>',
                        'link_before' => '<span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg mx-1 hover:bg-indigo-200 transition-colors">',
                        'link_after'  => '</span>',
                    ));
                    ?>
                </div>
            </article>
            
            <!-- Comments (if enabled for pages) -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="mt-12">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
