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
        <video autoplay playsinline class="home-hero__bg" muted preload="metadata" src="<?php echo $bg_video; ?>" poster="<?php echo $bg; ?>">
            <source src="<?php echo $bg_video; ?>" type="video/mp4">
        </video>
        <button class="btn-audio">
            <span class="btn-audio--play">
                <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="4" width="4" height="11" fill="white"/>
                    <rect x="6" width="4" height="15" fill="white"/>
                    <rect x="12" y="2" width="4" height="13" fill="white"/>
                </svg>
            </span>
            <span class="btn-audio--mute">
                <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="4" height="15" fill="white"/>
                    <rect x="6" width="4" height="15" fill="white"/>
                </svg>
            </span>
        </button>
    <?php else: ?>
        <img src="<?php echo $bg; ?>" alt="" class="home-hero__bg">
    <?php endif; ?>
    <?php if ($logo || $logo_text) : ?>
        <div class="home-hero__logo">
            <span class="home-hero__logo--text a-up"><?php echo $logo_text; ?></span>
            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="home-hero__logo--img a-up">
        </div>
    <?php endif; ?>
    <?php if ($nextId) : ?>
        <div class="scroll-link__wrapper">
            <a href="#<?php echo $nextId; ?>" class="scroll-link a-down">
                Take Me There
            </a>
        </div>
        <div class="line">
           <span class="line-top"></span> 
           <span class="line-bottom"></span> 
        </div>
    <?php endif; ?>
</section>