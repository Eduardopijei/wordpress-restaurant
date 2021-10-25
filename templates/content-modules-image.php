<?php 
$video = $args['video'];
$image = $args['image']; 
?>
<?php if ($video) : ?>
    <div class="img-a-video">
        <?php if ($image): ?>
            <div class="img-a-img">
                <img src="<?php echo $image; ?>" alt="">
            </div>
        <?php endif; ?>
        <div class="img-a-bg-video">
            <video autoplay playsinline muted preload="metadata" src="<?php echo $video; ?>" poster="<?php echo $image; ?>">
                <source src="<?php echo $video; ?>" type="video/mp4">
            </video>
        </div>
    </div>
<?php elseif ($image) : ?>
    <div class="img-a">
        <div class="img-a-img">
            <img src="<?php echo $image; ?>" alt="">
        </div>
    </div>
<?php endif; ?>