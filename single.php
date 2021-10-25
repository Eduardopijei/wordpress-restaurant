<?php get_header(); ?>


	<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
	
		<?php 
			if (get_post_type() == 'people') : 
				get_template_part( 'templates/content', 'people' ); 
			else :
				get_template_part( 'templates/content', 'post' ); 
			endif;
		?>
		
	<?php endwhile; ?>
	
	<?php else : ?>
		<?php get_template_part( 'templates/content', 'none' ); ?>
	<?php endif; ?>


<?php get_footer(); ?>