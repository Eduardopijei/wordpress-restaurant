<?php 
$post = $args['id'];
$name = get_the_title( $post );
$role = get_field( 'role', $post );
$image = get_field( 'image', $post );
if( $image ) {
    $image_url = $image['sizes']['people-slider'];
    $image_url_2x = $image['sizes']['people-slider-2x'];
}
$excerpt = get_the_excerpt( $post );
$link = get_the_permalink( $post );
?>
<article class="loop-people" data-id="<?php echo $post; ?>">
    <a href="<?php echo $link; ?>">
        <div class="loop-people__image">
            <img src="<?php echo $image_url; ?>" 
                <?php echo $image_url_2x ? 'srcset="'. $image_url_2x .' 2x"' : ''; ?> 
                alt="<?php echo $name; ?>">
            <h6 class="loop-people__title"><?php echo $name; ?></h6>
        </div>
    </a>
    <div class="loop-people__content">
        <?php if( $role ) : ?>
            <h6 class="loop-people__role"><?php echo $role; ?></h6>
        <?php endif; ?>
        <div class="loop-people__excerpt"><?php echo $excerpt; ?></div>
    </div>
</article>