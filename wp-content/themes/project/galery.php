<?php /* Template Name: Page Galerie */ ?>

<?php get_header() ?>

<main class="main">
	<section class="main__galleries galleries">
		<h2 class="galleries__title" role="heading" aria-level="2">
			<?php the_field('page_title') ?>
		</h2>
		<div class="galleries__gallery gallery">
			<?php
	        $gallery = get_field('image');
	        $galleryCount = count($gallery);
	        if( $gallery ): ?>
            	<?php foreach($gallery as $img):
                    if ($img): ?>
                    	<div class="gallery__img_container">
                        	<img class="gallery__img" <?= dw_the_img_attributes($img, ['thumbnail','medium', 'large']) ?>>
                        </div>
                <?php endif; endforeach; ?>
	        <?php endif; ?>
		</div>
	</section>
</main>

<?php get_footer() ?>