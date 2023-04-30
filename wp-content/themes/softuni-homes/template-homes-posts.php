<?php
/* Template Name: Display posts */
?>

<?php get_header(); ?>

<?php
$posts_args = array(
	'post_type'			=> 'post',
	'post_status'		=> 'publish',
	'orderby'			=> 'date',
	'order'				=> 'ASC',
);

$posts_query = new WP_Query( $posts_args );
?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		the_content();
	}
}
?>

<ul class="posts-listing">
	<?php if ( $posts_query->have_posts() ) : ?>

		<?php while( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

			<?php get_template_part( 'template-parts/home', 'item' ); ?>

		<?php endwhile; ?>

		<?php posts_nav_link(); ?>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
</ul>

<?php get_footer(); ?>