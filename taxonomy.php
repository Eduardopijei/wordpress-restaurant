<?php
get_header(  );  
$slug = get_queried_object(  )->slug;
$name = get_queried_object(  )->name; 
$taxonomy = get_queried_object(  )->taxonomy; ?>
<?php if( $taxonomy == 'press_category' ) : ?>
    <section class="press press-taxonomy">
        <div class="container">
            <h1 class="press-heading">
                <?php echo $name; ?>
            </h1>
            <?php $terms = get_terms( 'press_category' );
            if( $terms ): ?>
                <div class="press-categories">
                    <ul class="press-categories__links">
                        <li class="press-categories__link">
                            <a href="<?php echo esc_url( home_url( '/press' ) ); ?>" class="press-categories__link">                                All Press Highlights
                            </a>
                        </li>
                        <?php 
                        $count = count( $terms );
                        foreach( $terms as $term): ?>
                            <?php if( get_row_index() == $count ): ?>
                                <li class="press-categories__link">
                                    <span class="separater"></span>
                                </li>
                            <?php endif; ?>
                            <a href="<?php echo get_term_link($term); ?>" class="press-categories__link <?php if( $term->slug == $slug ) : echo 'active'; endif; ?>">
                                <?php echo $term->name; ?>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                    <div class="press-categories__selector">
                        <select name="" id="" class="press-categories__select" jcf-select>
                            <option value="<?php echo esc_url( home_url( '/press' ) ); ?>">All Press Highlights</option>
                            <?php foreach( $terms as $term ): ?>
                                <option value="<?php echo get_term_link($term); ?>">    
                                    <?php echo $term->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
            <?php if( have_posts( ) ): ?>
                <div class="press-grid">
                    <?php while( have_posts( ) ): the_post( );
                        get_template_part( 'templates/content', 'press' );
                    endwhile; ?>
                </div>
            <?php endif;
            wp_reset_query(  ); ?>
        </div>
    </section>
<?php else: ?>
    <div id="content" class="col_content">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>

		<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'templates/content', 'post' ); ?>
		<?php endwhile; ?>
		
		<?php get_template_part( 'templates/pagination', 'post' ); ?>
		
	<?php else : ?>
		<?php get_template_part( 'templates/content', 'none' ); ?>
	<?php endif; ?>

	</div><!-- /content -->
<?php endif; ?>
<?php get_footer(); ?>
    
