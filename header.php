<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site relative min-h-screen flex flex-col">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'easy-theme' ); ?></a>

	<header id="masthead" class="site-header bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 shadow-sm transition-all duration-300">
		<div class="container mx-auto px-4 py-4 flex items-center justify-between">
			<div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-2xl font-serif font-bold text-gray-900 flex items-center gap-2 decoration-transparent transition-colors hover:text-blue-600">
                    <i data-lucide="mountain-snow" class="text-blue-500 w-8 h-8"></i>
                    <?php bloginfo( 'name' ); ?>
                </a>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation hidden md:block">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'flex items-center gap-8 font-medium text-gray-700',
                        'fallback_cb'    => false,
					)
				);
				?>
			</nav><!-- #site-navigation -->

            <div class="md:hidden">
                <button class="menu-toggle text-gray-900 hover:text-blue-600 transition-colors">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
		</div>
	</header><!-- #masthead -->
