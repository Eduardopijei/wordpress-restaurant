<?php
$id = $args['post'];
$image = get_field('image', $id);
$img_src = $image['sizes']['offer-module'];
$img_src_2x = $image['sizes']['offer-module-2x'];
$title = get_the_title( $id );
$excerpt = get_the_excerpt( $id );
$cta = get_field( 'cta', $id ); 
?>
<article class="card-offer" data-id="<?php echo $id; ?>">
    <a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>">
        <div class="card-offer__image gradient-overlay">
            <?php if ($image) : ?>
                <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_src_2x; ?>" 
                    alt="<?php echo $title; ?>" class="card-offer__bg">
            <?php endif; ?>
        </div>
        <p class="card-offer__title"><?php echo $title; ?></p>
    </a>
</article>