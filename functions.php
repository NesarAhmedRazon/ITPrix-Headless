<?php

use OcaLaTheme\AutoLoader;

/*
 * Set up our auto loading class and mapping our namespace to the app directory.
 *
 * The autoloader follows PSR4 autoloading standards so, provided StudlyCaps are used for class, file, and directory
 * names, any class placed within the app directory will be autoloaded.
 *
 * i.e; If a class named SomeClass is stored in app/SomeDir/SomeClass.php, there is no need to include/require that file
 * as the autoloader will handle that for you.
 */
require get_stylesheet_directory() . '/app/AutoLoader.php';
$loader = new AutoLoader();
$loader->register();
$loader->addNamespace( 'OcaLaTheme', get_stylesheet_directory() . '/app' );

require get_stylesheet_directory() . '/includes/scripts-and-styles.php';




add_action( 'after_setup_theme', 'ocala_init' );
function ocala_init(){
   if ( ! function_exists( 'ocala_styles' ) ) :

	/**
	 * Enqueue styles.
	 * @return void
	 */
	function ocala_styles() {
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
        $js_dependencies = [
			'wp-block-editor',
			'wp-blocks',
			'wp-editor',
			'wp-components',
			'wp-compose',
			'wp-data',
			'wp-element',
			'wp-hooks',
			'wp-i18n',
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		];
		wp_register_style(
			'oca-style',
			get_template_directory_uri() . '/assets/css/style.css',
			[],
			$version_string
		);
        wp_register_script(
			'oca-script',
			get_template_directory_uri() . '/assets/js/main.js',
			$js_dependencies,
			$version_string
		);

		// Add styles inline.
		//wp_add_inline_style( 'oca-style', twentytwentytwo_get_font_face_styles() );

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'oca-style' );
        wp_enqueue_script( 'oca-script' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'ocala_styles' );
}