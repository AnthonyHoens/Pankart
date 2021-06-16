<?php /* Template Name: Page Agenda */ ?>
<?php get_header() ?>

<main class="main">
	<section class="main__agenda agenda">
		<h2 class="agenda__title" aria-level="2" role="headding">
			<?php the_field('page_title') ?> 
		</h2>
		<?php
	        $events = new WP_Query([
	            'post_type' => 'event',
	            'orderBy' => 'date',
	            'order' => 'desc',
	        ]);

	    ?>
	    <div class="agenda__container">
	    	<?php if ($events->have_posts()) : while($events->have_posts()) : $events->the_post(); ?>
	    		<section class="agenda__event event">
                	<p class="event__date">
                		<?php the_field('date') ?>
                	</p>
                    <h3 class="event__title" aria-level="3" role="heading">
                        <?php the_title(); ?>
                    </h3>
                    <p class="event_location">
                    	<?php the_field('location') ?>
                    </p>
                    
                    <div class="event__description">
                    	<?php the_field('description'); ?>
                    </div>
	            </section>
	        <?php endwhile; endif; ?>
	    </div>
        <?php // Reset the global post object so that the rest of the page works correctly.
		    wp_reset_postdata(); ?>
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
		                <div class="feeling__info">
		                    <h3 class="feeling__title" aria-level="3" role="heading">
	                            <?php the_title(); ?>
		                    </h3>

		                    <p class="feeling__date">
		                    	<?php the_time('d/m/Y'); ?>
		                    </p>
		                    
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
		            'posts_per_page' => 3
		        ]);

		    ?>
		    	<?php if ($feelings->have_posts()) : while($feelings->have_posts()) : $feelings->the_post(); ?>
		    		<section class="feelings__feeling feeling">
		                <div class="feeling__info">
		                    <h3 class="feeling__title" aria-level="3" role="heading">
	                            <?php the_title(); ?>
		                    </h3>

		                    <p class="feeling__date">
		                    	<?php the_time('d/m/Y'); ?>
		                    </p>
		                    
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