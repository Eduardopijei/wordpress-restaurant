<?php
/**
 * Amentities Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'amentities-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'amentities';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
global $post;
$pid = $post->ID;
$amentities = get_field( 'amentites', $pid );
$size = get_field( 'size', $pid );
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="amentities-inner">
        <div class="amentities-content">
            <div class="amentities-content__body">
                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'amentities-heading' ) ); ?>
                <?php if( $amentities ): ?>
                    <div class="amentities-text">
                        <?php echo $amentities; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if( $size ): ?>
            <div class="amentities-content__footer">
                <div class="amentities-size"><?php echo $size; ?> <small>SQ. FT.</small></div>
                <!-- <a href="#" class="btn btn-view-gallery">View Gallery</a> -->
            </div>
            <?php endif; ?>
        </div>
        <?php if( $images = get_field( 'images' ) ): ?>  
        <div class="amentities-images">
            <div class="amentities-carousel">
                <?php foreach( $images as $image ): ?>
                    <div class="amentities-image">
                        <img class="lazyload" 
                            data-src="<?php echo $image['sizes']['amentities']; ?>"
                            data-srcset="<?php echo $image['sizes']['amentities-2x']; ?>" 
                            alt="<?php echo $image['alt']; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>