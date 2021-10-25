<?php

/**
 * Post Two Cols Alt Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'post-two-cols-' . $block['id'];


// Create class attribute allowing for custom "className" and "align" values.
$className = 'post-two-cols';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$content = get_field( 'content' );
$posts = get_field( 'posts' );
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="post-two-cols__inner">
            <?php if ($heading) : ?>
                <h2 class="post-two-cols__heading a-up"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <?php if( $content ) : ?>
                <div class="post-two-cols__content a-up a-delay-1"><?php echo $content; ?></div>
            <?php endif; ?>
        </div>
        <?php if( $posts ) : ?> 
            <div class="post-two-cols__posts">
                <?php foreach( $posts as $post ) : ?>
                    <div class="post-two-cols__post">
                        <a href="<?php echo get_the_permalink( $post ); ?>">
                            <?php get_template_part( 'templates/content-modules', 'image', array( 'image' => get_field( 'image', $post )) ); ?>
                            <h6 class="post-two-cols__post--title a-up"><?php echo get_the_title( $post ); ?></h6>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>