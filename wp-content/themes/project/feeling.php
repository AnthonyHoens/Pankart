<?php /* Template Name: Page Coups de coeurs / coup de gueule */ ?>

<?php get_header() ?>

<main class="main">
	<section class="main__feelings_page feelings_page">
		<h2 class="feelings_page__title" role="heading" aria-level="2">
			<?php the_field('page_title') ?>
		</h2>

		<?php
		 $feelings = new WP_Query([
		            'post_type' => 'feeling',
		            'orderBy' => 'date',
		            'order' => 'desc',
		        ]);
		 ?>
		 <div class="feelings_page__container">
		 	
			<?php if ($feelings->have_posts()) : while($feelings->have_posts()) : $feelings->the_post(); ?>
				<section class="feelings_page__feeling feeling 
						<?php if(the_field('choice') === 'Coup de coeur'): ?> 
	                     	<?= 'love' ?> 
	                     <?php elseif(the_field('choice') === 'Coup de gueule'): ?>
	                     	<?= 'hate' ?> 
	                     <?php endif; ?>
	                     ">
					<h3 class="feeling__title" role="heading" aria-level="3">
						<?php the_title() ?>
					</h3>
					<p class="feeling__date">
						<?php the_date('j F Y') ?>
					</p>

					<div class="feeling__img_container">
						<img <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>
					</div>

					<div class="feeling__description">
						<?php the_field('description') ?>
					</div>
				</section>

		 	<?php endwhile; endif; ?>
	 	</div>
	</section>
</main>

<?php get_footer() ?>