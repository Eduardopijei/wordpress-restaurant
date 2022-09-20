<?php
get_header(); 
global $wp_query;
$slug = get_queried_object(  )->slug;
$name = get_queried_object(  )->name; 
$taxonomy = get_queried_object(  )->taxonomy;
?>
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
                        <option value="<?php echo get_term_link( $category ); ?>" <?php if( $slug == $category->slug) : echo 'selected'; endif; ?>><?php echo $category->name; ?></option>                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <?php endif; ?>
        <?php if( have_posts( ) ): ?>
            <div class="blog-grid">
                <?php while( have_posts( ) ): the_post( );
                    get_template_part( 'templates/loop', 'post' );
                endwhile; ?>
            </div>
        <?php endif;  ?>
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