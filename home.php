<?php
/**
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header('shop');


if ( have_posts() ) : ?>
    <div class="posts-wrapper">
    <?php
    // Start the Loop.
    while ( have_posts() ) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail( 'full', array( 'class' => 'post-thumbnail' ) ); ?>
                </a>
            <?php endif; ?>

            <span class="posted-on">
                <?php echo get_the_date(); ?>
            </span>
            <?php
            the_title(
                sprintf(
                    '<h2 class="entry-title"><a href="%s" rel="bookmark">',
                    esc_url( get_permalink() )
                ),
                '</a></h2>'
            );
            ?>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->
    <?php
    endwhile;
    ?>
    </div><!-- .posts-wrapper -->
<?php else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'storefront' ); ?></p>
<?php endif; ?>


<?php

get_footer('shop');
?>

