<?php

/**
 * Media Content Two Images Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'media-two-images-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'media-two-images';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="images">
            <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'first_image', 'o' => 'f', 'w' => 'div', 'wc' => 'image-first', 'c' => 'a-right', 'is' => 'two-images-big' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-image', array( 'v' => 'second_image', 'o' => 'f', 'w' => 'div', 'wc' => 'image-second', 'c' => 'a-right a-delay-1', 'is' => 'two-images-small' ) ); ?>
        </div>
        <div class="content">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f', 't' => 'h1', 'tc' => 'sub-heading a-up h6' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'heading a-up a-delay-1' ) ); ?>
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'content', 'o' => 'f', 't' => 'div', 'tc' => 'desc a-up a-delay-2' ) ); ?>
            <?php if( have_rows( 'ctas' ) ): ?>
                <div class="buttons">
                    <?php while( have_rows( 'ctas' ) ): the_row( ); ?>
                        <?php if( $cta = get_sub_field( 'cta' ) ) : ?>
                            <a href="<?php echo $cta['url']; ?>" 
                                class="btn btn--<?php echo the_sub_field( 'type' ); ?> a-up a-delay-2" 
                                target="<?php echo $cta['target']; ?>">
                                <?php echo $cta['title']; ?>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?> 
        </div>
    </div>
</section>