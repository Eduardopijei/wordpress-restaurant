<?php
$id = $args['post'];
$image = get_field('image', $id);
$img_src = $image['sizes']['offer-image'];
$img_src_2x = $image['sizes']['offer-image-2x'];
$title = get_the_title( $id );
$excerpt = get_the_excerpt( $id );
$cta = get_field('cta', $id);
if ($args['post_type'] == 'offer') :
    $day = get_the_date('d', $id);
    $month = get_the_date('M', $id);
else : 
    $day = tribe_get_start_date($id, false, 'd');
    $month = tribe_get_start_date($id, false, 'F');
endif; ?>
<article class="loop-culinary" data-id="<?php echo $id; ?>">
    <div class="loop-culinary__image">
        <a href="<?php echo get_the_permalink( $id ); ?>">
        <?php if ($image) : ?>
            <div class="img-a">
                <div class="img-a-img gradient-overlay">
                    <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_src_2x; ?>" 
                        alt="<?php echo $title; ?>" class="loop-culinary__bg">
                </div>
            </div>
        <?php endif; ?>
        <h6 class="loop-culinary__title a-up"><?php echo $title; ?></h6>
        </a>
    </div>
    <div class="loop-culinary__date a-up a-delay-1">
        <span class="loop-culinary__date--day"><?php echo $day; ?></span>
        <span class="loop-culinary__date--month"><?php echo $month; ?></span>
    </div>
    <div class="loop-culinary__content">
        <?php if ($excerpt) : ?>
            <p class="loop-culinary__excerpt a-up a-delay-2"><?php echo $excerpt; ?></p>
        <?php endif; ?>
    </div>
</article>