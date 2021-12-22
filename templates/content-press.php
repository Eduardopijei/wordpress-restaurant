<?php 
// Loop press
global $post; 
?>
<article class="press-loop" data-id="<?php echo $post->ID; ?>">
    <?php $img_url = get_the_post_thumbnail_url( $post->ID, 'loop-press' );
    $img_url_2x = get_the_post_thumbnail_url( $post->ID, 'loop-press-2x' );
    if( $img_url ): ?>
    <div class="press-loop__img">
        <a href="<?php echo get_the_permalink( $post ); ?>">
            <img class="lazyload" 
                data-src="<?php echo $img_url; ?>"
                data-srcset="<?php echo $img_url_2x; ?> 2x"
                    alt="<?php echo get_the_title( $post ); ?>">
        </a>
    </div>
    <?php endif; ?>
    <h6 class="press-loop__title"><?php echo get_the_title( $post ); ?></h6>
    <p class="press-loop__excerpt"><?php echo get_the_excerpt( $post ); ?></p>
    <a href="<?php echo get_the_permalink( $post ); ?>" class="link">
        See Article
    </a>
</article>