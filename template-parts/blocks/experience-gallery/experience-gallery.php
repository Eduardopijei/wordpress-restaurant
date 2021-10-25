<?php

/**
 * Experience Gallery Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'experience-gallery-' . $block['id'];


// Create class attribute allowing for custom "className" and "align" values.
$className = 'experience-gallery';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$cta = get_field('cta');
$gallery_opacity = get_field('gallery_opacity');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="experience-gallery__content">
        <?php if ($heading) : ?>
            <div class="experience-gallery__heading">
                <?php echo $heading; ?>
            </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <a href="<?php echo $cta['url']; ?>" class="btn experience-gallery__cta" target="<?php echo $cta['target']; ?>">
                <?php echo $cta['title']; ?>
            </a>
        <?php endif; ?>
    </div>
    <?php if (have_rows('items')) : ?>
    <div class="experience-gallery__items">
        <?php while (have_rows('items')) : the_row(); 
            $image = get_sub_field('image'); 
            $title = get_sub_field('title'); 
            $caption = get_sub_field('caption'); 
            $url = get_sub_field('url'); ?>
            <?php if ($url) : ?>
                <a href="<?php echo $url; ?>" class="experience-gallery__item" target="_blank">
            <?php else: ?>
                <div class="experience-gallery__item">
            <?php endif; ?>
                <?php if ($image) : ?>
                    <div class="img-a">
                        <div class="img-a-img">
                            <img src="<?php echo $image['url']; ?>" 
                                alt="<?php echo $image['alt']; ?>" 
                                class="experience-gallery__item--image">
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <h6 class="experience-gallery__item--title a-up a-delay-3"><?php echo $title; ?></h6>
                <?php endif; ?>
                <?php if ($caption) : ?>
                    <span class="experience-gallery__item--caption a-up a-delay-3"><?php echo $caption; ?></span>
                <?php endif; ?>
                <?php if (empty($title) && empty($caption)) : ?>
                    <span class="insta-icon a-up a-delay-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0)">
                            <path d="M12 2.163C15.204 2.163 15.584 2.175 16.85 2.233C20.102 2.381 21.621 3.924 21.769 7.152C21.827 8.417 21.838 8.797 21.838 12.001C21.838 15.206 21.826 15.585 21.769 16.85C21.62 20.075 20.105 21.621 16.85 21.769C15.584 21.827 15.206 21.839 12 21.839C8.796 21.839 8.416 21.827 7.151 21.769C3.891 21.62 2.38 20.07 2.232 16.849C2.174 15.584 2.162 15.205 2.162 12C2.162 8.796 2.175 8.417 2.232 7.151C2.381 3.924 3.896 2.38 7.151 2.232C8.417 2.175 8.796 2.163 12 2.163V2.163ZM12 0C8.741 0 8.333 0.014 7.053 0.072C2.695 0.272 0.273 2.69 0.073 7.052C0.014 8.333 0 8.741 0 12C0 15.259 0.014 15.668 0.072 16.948C0.272 21.306 2.69 23.728 7.052 23.928C8.333 23.986 8.741 24 12 24C15.259 24 15.668 23.986 16.948 23.928C21.302 23.728 23.73 21.31 23.927 16.948C23.986 15.668 24 15.259 24 12C24 8.741 23.986 8.333 23.928 7.053C23.732 2.699 21.311 0.273 16.949 0.073C15.668 0.014 15.259 0 12 0V0ZM12 5.838C8.597 5.838 5.838 8.597 5.838 12C5.838 15.403 8.597 18.163 12 18.163C15.403 18.163 18.162 15.404 18.162 12C18.162 8.597 15.403 5.838 12 5.838ZM12 16C9.791 16 8 14.21 8 12C8 9.791 9.791 8 12 8C14.209 8 16 9.791 16 12C16 14.21 14.209 16 12 16ZM18.406 4.155C17.61 4.155 16.965 4.8 16.965 5.595C16.965 6.39 17.61 7.035 18.406 7.035C19.201 7.035 19.845 6.39 19.845 5.595C19.845 4.8 19.201 4.155 18.406 4.155Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0">
                            <rect width="24" height="24" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </span>
                <?php endif; ?>
            <?php if ($url) : ?>
                </a>
            <?php else: ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>
<style>
    #<?php echo esc_attr($id); ?> .experience-gallery__item::after {
        opacity: <?php echo $gallery_opacity / 100; ?>;
    }
</style>