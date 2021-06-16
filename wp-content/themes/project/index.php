<?php /* Template Name: Page d'accueil */ ?>
<?php get_header() ?>

<main class="main">
	<section class="main__landing_page landing_page">
		<h1 class="landing_page__special_title" aria-level="1" role="heading">
			<?= get_bloginfo('name') ?>
		</h1>
		<p class="landing_page__phrase">
			<?php the_field('phrase') ?>
		</p>
		<?php the_field('description') ?>

		<div class="landing_page__link_container">
			<a href="" class="landing_page__link">Que fait <?= get_bloginfo('name') ?> ?</a>
		</div>

		<div class="landing_page__video_container">
			<video src="" class="video"></video>
		</div>
	</section>

	<section class="main__events events">
		<h2 class="events__title" aria-level="2" role="heading">
			Prochaines Dates
		</h2>

		<?php
			$events = new WP_Query([
	            'post_type' => 'event',
	            'orderBy' => 'date',
	            'order' => 'desc',
	            'posts_per_page' => 4
	        ]);
		 ?>
		<div class="events__event_container">
			<?php if ($events->have_posts()) : while($events->have_posts()) : $events->the_post(); ?>
				<section class="events__event event">
					<h3 class="event__title" aria-level="3" role="heading">
						<a href="<?php the_field('event_link') ?>" target="_blank"><?php the_title() ?></a>
					</h3>
					<p class="event__date">
						<?php the_field('date') ?>
					</p>

					<p class="event__max_people">
						Maximum <?php the_field('person_max') ?> personnes
					</p>
				</section>
			<?php endwhile; endif; ?>
			<?php 
				// Reset the global post object so that the rest of the page works correctly.
			    wp_reset_postdata(); 
		    ?>
		</div>
		<div class="events__link_container">
			<a href="https://www.pankart.anthony-hoens.be/dates/" class="events__link">Voir toutes les dates</a>
		</div>
	</section> 

	<section class="main__albums albums">
		<h2 class="albums__title" aria-level="2" role="heading">
			<?php the_field('album_title') ?>
		</h2>

		<?php
	   	$album = get_field('album');
	    if( $album ): ?>
	        <?php foreach( $album as $post ):
	            // Setup this post for WP functions (variable must be named $post).
	            setup_postdata($post); ?>
	            <section class="albums__album album">
	                <div class="album__img_container ">
                        <img class="album__img" <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>
	                </div>
	                <div class="album__info">
	                    <h3 class="album__title" aria-level="3" role="heading">
                            <?php the_title(); ?>
	                    </h3>
	                    
	                    <div class="album__description">	
	                    	<?php the_field('description'); ?>
	                    </div>
	                </div>
	            </section> 
	        <?php endforeach; ?>
	    <?php
	    // Reset the global post object so that the rest of the page works correctly.
	    wp_reset_postdata(); ?>


	    <?php else :

	        $album = new WP_Query([
	            'post_type' => 'album',
	            'orderBy' => 'date',
	            'order' => 'desc',
	            'posts_per_page' => 1
	        ]);

	    ?>
	    	<?php if ($album->have_posts()) : while($album->have_posts()) : $album->the_post(); ?>
	    		<section class="albums__album album">
	                <div class="album__img_container ">
                        <img class="album__img" <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>
	                </div>
	                <div class="album__info">
	                    <h3 class="album__title" aria-level="3" role="heading">
                            <?php the_title(); ?>
	                    </h3>
	                    
	                    <div class="album__description">	
	                    	<?php the_field('description'); ?>
	                    </div>
	                </div>
	            </section>
            <?php endwhile; endif; ?>
		<?php endif; ?>
	</section>

	<section class="main__feelings feelings">
		<h2 class="feelings__title" aria-level="2" role="heading">
			<?php the_field('feeling_title') ?>
		</h2>

		<div class="feelings__feeling_container">
			
		<?php
		   	$feelings = get_field('feelings');
		    if( $feelings ): ?>
		        <?php foreach( $feelings as $post ):
		            // Setup this post for WP functions (variable must be named $post).
		            setup_postdata($post); ?>
		            <section class="feelings__feeling feeling">
	                    <h3 class="feeling__title <?php if(the_field('choice') === 'Coup de coeur'): ?> 
	                     	<?= 'love' ?> 
	                     <?php elseif(the_field('choice') === 'Coup de gueule'): ?>
	                     	<?= 'hate' ?> 
	                     <?php endif; ?>
	                     " aria-level="3" role="heading">
                            <?php the_title(); ?>
	                    </h3>

	                    <p class="feeling__date">
	                    	<?php the_time('j F Y'); ?>
	                    </p>
	                    
	                    <div class="feeling__description">
	                    	<?php the_field('description'); ?>
	                    </div>
		                <div class="feeling__button button">
		                	<a href="" class="button__like">
		                		<img src="" alt="" class="button__img button__img_like">
		                	</a>
		                	<a href="" class="button__comment">
		                		<img src="" alt="" class="button__img button__img_comment">
		                	</a>
		                	<a href="" class="button__share">
		                		<img src="" alt="" class="button__img button__img_share">
		                	</a>
		                </div>
		            </section>
		        <?php endforeach; ?>
		    <?php
		    // Reset the global post object so that the rest of the page works correctly.
		    wp_reset_postdata(); ?>


		    <?php else :

		        $feelings = new WP_Query([
		            'post_type' => 'feeling',
		            'orderBy' => 'date',
		            'order' => 'desc',
		            'posts_per_page' => 6
		        ]);

		    ?>
		    	<?php if ($feelings->have_posts()) : while($feelings->have_posts()) : $feelings->the_post(); ?>
		    		<section class="feelings__feeling feeling">
	                    <h3 class="feeling__title <?php if(the_field('choice') === 'Coup de coeur'): ?> 
	                     	<?= 'love' ?> 
	                     <?php elseif(the_field('choice') === 'Coup de gueule'): ?>
	                     	<?= 'hate' ?> 
	                     <?php endif; ?>" aria-level="3" role="heading">
                            <?php the_title(); ?>
	                    </h3>

	                    <p class="feeling__date">
	                    	<?php the_time('j F Y'); ?>
	                    </p>
	                    
	                    <div class="feeling__description">
	                    	<?php the_field('description'); ?>
	                    </div>
		                <div class="feeling__button button">
		                	<a href="" class="button__like">
		                		<img src="" alt="" class="button__img button__img_like">
		                	</a>
		                	<a href="" class="button__comment">
		                		<img src="" alt="" class="button__img button__img_comment">
		                	</a>
		                	<a href="" class="button__share">
		                		<img src="" alt="" class="button__img button__img_share">
		                	</a>
		                </div>
		            </section>	
	            <?php endwhile; endif; ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer() ?>