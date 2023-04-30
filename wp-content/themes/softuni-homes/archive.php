<?php get_header(); ?>

<?php the_archive_title(); ?>

<?php if ( have_posts() ) : ?>
	<ul class="properties-listing">
		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/post', 'item' ); ?>

		<?php endwhile; ?>
	</ul>

<?php else : ?>

    <?php _e( 'Not found posts', 'softuni' ); ?>

<?php endif; ?>

<?php get_footer(); ?>