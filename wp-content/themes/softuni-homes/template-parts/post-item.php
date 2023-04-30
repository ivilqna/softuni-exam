<li class="property-card">
				<div class="property-primary">
					<h2 class="property-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<div class="property-details">
						<span class="property-price"><?php the_category(); ?></span><br>
						<span class="property-date"><?php the_date(); ?></span>
					</div>
				</div>
				<div class="property-image">
					<div class="property-image-box">
					<?php
            		if ( has_post_thumbnail() ) {
                	the_post_thumbnail();
            		} else {
                	echo '<img src="images/bedroom.jpg" alt="property image">';
            		}
            		?>
					</div>
				</div>
			</li>
