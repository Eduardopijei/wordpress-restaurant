<?php

/**
 * Rooms Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'rooms-hero-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'rooms-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$image = get_field('background_image');
$video = get_field('background_video');
$heading = get_field('heading');
$content = get_field('content');
$opacity = get_field('gradient_opacity');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="home-hero">
        <?php if ($video) : ?>
            <video autoplay playsinline class="home-hero__bg" muted preload="metadata" src="<?php echo $video; ?>" poster="<?php echo $bg; ?>">
                <source src="<?php echo $video; ?>" type="video/mp4">
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
            <img src="<?php echo $image; ?>" alt="" class="home-hero__bg">
        <?php endif; ?>
    </div>
    <div class="rooms-hero__inner">
        <?php if( $heading ) : ?>
            <h1 class="rooms-hero__heading"><?php echo $heading; ?></h1>
        <?php endif; ?>
        <?php if( $content ) : ?>
            <div class="rooms-hero__content"><?php echo $content; ?></div>
        <?php endif; ?>
        <?php if( have_rows( 'links' ) ) : ?>
            <nav class="rooms-nav">
                <div class="rooms-nav__mobile">
                    <select name="" id="" class="rooms-nav__select">
                        <?php while( have_rows( 'links' ) ) : the_row(); 
                            $link = get_sub_field( 'link' ); ?>
                            <option value="<?php echo $link['url']; ?>">
                                <?php echo $link['title']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <ul class="rooms-nav__desktop">
                    <?php while( have_rows( 'links' ) ) : the_row(); 
                        $link = get_sub_field( 'link' ); ?>
                        <li class="rooms-nav__item">
                            <a href="<?php echo $link['url']; ?>" class="scroll-link rooms-nav__link">
                                <?php echo $link['title']; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<style>
    #<?php echo $id; ?> .home-hero::after {
        opacity: <?php echo floatval(intval($opacity) / 100); ?> !important;
    }
  
</style>