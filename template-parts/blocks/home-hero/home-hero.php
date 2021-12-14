<?php

/**
 * Home Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'home-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$bg = get_field('background_image');
$bg_video = get_field('background_video');
$logo = get_field('logo_image');
$logo_text = get_field('logo_text');
$nextId = get_field('next_section_id');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if ($bg_video) : ?>
        <video loop autoplay playsinline class="home-hero__bg" muted preload="metadata" src="<?php echo $bg_video; ?>" poster="<?php echo $bg['url']; ?>">
            <source src="<?php echo $bg_video; ?>" type="video/mp4">
        </video>
    <?php else: ?>
        <img data-src="<?php echo $bg['url']; ?>" alt="<?php echo $bg['alt']; ?>" class="home-hero__bg lazyload">
    <?php endif; ?>
    <?php if ($logo || $logo_text) : ?>
        <div class="home-hero__logo">
            <span class="home-hero__logo--text a-up"><?php echo $logo_text; ?></span>
            <img data-src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="home-hero__logo--img a-up lazyload">
        </div>
    <?php endif; ?>
    <button class="btn btn--accent home-hero__cta btn-modal" data-target="#modal-booking">
        Check Availability
    </button>
    <?php if ($nextId) : ?>
        <div class="scroll-link__wrapper">
            <a href="#<?php echo $nextId; ?>" class="scroll-link a-down">
                <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="29" cy="29" r="28.5" stroke="white"/>
                    <path d="M29.349 36.3374L23.2972 25.8555L35.4007 25.8555L29.349 36.3374Z" fill="white"/>
                </svg>
            </a>
        </div>
    <?php endif; ?>
</section>