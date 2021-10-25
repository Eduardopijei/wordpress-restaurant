<?php
$id = $args['post'];
$image = get_field('image', $id);
$img_src = $image['sizes']['offer-image'];
$img_src_2x = $image['sizes']['offer-image-2x'];
$title = get_the_title( $id );
$excerpt = get_the_excerpt( $id );
$cta = get_field('cta', $id); 
$terms = get_the_terms( $id, 'offer_category'); ?>
<article class="loop-offer" data-id="<?php echo $id; ?>">
    <a href="<?php echo $cta['url']; ?>" target="<?php echo $cta['target']; ?>">
        <div class="loop-offer__image">
            <?php if ($image) : ?>
                <div class="img-a">
                    <div class="img-a-img gradient-overlay">
                        <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_src_2x; ?>" 
                            alt="<?php echo $title; ?>" class="loop-offer__bg">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </a>
    <?php if ($terms) : ?>
        <span class="loop-offer__category a-up a-delay-3"><?php echo $terms[0]->name; ?></span>
    <?php endif; ?>
    <?php if ($cta) : ?>
        <a href="<?php echo $cta['url']; ?>" 
            class="btn btn--accent loop-offer__btn"
            target="<?php echo $cta['target']; ?>">
            <?php echo $cta['title']; ?>
        </a>
    <?php endif; ?>
    <div class="loop-offer__content">
        <h6 class="loop-offer__title a-up"><?php echo $title; ?></h6>
        <?php if ($excerpt) : ?>
            <p class="loop-offer__excerpt a-up a-delay-1"><?php echo $excerpt; ?></p>
        <?php endif; ?>
    </div>
</article>