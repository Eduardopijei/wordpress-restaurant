<?php
get_header(  );  
global $wp_query;
$slug = get_queried_object(  )->slug;
$name = get_queried_object(  )->name; 
$taxonomy = get_queried_object(  )->taxonomy; ?>
<section class="press press-taxonomy">
    <div class="container">
        <h1 class="press-heading">
            <?php echo $name; ?>
        </h1>
        <?php $terms = get_terms( 'press_category' );
        if( $terms ): ?>
            <div class="post-categories press-categories">
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
                <div class="post-categories__selector press-categories__selector">
                    <select name="" id="" class="press-categories__select link-select" jcf-select>
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
    
