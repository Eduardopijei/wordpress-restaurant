<?php

/**
 * Culinary Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'culinary-module-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'culinary-module';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$heading = get_field('heading');
$subheading = get_field('subheading');
$text = get_field('content');
$cta = get_field('cta');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="culinary-module__top">
            <?php if ($heading) : ?>
                <h2 class="culinary-module__heading a-up"><?php echo $heading; ?></h2>
            <?php endif; ?>
            <div class="culinary-module__content">
                <?php if ($subheading) : ?>
                    <h6 class="culinary-module__subheading a-up a-delay-1"><?php echo $subheading; ?></h6>
                <?php endif; ?>
                <?php if ($text) : ?>
                    <p class="culinary-module__text a-up a-delay-2">
                        <?php echo $text; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <?php 
        $terms = get_terms([
            'taxonomy'      => 'culinary_time',
            'hide_empty'    => false,
        ]);
        if ($terms) : ?>
        <div class="culinary-module__center a-up a-delay-3">
            <div class="culinary-module__filters">
                <?php foreach ($terms as $term) : ?>
                    <a href="#" class="cta cta-reverse culinary-module__filter" 
                        data-id="<?php echo $term->term_id; ?>"
                        data-filter=".<?php echo $term->slug; ?>"
                        data-image="<?php echo $img_src; ?>">
                        <?php echo $term->name; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="culinary-module__selector">
                <select class="culinary-module__select" jcf>
                    <option value="">Choose A Time</option>
                    <?php foreach ($terms as $term) : ?>
                        <option value=".<?php echo $term->slug; ?>">
                            <?php echo $term->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php 
    $args = array(
        'post_type'         => 'culinary',
        'post_status'       => 'publish',
        'posts_per_page'    => -1
    ); 
    $query = new WP_Query($args);
    if ($query->have_posts()) : ?>
    <div class="culinary-module__slider">
        <?php while ($query->have_posts()) : $query->the_post(); 
            get_template_part('templates/loop', 'culinary', array( 'is_home_module' => true ));
        endwhile; ?>
    </div>
    <?php endif;
    wp_reset_query(  ); ?>
    <div class="container culinary-module__btn--wrapper">
        <?php if ($cta) : ?>
            <a href="<?php echo $cta['url']; ?>" 
                class="btn btn--accent culinary-module__btn a-up a-delay-2" 
                target="<?php echo $cta['target']; ?>">
                <?php echo $cta['title']; ?>
            </a>
        <?php endif; ?>
    </div>
</section>