<?php global $post; ?>
<article class="loop-post">
    <div class="loop-post__img">
        <?php 
        $img = get_the_post_thumbnail_url( $post, 'culinary-grid' );
        $img_2x = get_the_post_thumbnail_url( $post, 'culinary-grid-2x' ); ?>
        <a href="<?php echo get_the_permalink( $post ); ?>">
            <img src="<?php echo $img; ?>"
                srcset="<?php echo $img_2x; ?> 2x" 
                alt="<?php echo get_the_title( $post ); ?>">
        </a>
        <span class="loop-post__category">
            <?php 
            $primary_cat = get_primary_taxonomy_term( $post );
            echo $primary_cat['title']; ?></span>
    </div>
    <div class="loop-post__content">
        <span class="loop-post__date"><?php echo get_the_date( 'm.d.Y', $post ); ?></span>
        <a href="<?php echo get_the_permalink( $post ); ?>" class="loop-post__title">
            <h2><?php echo get_the_title( $post ); ?></h2>
        </a>
        <p class="loop-post__excerpt"><?php echo get_the_excerpt( $post ); ?></p>
    </div>
</article>