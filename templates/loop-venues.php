<?php 
$post = $args['post']; 
$image_type = $args['image_type'];  ?>
<div class="loop-venues">
    <div class="loop-venues--img gradient-overlay">
        <?php 
        if( $image_type == 'meeting' ) :
            $image = get_field( 'image', $post );
        else: 
            $image = get_field( 'wedding_image', $post );
        endif;
        if( $image ): ?>
            <a href="#" class="venues-modal__btn" data-id="<?php echo get_the_ID( $post ); ?>">
                <img class="lazyload" 
                    data-src="<?php echo $image['sizes']['venue-image']; ?>" 
                    data-srcset="<?php echo $image['sizes']['venue-image-2x']; ?> 2x"
                    alt="<?php echo $image['alt']; ?>">
            </a>
        <?php endif; ?>
        <h6 class="loop-venues--title"><?php echo get_the_title( $post ); ?></h6>
        <div class="loop-venues--info">
            <div class="loop-venues--info__mobile">
                <span>
                <?php 
                $cap = get_field( 'cap', $post );
                $size = get_field( 'size', $post );
                if( $cap ): ?>
                    CAP : <?php echo $cap; ?>
                <?php endif; ?>
                <?php if( $cap && $size): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?>
                <?php if( $size ): ?>
                    <?php echo $size; ?> SQ.FT.
                <?php endif; ?>
                </span>
            </div>
            <div class="loop-venues--info__pc">
                <?php if( $cap = get_field( 'cap', $post ) ): ?>
                    <span>CAP : <?php echo $cap; ?></span>
                <?php endif; ?>
                <?php if( $size = get_field( 'size', $post ) ): ?>
                    <span><?php echo $size; ?> SQ.FT.</span>
                <?php endif; ?>
            </div>
        </div>
        <?php if( $matterport = get_field( 'matterport', $post ) ): ?>
            <a href="<?php echo $matterport; ?>" class="loop-venues--matterport" target="_blank">
                <svg width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.0002 0L0.000244141 5.94419V17.9623L11.0002 23.7767L22.0002 17.9623V6.00858L11.0002 0V0ZM10.0002 21.0028L3.33624 17.4809L7.53724 14.7059C8.61724 13.9936 7.47124 12.3689 6.29424 13.1456L2.00024 15.9809V8.15344L10.0002 12.4759V21.0028ZM3.13324 6.50888L10.0002 2.79773V7.18256C10.0002 8.49325 12.0002 8.49424 12.0002 7.18256V2.80863L18.9102 6.58418L11.0052 10.7629L3.13324 6.50888V6.50888ZM12.0002 12.4828L20.0002 8.2535V15.9809L15.7372 13.1654C14.5562 12.3877 13.4142 14.0124 14.4922 14.7247L18.6642 17.4799L12.0002 21.0028V12.4828V12.4828Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
    <?php if( $excerpt = get_the_excerpt( $post ) ): ?>
        <p class="loop-venues--excerpt"><?php echo $excerpt; ?></p>
    <?php endif; ?>
</div>