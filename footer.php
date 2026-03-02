	<footer id="colophon" class="site-footer bg-gray-900 text-white mt-auto py-12">
		<div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
			<div class="footer-info col-span-1 md:col-span-1">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-serif font-bold text-white mb-4 flex items-center gap-2">
                    <i data-lucide="mountain" class="text-blue-500"></i>
                    <?php bloginfo( 'name' ); ?>
                </a>
				<p class="text-gray-400 max-w-sm mt-4 leading-relaxed">
					Curating the best outdoor and travel experiences with beautiful modern WordPress themes. Enjoy the ultimate adventure with Easy Theme.
				</p>
			</div>

            <div class="footer-links col-span-1">
                <h3 class="font-serif text-lg font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="link" class="w-5 h-5 text-blue-500"></i>
                    Quick Links
                </h3>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'menu_class'     => 'space-y-3 font-medium text-gray-400 hover:[&>li>a]:text-blue-400 [&>li>a]:transition-colors',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </div>

            <div class="footer-social col-span-1">
                <h3 class="font-serif text-lg font-semibold mb-6 flex items-center gap-2">
                    <i data-lucide="users" class="w-5 h-5 text-blue-500"></i>
                    Connect With Us
                </h3>
                <div class="flex gap-4 mb-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors bg-white/10 p-2 rounded-full"><i data-lucide="facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors bg-white/10 p-2 rounded-full"><i data-lucide="instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors bg-white/10 p-2 rounded-full"><i data-lucide="twitter"></i></a>
                </div>
            </div>
		</div>
        
        <div class="site-info bg-gray-950 py-6 mt-12 text-center text-gray-500 text-sm flex items-center justify-center gap-2 flex-wrap">
			<i data-lucide="copyright" class="w-4 h-4"></i> <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
            <span class="mx-2 hidden sm:inline">|</span>
            <span class="flex items-center gap-1">Crafted with <i data-lucide="heart" class="text-red-500 w-4 h-4"></i> using Easy Theme.</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
