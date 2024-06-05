<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-areadel">
		<main id="main" class="site-store" role="main">

			<?php
                echo the_content();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
