<?php 
$is_home = $args['is_home_module'];
$id = get_the_ID();
$image = get_field('image', $id);
$img_src = $image['sizes']['single-culinary'];
$img_src_2x = $image['sizes']['single-culinary-2x'];
$title = get_the_title( $id );
$cta = get_field('cta', $id);
if( $is_home == true): 
    $excerpt = get_field( 'description', $id ) ?: get_the_excerpt( $id ); 
else:
    $excerpt = get_the_excerpt( $id ); 
endif;
$terms = get_the_terms( $id, 'culinary_time');
if ( $terms ) {
    foreach ($terms as $key=>$term) {
        $term_name .= $term->name;
        $class_name .= $term->slug;
        if ($key < count($terms) - 1) {
            $term_name .= ' | ';
            $class_name .= ' ';
        }
    }
} 
?>
<article class="loop-culinary <?php echo $class_name; ?>" data-id="<?php echo $id; ?>">
    <div class="loop-culinary__image gradient-overlay">
        <?php if ($image) : ?>
        <a href="<?php echo get_the_permalink( $id ); ?>" class="loop-culinary__link a-op">
            <img data-src="<?php echo $img_src; ?>" data-srcset="<?php echo $img_src_2x; ?>" 
                alt="<?php echo $title; ?>" class="loop-culinary__bg lazyload">
        </a>
        <?php endif; ?>
        <h6 class="loop-culinary__title a-up"><?php echo $title; ?></h6>
    </div>
    <?php if ($terms) : ?>
        <span class="loop-culinary__category a-up"><?php echo $term_name; ?></span>
    <?php endif; ?>
    <div class="loop-culinary__content">
        <?php if ($excerpt) : ?>
            <p class="loop-culinary__excerpt a-up"><?php echo $excerpt; ?></p>
        <?php endif; ?>
    </div>
    <?php if( $cta ): ?>
        <div class="loop-culinary__cta--wrapper">
            <a href="<?php echo $cta['url']; ?>" 
                target="<?php echo $cta['target']; ?>" 
                class="btn btn--accent a-up">
                <?php echo $cta['title']; ?>
            </a>
        </div>
    <?php endif; ?>
</article>