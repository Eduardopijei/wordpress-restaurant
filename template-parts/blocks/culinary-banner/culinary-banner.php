<?php

/**
 * Media Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'culinary-banner-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'culinary-banner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$heading = get_field('heading');
$content = get_field('content');
$scrollTo = get_field('scroll_to');
$featured_culinary = get_field('featured_culinary');
$cta_style = get_field( 'cta_style' );
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="culinary-banner__left">
        <?php if ($heading) : ?>
            <h1 class="culinary-banner__heading a-up"><?php echo $heading; ?></h1>
        <?php endif; ?>
        <?php if ($content) : ?>
            <div class="culinary-banner__content a-up a-delay-1">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
        <?php if ($scrollTo) : ?>
            <div class="scroll-link__wrapper a-up a-delay-2">
                <a href="<?php echo $scrollTo['url']; ?>"
                class="scroll-link">
                    <?php echo $scrollTo['title']; ?>
                    <?php if( $cta_style == 'blue' ): ?>
                        <svg width="62" height="61" viewBox="0 0 62 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="31.3906" cy="30.5" r="30.5" fill="#3F526F"/>
                            <path d="M31.8906 37L25.8284 26.5H37.9528L31.8906 37Z" fill="white"/>
                        </svg>
                    <?php else: ?>
                        <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_1293_2565)">
                        <circle cx="34.5" cy="34.5" r="26.5" transform="rotate(-90 34.5 34.5)" fill="#FAF7F1"/>
                        </g>
                        <path d="M34.5002 42.3333L26.8503 29.0833L42.1501 29.0833L34.5002 42.3333Z" fill="#3F526F"/>
                        <defs>
                        <filter id="filter0_d_1293_2565" x="0" y="0" width="69" height="69" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset/>
                        <feGaussianBlur stdDeviation="4"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.24 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1293_2565"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1293_2565" result="shape"/>
                        </filter>
                        </defs>
                        </svg>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($featured_culinary) : ?>
    <div class="culinary-banner__right">
        <?php foreach($featured_culinary as $featured) : 
            $title = get_the_title($featured); 
            $excerpt = get_the_excerpt( $featured );
            $date = get_field( 'featured_date', $featured );
            if ( $date['start_date'] ) {
                $dateObj = DateTime::createFromFormat('Ymd', $date['start_date']);
                $day = $dateObj->format('d');
                $month = $dateObj->format('M');
            } else {
                $day = get_the_date( 'd', $featured );
                $month = get_the_date( 'M', $featured );
            }
            if( $date['end_date'] ) {
                $dateObj = DateTime::createFromFormat('Ymd', $date['end_date']);
                $end_day = $dateObj->format('d');
                $end_month = $dateObj->format('M');
            }
            $image = get_field('image', $featured);
            $img_src = $image['sizes']['culinary-banner'];
            $img_src_2x = $image['sizes']['culinary-banner-2x']; 
            $type = get_post_type( $featured ); ?>
            <div class="featured-culinary gradient-overlay type-<?php echo $type; ?>">
                <a href="<?php echo get_the_permalink( $featured ); ?>" class="featured-culinary__link">
                    <img data-src="<?php echo $img_src; ?>" data-srcset="<?php echo $img_src_2x; ?>" 
                        alt="<?php echo $image['alt'] ?: $title; ?>" class="featured-culinary__image lazyload">
                    <?php if( $type == 'culinary' ): ?> 
                    <div class="featured-culinary__dates">
                        <div class="featured-culinary__date featured-culinary__date--start a-op">
                            <span class="featured-culinary__date--day"><?php echo $day; ?></span>
                            <span class="featured-culinary__date--month">
                                <?php echo $month; ?>
                            </span>
                        </div>
                        <?php if( $date['start_date'] != $date['end_date'] ): ?>
                        <div class="featured-culinary__date featured-culinary__date--end a-op">
                            <span class="featured-culinary__date--day"><?php echo $end_day; ?></span>
                            <span class="featured-culinary__date--month">
                                <?php echo $end_month; ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <div class="featured-culinary__content">
                        <?php if( $type == 'offer' ): ?>
                            <h6 class="featured-culinary__subtitle a-up">Featured Offer</h6>
                        <?php endif; ?>
                        <div class="featured-culinary__title a-up a-delay-1"><?php echo $title; ?></div>
                        <?php if( $type == 'culinary' ): ?>
                        <div class="featured-culinary__excerpt a-up a-delay-2"><?php echo $excerpt; ?></div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>
<style>
    #<?php echo esc_attr($id); ?> .featured-culinary::after {
        opacity: <?php echo floatval(intval(get_field('gradient_opacity')) / 100); ?>
    }
</style>