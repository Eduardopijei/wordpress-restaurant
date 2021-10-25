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
                    <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="26.5" cy="26.5" r="26.5" transform="rotate(-90 26.5 26.5)" fill="#A0814C"/>
                        <path d="M26.997 33.3335L21.5108 23.831L32.4833 23.831L26.997 33.3335Z" fill="white"/>
                    </svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($featured_culinary) : ?>
    <div class="culinary-banner__right">
        <?php foreach($featured_culinary as $featured) : 
            $title = get_the_title($featured); 
            $excerpt = get_the_excerpt( $featured );
            $day = get_the_date( 'd', $featured );
            $month = get_the_date( 'M', $featured );
            $image = get_field('image', $featured);
            $img_src = $image['sizes']['offer-image'];
            $img_src_2x = $image['sizes']['offer-image-2x']; ?>
            <div class="featured-culinary">
                <img src="<?php echo $img_src; ?>" srcset="<?php echo $img_src_2x; ?>" 
                    alt="<?php echo $title; ?>" class="featured-culinary__image">
                <div class="featured-culinary__content">
                    <div class="featured-culinary__date a-up">
                        <span class="featured-culinary__date--day"><?php echo $day; ?></span>
                        <span class="featured-culinary__date--month">
                            <?php echo $month; ?>
                        </span>
                    </div>
                    <div class="featured-culinary__title a-up a-delay-1"><?php echo $title; ?></div>
                    <div class="featured-culinary__excerpt a-up a-delay-2"><?php echo $excerpt; ?></div>
                </div>
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