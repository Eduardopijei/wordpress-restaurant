<?php

/**
 * Culinary Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'events-experiences-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'events-experiences';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$heading = get_field('heading');
$posts = get_field('posts');
$cta = get_field('cta');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if ($heading) : ?>
            <h3 class="events-experiences__heading"><?php echo $heading; ?></h3>
        <?php endif; ?>
        <?php if ($posts) : ?>
        <div class="events-experiences__grid">
            <?php 
            foreach ($posts as $post) :
                get_template_part( 'templates/loop', 'experience', array(
                    'post' => $post,
                    'disable_link' => true
                ) );
            endforeach; 
            wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <div class="events-experiences__cta--wrapper">
                <a href="<?php echo $cta['url']; ?>" 
                    class="btn events-experiences__cta"
                    target="<?php echo $cta['target']; ?>">
                    <?php echo $cta['title']; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>