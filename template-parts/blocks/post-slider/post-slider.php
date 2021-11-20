<?php

/**
 * Post Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'post-slider-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'post-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$posts = get_field('posts');
?>
<?php if ($posts) : ?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container"> 
        <div class="post-slides__contents--wrapper">
            <div class="post-slides post-slides__contents">
                <?php foreach($posts as $post) : ?>
                    <div class="post-slide">
                        <div class="post-slide__content">
                            <h2 class="post-slide__title"><?php echo get_the_title($post); ?></h2>
                            <?php if ($subtitle = get_field('sub_title', $post)) : ?>
                                <h6 class="post-slide__subtitle"><?php echo $subtitle; ?></h6>
                            <?php endif; ?>
                            <?php if ($excerpt = get_the_excerpt( $post )) : ?>
                                <p class="post-slide__excerpt"><?php echo $excerpt; ?></p>
                            <?php endif; ?>
                            <a href="<?php echo get_the_permalink($post); ?>" class="cta post-slide__cta">
                                View More
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="post-slides__images--wrapper">
            <div class="post-slides post-slides__images">
                <?php foreach($posts as $post) : ?>
                    <div class="post-slide">
                        <div class="post-slide__img">
                            <?php if ($image = get_field('image', $post)): ?>
                                <img data-src="<?php echo $image; ?>" alt="<?php echo get_the_title($post); ?>" class="lazyload">
                            <?php endif; ?>
                            <?php if (get_field('show_date', $post) == true) : 
                                $date_string = get_field('date', $post); 
                                $date = DateTime::createFromFormat('Ymd', $date_string);
                                if ($date) : ?>
                                <div class="post-slide__date">
                                    <div class="post-slide__date--day">
                                        <?php echo $date->format('d'); ?>
                                    </div>
                                    <div class="post-slide__date--month">
                                        <?php echo $date->format('F'); ?>
                                    </div>
                                </div>
                            <?php endif;
                            endif; ?>
                            <?php if ($caption = get_field('date_description', $post)) : ?>
                                <h6 class="post-slide__caption"><?php echo $caption; ?></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>