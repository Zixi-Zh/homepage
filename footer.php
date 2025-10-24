    <!-- Footer - Exact copy from blog.html -->
    <div class="section-divider"></div>  
    <footer class="bg-white border-t-2 border-gray-100 py-16 text-sm">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 px-4">
            <div>
                <h4 class="font-bold mb-6 text-gray-800 text-lg">Legal Information</h4>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url(home_url('/docs/ein.pdf')); ?>"
                            class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center space-x-2">
                            <span>📄</span><span>EIN&nbsp;39-3069824</span>
                        </a></li>
                    <li><a href="<?php echo esc_url(home_url('/docs/IRS_letter.pdf')); ?>"
                            class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center space-x-2">
                            <span>📋</span><span>IRS Determination Letter</span>
                        </a></li>
                    <li><a href="<?php echo esc_url(home_url('/docs/990.pdf')); ?>"
                            class="text-gray-600 hover:text-indigo-600 transition-colors flex items-center space-x-2">
                            <span>📊</span><span>Form 990 Filing</span>
                        </a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-gray-800 text-lg">Need Help Right Now?</h4>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center space-x-3">
                        <span class="text-red-500 text-lg">📞</span>
                        <span class="font-medium">988 Suicide & Crisis Lifeline</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <span class="text-blue-500 text-lg">💬</span>
                        <span class="font-medium">Text "HOME" to 741741</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <span class="text-green-500 text-lg">🤝</span>
                        <span class="font-medium">NAMI Helpline: 1‑800‑950‑NAMI</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Additional footer widgets area -->
        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="max-w-6xl mx-auto px-4 mt-12 pt-8 border-t border-gray-200">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
        <?php endif; ?>
        
        <div class="text-center mt-12 pt-8 border-t border-gray-200">
            <p class="text-gray-500 text-sm">© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <p class="text-gray-400 text-xs mt-2">Building technology that serves humanity with compassion and care.</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
