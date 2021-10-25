<?php

/**
 * Media Content Post Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'media-content-post-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'media-content media-content-post media-content--left';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$posts = get_field( 'post' );
if( $posts ) :
    foreach( $posts as $post ) : 
        $image = get_field( 'image', $post );
        $video = get_field( 'video', $post ); 
        $heading = get_the_title( $post );
        $sub_heading = get_field( 'sub_heading', $post );
        $excerpt = get_field( 'excerpt', $post );
        $cta = get_the_permalink( $post );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ($image || $video) : ?>
            <div class="media-content__media">
                <?php 
                    get_template_part( 'templates/content-modules', 'image', array(
                        'image' => $image,
                        'video' => $video
                    ) );
                ?>
            </div>
        <?php endif; ?>
        <div class="media-content__content">
            <h2 class="media-content__title a-up"><?php echo $heading; ?></h2>
            <?php if( $sub_heading ) : ?>
                <h6 class="media-content__subtitle a-up a-delay-1"><?php echo $sub_heading; ?></h6>
            <?php endif; ?>
            <?php if ($excerpt) : ?>
            <div class="media-content__text a-up a-delay-2">
                <?php echo $excerpt; ?>
            </div>
            <?php endif; ?>
            <a href="<?php echo $cta; ?>" 
                class="btn btn--accent media-content__btn a-up a-delay-3">
                Read More
            </a>
        </div>
    </div>
</section>
<?php endforeach;
endif; ?>