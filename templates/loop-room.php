<?php
$id = get_the_ID();
$title = get_the_title( );
$excerpt = get_the_excerpt(  );
$images = get_field( 'gallery', $id );
$amentites = get_field( 'amentitles', $id );
$matterport_link = get_field( 'matterport_link', $id );
$bedroom = get_field( 'bedroom', $id );
$size = get_field( 'size', $id );
$hilton = get_field( 'hilton_variables', $id );
$booking = 'https://www.hilton.com/en/book/reservation/rooms/?ctyhocn=SJDWAWA';
?>
<div class="loop-room">
    <?php if( $images ) : ?>
    <div class="loop-room__slider">
        <div class="loop-room__slides">
            <?php foreach( $images as $image ) : ?>
                <div class="loop-room__slide gradient-overlay">
                    <img class="lazyload" data-src="<?php echo $image['sizes']['room-slider-small']; ?>"
                        data-srcset="<?php echo $image['sizes']['room-slider-small-2x']; ?> 2x"
                        alt="<?php echo $image['alt']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
        <?php if( $matterport_link ): ?>
            <a href="<?php echo $matterport_link; ?>" class="loop-room__matterport" target="_blank">
                <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.0039 0L0.00390625 6V18.131L11.0039 24L22.0039 18.131V6.065L11.0039 0V0ZM10.0039 21.2L3.33991 17.645L7.54091 14.844C8.62091 14.125 7.47491 12.485 6.29791 13.269L2.00391 16.131V8.23L10.0039 12.593V21.2ZM3.13691 6.57L10.0039 2.824V7.25C10.0039 8.573 12.0039 8.574 12.0039 7.25V2.835L18.9139 6.646L11.0089 10.864L3.13691 6.57ZM12.0039 12.6L20.0039 8.331V16.131L15.7409 13.289C14.5599 12.504 13.4179 14.144 14.4959 14.863L18.6679 17.644L12.0039 21.2V12.6Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
        <?php if( $bedroom ): ?>
            <span class="loop-room__bedroom"><?php echo $bedroom > 1 ? $bedroom . '    bedrooms' : $bedroom . '    bedroom'; ?></span>
        <?php endif; ?>
        <?php if( $size ): ?>
            <span class="loop-room__size"><?php echo $size; ?> SQFT</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="loop-room__content">
        <h6 class="loop-room__title"><?php echo $title; ?></h6>
        <div class="loop-room__excerpt"><?php echo $excerpt; ?></div>
        <div class="button-groups">
            <button class="btn btn-amentities" data-id="<?php echo $id; ?>">View Amentities</button>
            <?php if( $hilton['room_code'] ): ?>
            <a href="<?php echo $booking . '&roomTypeCode=' . $hilton['room_code']; ?>" class="btn btn--accent btn-reserve" target="_blank">
                Reserve Now
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>