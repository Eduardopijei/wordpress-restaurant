<?php

/**
 * Offers Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'offers-module-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'offers-module';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$sub_heading = get_field( 'sub_heading' );
$desc = get_field( 'description' );
$offers = get_field('offers');
$cta = get_field('cta');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="title-text offers-module__info">
        <div class="container">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'heading', 'o' => 'f', 't' => 'h2', 'tc' => 'offers-module__heading', 'w' => 'div', 'wc' => 'title-text__title a-up' ) ); ?>  
            <div class="title-text__text a-up a-delay-1">
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'sub_heading', 'o' => 'f', 't' => 'h6', 'tc' => 'offers-module__subheading' ) ); ?>  
            <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 'o' => 'f', 't' => 'p', 'tc' => 'offers-module__desc' ) ); ?>  
            </div>
        </div>
    </div>
    <div class="container">
        <?php if ($offers) : ?>
        <div class="offers-module__grid">
            <?php foreach ($offers as $post) : 
                get_template_part( 'templates/card', 'offer', array( 'post' => $post ) );
            endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <div class="offers-module__btn--wrapper a-up">
                <a href="<?php echo $cta['url']; ?>" class="btn btn--primary offers-module__btn" target="<?php echo $cta['target']; ?>">
                    <?php echo $cta['title']; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>