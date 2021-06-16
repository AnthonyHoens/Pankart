<?php /* Template Name: Page News */ ?>

<?php get_header() ?>

<main class="main">
	<section class="main__news news">
		<h2 class="news__title" role="heading" aria-level="2">
			<?php the_field('page_title') ?>
		</h2>

		<?php
		 $news = new WP_Query([
		            'post_type' => 'news',
		            'orderBy' => 'date',
		            'order' => 'desc',
		        ]);
		 ?>
		 <div class="news__container">
		 	<?php if ($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>
				<section class="news__new new">
					<h3 class="new__title" role="heading" aria-level="3">
						<?php the_title() ?>
					</h3>
					<p class="new__date">
						<?php the_date('j F Y') ?>
					</p>

					<div class="new__img_container">
						<img <?= dw_the_thumbnail_attributes(['thumbnail','medium', 'large']) ?>>
					</div>

					<div class="new__description">
						<?php the_field('description') ?>
					</div>

					<a class="new__link" href="<?php the_permalink() ?>">En voir plus</a>
				</section>
		 	<?php endwhile; endif; ?>
		 </div>
	</section>
</main>

<?php get_footer() ?>