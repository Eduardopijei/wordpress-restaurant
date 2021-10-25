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
$className = 'culinary-module culinary-module-grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
$more_culinary = get_field('more_culinary');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php 
        $terms = get_terms([
            'taxonomy'      => 'culinary_time',
            'hide_empty'    => false,
        ]);
        if ($terms) : ?>
        <div class="culinary-module__center a-up a-delay-3">
            <div class="culinary-module__filters">
                <?php foreach ($terms as $term) : ?>
                    <?php 
                        $image = get_field('image', 'culinary_time' . '_' . $term->term_id); 
                        $img_src = $image['sizes']['taxonomy-image'];
                        ?>
                    <a href="#" class="cta cta-reverse culinary-module__filter" 
                        data-id="<?php echo $term->term_id; ?>"
                        data-filter=".<?php echo $term->slug; ?>">
                        <?php echo $term->name; ?>
                    </a>
                <?php endforeach; ?>
                <a href="#" class="cta cta-reverse culinary-module__filter" 
                    data-filter="">
                    See All
                </a>
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
        <?php 
        $args = array(
            'post_type'             => 'culinary',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => true,
            'posts_per_page'        => -1
        ); 
        $query = new WP_Query($args);
        if ($query->have_posts()) : ?>
        <div class="culinary-module__grid">
            <?php while ($query->have_posts()) : $query->the_post(); 
                get_template_part('templates/loop', 'culinary');
            endwhile; ?>
            <div class="loop-culinary-more<?php echo ($query->post_count % 2 == 1) ? ' half' : ''; ?>">
                <?php if ($more_culinary['heading']) : ?>
                    <h2 class="loop-culinary-more__heading a-up"><?php echo $more_culinary['heading']; ?></h2>
                <?php endif; ?>
                <?php if ($more_culinary['content']) : ?>
                    <div class="loop-culinary-more__content a-up a-delay-1">
                        <?php echo $more_culinary['content']; ?>
                    </div>
                <?php endif; ?>
                <?php if ($more_culinary['cta']) : ?>
                    <a href="<?php echo $more_culinary['cta']['url']; ?>" 
                        class="btn btn--accent loop-culinary-more__cta a-up a-delay-2">
                        <?php echo $more_culinary['cta']['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif;
        wp_reset_query(  ); ?>
    </div>
</section>