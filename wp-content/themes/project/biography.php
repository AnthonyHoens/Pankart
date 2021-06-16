<?php /* Template Name: Page Biographie */ ?>

<?php get_header() ?>

<main class="main">
	<section class="main__biography biography">
		<h2 class="biography__title" aria-level="2">
			<?php the_field('page_title') ?>
		</h2>

		<?php
        $first_section = get_field('first_section');
        if( $first_section ): ?>
        	<section class="biography__first_section first_section">
	            <div class="first_section__info">
	                <h3 aria-level="3" role="heading" class="first_section__title">
	                    <?= $first_section['title'] ?>
	                </h3>
	                <div class="first_section__description">
	                	<?= $first_section['description'] ?>
	                </div>
	                <div class="first_section__link_container">
	                	<a href="<?= $first_section['link'] ?>" class="first_section__link"><?= $first_section['link_name'] ?></a>
	                </div>
	            </div>
	            <div class="first_section__img_container">
	                <img class="first_section__img" <?= dw_the_img_attributes($first_section['image'], ['thumbnail','medium', 'large']) ?>>
	            </div>
        	</section>
        <?php endif; ?>
	</section>

	<section class="main__members members">
		<h2 class="members__title" aria-level="2">
			<?php the_field('member_title') ?>
		</h2>

		<?php
		   	$member = get_field('member');
		    if( $member ): ?>
		        <?php foreach( $member as $post ):
		            // Setup this post for WP functions (variable must be named $post).
		            setup_postdata($post); ?>
		            <section class="members__member member">
						<div class="member__img_container">
							<h3 class="member__title" aria-level="3" role="heading">
								<?php the_title() ?>
							</h3>
							<img <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>	
						</div>
						<p class="member__role">
							<?php the_field('role') ?>
						</p>

						<div class="member__description">
							<?php the_field('description') ?>
						</div>
					</section>
		        <?php endforeach; ?>
		    <?php
		    // Reset the global post object so that the rest of the page works correctly.
		    wp_reset_postdata(); ?>

		<?php else:
			$members = new WP_Query([
	            'post_type' => 'member',
	        ]);
		 ?>
			<?php if ($members->have_posts()) : while($members->have_posts()) : $members->the_post(); ?>
				<section class="members__member member">
					<div class="member__img_container">
						<h3 class="member__title" aria-level="3" role="heading">
							<?php the_title() ?>
						</h3>
						<img <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>	
					</div>
					<p class="member__role">
						<?php the_field('role') ?>
					</p>

					<div class="member__description">
						<?php the_field('description') ?>
					</div>
				</section>
			<?php endwhile; endif; ?>
		<?php endif; ?>
	</section>

	<section class="main__albums albums">
		<h2 class="albums__title" aria-level="2" role="heading">
			<?php the_field('album_title') ?>
		</h2>

		<div class="albums__container">
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
		                    
		                    <?php the_field('description'); ?>
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
		                    
		                    <?php the_field('description'); ?>
		                </div>
		            </section>
	            <?php endwhile; endif; ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer() ?>