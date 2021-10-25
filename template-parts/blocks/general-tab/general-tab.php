<?php

/**
 * General Tab Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'general-tab-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tab general-tab';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <?php if( $heading = get_field( 'heading' ) ) : ?>
            <h2 class="general-tab__heading a-up"><?php echo $heading; ?></h2>
        <?php endif; ?>
        <?php if (have_rows('tab_links')) : ?>
        <div class="tab-links general-tab__links a-up a-delay-1">
            <?php while (have_rows('tab_links')) : the_row(); ?>
                <a href="#<?php echo esc_attr($id) . get_row_index(); ?>" 
                    class="tab-link general-tab__link <?php echo get_row_index() == 1 ? 'active' : ''; ?>">
                    <?php the_sub_field('text'); ?>
                </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <?php if (have_rows('tab_links')) : ?>
        <div class="tab-selects a-up a-delay-1">
            <select name="" id="" class="tab-slider__select tab-select">
            <?php while (have_rows('tab_links')) : the_row(); ?>
                <option value="#<?php echo esc_attr($id) . get_row_index(); ?>"><?php the_sub_field('text'); ?></option>
            <?php endwhile; ?>
            </select>
        </div>
        <?php endif; ?>
        <?php if (have_rows('tab_contents')) : ?>
            <div class="tab-contents general-tab__contents a-up a-delay-2">
                <?php while (have_rows('tab_contents')) : the_row(); ?>
                    <div class="tab-content general-tab__content <?php echo get_row_index() == 1 ? 'active' : ''; ?>" 
                        id="<?php echo esc_attr($id) . get_row_index(); ?>">
                        <?php if ($content = get_sub_field('content')) : ?>
                        <div class="general-tab__content--inner">
                            <?php echo $content; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>