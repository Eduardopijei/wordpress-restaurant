<?php 
$video = $args['video'];
$image = $args['image']; 
$is = $args['image_size'];
$is_2x = $args['image_size_2x'];
if( $image ):  
    if( $is || $is_2x  ) : 
        $image_url = $image['sizes']['image_size'];
        $image_url_2x = $image['sizes']['image_size_2x'];
    else: 
        $image_url = $image['url'];
    endif;
endif;
?>
<?php if ($video) : ?>
    <div class="img-a-video">
        <?php if ($image): ?>
            <div class="img-a-img">
                <img class="lazyload" 
                    data-src="<?php echo $image_url; ?>" 
                    <?php echo $is_2x ? 'data-srcset="' . $image_url_2x . ' 2x"' : ''; ?> 
                    alt="<?php echo $image['alt']; ?>">
            </div>
        <?php endif; ?>
        <div class="img-a-bg-video">
            <video loop autoplay playsinline muted preload="metadata" src="<?php echo $video; ?>" poster="<?php echo $image_url; ?>">
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
        </div>
    </div>
<?php elseif ($image) : ?>
    <div class="img-a">
        <div class="img-a-img">
            <img  class="lazyload" data-src="<?php echo $image_url; ?>" <?php echo $is_2x ? 'data-srcset="' . $image_url_2x . ' 2x"' : ''; ?> alt="<?php echo $image['url']; ?>">
        </div>
    </div>
<?php endif; ?>