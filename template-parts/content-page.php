<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<div class="entry-content">
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
		            <?php get_template_part('template-parts/loop-modules');?>
                </div>
            </div>
        </div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
