<?php
get_header(  );  
global $wp_query;
$slug = get_queried_object(  )->slug;
$name = get_queried_object(  )->name; 
$taxonomy = get_queried_object(  )->taxonomy; ?>
<section class="press press-taxonomy">
    <div class="container">
        <h1 class="press-heading">New &amp; Noteworthy</h1>
        <div class="press-content">
            <h6 style="text-align: center;"><strong>HOT OF THE PRESS</strong></h6>
            <p>&nbsp;</p>
            <p style="text-align: center;">Keep up with what is new and noteworthy at the Boston Harbor Hotel. From recent news highlights to press releases, you can find all you need to know here.</p>
            <p>&nbsp;</p>
            <p style="text-align: center;">Become a <a href="https://www.facebook.com/BostonHarborHotel/">fan of the Boston Harbor Hotel on Facebook</a> and&nbsp;<a href="https://twitter.com/HarborHotel" target="_blank" rel="noopener">follow the Hotel on Twitter @HarborHotel </a>for the latest Boston&nbsp;<a href="https://www.bostonharborhotel.com/experiences">events</a> and <a href="https://www.bostonharborhotel.com/offers">hotel promotions</a>.</p>
            <p>&nbsp;</p>
            <p style="text-align: center;">Please contact Kiley Merrill at&nbsp;<a href="mailto:keldemery@bhh.com">kmerrill@bhh.com</a>, with any questions.</p>
        </div>
        <?php $terms = get_terms( 'press_category' );
        if( $terms ): ?>
            <div class="post-categories press-categories">
                <ul class="press-categories__links">
                    <?php 
                    $count = count( $terms );
                    foreach( $terms as $term): ?>
                        <li>
                            <a href="<?php echo get_term_link($term); ?>" class="press-categories__link <?php if( $term->slug == 'press' ) : echo 'active'; endif; ?>">
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
    
