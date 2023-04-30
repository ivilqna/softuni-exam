<?php
/* Template Name: Display homes */
?>

<?php get_header(); ?>

<?php
$homes_args = array(
	'post_type'			=> 'home',
	'post_status'		=> 'publish',
	'orderby'			=> 'date',
	'order'				=> 'ASC',
);

$homes_query = new WP_Query( $homes_args );
?>

<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		the_content();
	}
}
?>

<ul class="homes-listing">
	<?php if ( $homes_query->have_posts() ) : ?>

		<?php while( $homes_query->have_posts() ) : $homes_query->the_post(); ?>

			<?php get_template_part( 'template-parts/home', 'item' ); ?>

		<?php endwhile; ?>

		<?php posts_nav_link(); ?>

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>
</ul>

<?php get_footer(); ?>