<?php

/**
 * Press Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'press-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'press';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$heading = get_field( 'heading' );
$content = get_field( 'content' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if( $heading ): ?>
            <h1 class="press-heading">
                <?php echo $heading; ?>
            </h1>
        <?php endif; ?>
        <?php if( $content ): ?>
            <div class="press-content">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
        <?php $terms = get_terms( 'press_category' );
        if( $terms ): ?>
            <div class="post-categories press-categories">
                <ul class="press-categories__links">
                    <li>
                        <a href="<?php echo esc_url( home_url( '/press' ) ); ?>" class="press-categories__link active">
                            All Press Highlights
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
                        <li>
                            <a href="<?php echo get_term_link($term); ?>" class="press-categories__link">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
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
        <?php 
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array( 
            'post_type'         => 'press',
            'post_status'       => 'publish',
            'paged'             => $paged,
        );
        $temp_query = $wp_query;
        $wp_query = null;
        $wp_query = $custom_query; 

        $custom_query = new WP_Query( $args );
        if( $custom_query->have_posts( ) ): ?>
            <div class="press-grid">
                <?php while( $custom_query->have_posts( ) ): $custom_query->the_post( );
                    get_template_part( 'templates/content', 'press' );
                endwhile; ?>
            </div>
        <?php endif;
        wp_reset_postdata(  ); ?>
        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $custom_query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    // 'format'       => '?paged=%#%',
                    'show_all'     => false,
                    // 'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => false,
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
        </div>
        <?php $wp_query = null;
        $wp_query = $temp_query; ?>
    </div>
</section>