<?php /* Template Name: Page Album */ ?>

<?php get_header() ?>

<main class="main">
	<section class="main__albums_page albums_page">
		<h2 class="albums_page__title" role="heading" aria-level="2">
			<?php the_field('page_title') ?>
		</h2>

		<?php 
		$album = new WP_Query([
		            'post_type' => 'album',
		            'orderBy' => 'date',
		            'order' => 'desc',
		            'posts_per_page' => 1
		        ]); 
        ?>	
    	<?php if ($album->have_posts()) : while($album->have_posts()) : $album->the_post(); ?>
    		<section class="albums_page__album album">
    			<div class="album__container">
    				<div class="album__img_container">
    					<img <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>
    				</div>
    			</div>
    			<div class="album__info">
    				<h3 class="album__title" role="heading" aria-level="3">
    					<?php the_title() ?>
    				</h3>
    				<div class="album__description">
    					<?php the_field('description') ?>
    				</div>
    			</div>
    			<div class="album__music">
    				<?php
				   	$music = get_field('music');
				    if( $music ): ?>
				        <?php foreach( $music as $post ):
				            // Setup this post for WP functions (variable must be named $post).
				            setup_postdata($post); ?>
				            <section class="album__music music">
				                <div class="music__play">
				                	<button>
				                		<img src="" alt>
				                	</button>
				                </div>
				                <h3 class="album__title" role="heading" aria-level="3">
			    					<?php the_title() ?>
			    				</h3>
			    				<p class="music__duration">
			    					
			    				</p> 
			    				<div class="music__star">
				                	<button>
				                		<img src="" alt>
				                	</button>
				                </div>
				                <div class="music__love">
				                	<button>
				                		<img src="" alt>
				                	</button>
				                </div>
				            </section> 
				        <?php endforeach; ?>
				    <?php
				    // Reset the global post object so that the rest of the page works correctly.
				    wp_reset_postdata(); ?>
				<?php endif; ?>
    			</div>
    		</section>
		<?php endwhile; endif; ?>
	</section>
</main>

<?php get_footer() ?>