<?php
get_header(  );  
global $wp_query;
$slug = get_queried_object(  )->slug;
$name = get_queried_object(  )->name; 
$taxonomy = get_queried_object(  )->taxonomy; ?>
<section class="press press-taxonomy">
    <div class="container">
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'press_heading', 'o' => 'o', 't' => 'h1', 'tc' => 'press-heading' ) ); ?>
        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'press_content', 'o' => 'o', 't' => 'div', 'tc' => 'press-content' ) ); ?>
        <?php $terms = get_terms( 'press_category' );
        if( $terms ): ?>
            <div class="post-categories press-categories">
                <ul class="press-categories__links">
                    <?php 
                    $count = count( $terms );
                    foreach( $terms as $term): ?>
                        <li>
                            <a href="<?php echo get_term_link($term); ?>" class="press-categories__link <?php if( $term->slug == $slug ) : echo 'active'; endif; ?>">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="post-categories__selector press-categories__selector">
                    <select name="" id="" class="press-categories__select link-select" jcf-select>
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
        <?php endif; ?>
        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $wp_query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => false,
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
        </div>
        <?php wp_reset_query(  ); ?>
    </div>
</section>
<?php get_footer(); ?>
    
