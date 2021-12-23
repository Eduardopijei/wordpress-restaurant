<?php
/*
* Template Name: Blog
* Template Type: page
*/
get_header(); ?>
<section class="blog">
    <div class="container">
        <h1 class="blog-title">Journal</h1>
        <?php $categories = get_categories();
        if( $categories ): ?>
        <div class="post-categories blog-categories">
            <div class="post-categories__selector">
                <select name="" id="" class="post-categories__select link-select" jcf-select>
                    <option value="<?php echo esc_url( home_url( '/journal' ) ); ?>">All Stories</option>
                    <?php foreach( $categories as $category ): ?>
                        <option value="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <?php endif; ?>
        <?php 
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'posts_per_page'    => 6,
            'paged'             => $paged,
        );
        $query = new WP_Query( $args );
        if( $query->have_posts( ) ): ?>
            <div class="blog-grid">
                <?php while( $query->have_posts( ) ): $query->the_post( );
                    get_template_part( 'templates/loop', 'post' );
                endwhile; ?>
            </div>
        <?php endif;  ?>
        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $query->max_num_pages,
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