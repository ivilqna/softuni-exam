<li class="property-card">
	<div class="property-primary">
		<h1 class="property-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<div class="property-details">
			<span class="property-price"><?php the_author(); ?></span>
			<span class="property-date">Homes visits: <?php echo get_post_meta( get_the_ID(), 'visits_count', true ); ?></span>
			<span class="property-date"><?php the_date(); ?></span>
		</div>
		<div class="job-body">
							<?php the_content(); ?>
						</div>
	</div>
	<div class="property-image">
		<div class="property-image-box">
		<?php
		if ( has_post_thumbnail() ) {
		the_post_thumbnail();
		} else {
		echo '<img src="https://localhost/softuni-exam/wp-content/uploads/2023/04/bedroom.png" alt="property image">';
		}
		?>
		</div>
	</div>
	<a id="<?php echo get_the_ID(); ?>" class="like-button" href="#">Like (<?php echo get_post_meta( get_the_ID(), 'likes', true ) ?>)</a>
</li>
