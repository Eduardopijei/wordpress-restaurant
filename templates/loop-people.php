<?php 
$post = $args['id'];
?>
<div class="people gradient-overlay">
    <?php if( $image = get_field( 'image', $post ) ): ?>
        <img class="people-image"
                src="<?php echo $image['sizes']['people-grid']; ?>"
                srcset="<?php echo $image['sizes']['people-grid-2x']; ?> 2x"
                alt="<?php echo get_the_title( $post ); ?>">
    <?php endif; ?>
    <h6 class="people-name"><?php echo get_the_title( $post ); ?></h6> 
</div>