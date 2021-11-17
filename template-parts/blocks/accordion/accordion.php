<?php

/**
 * Custom Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'accordions-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordions';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$heading = get_field('heading');
$heading_tag = get_field( 'heading_tag' ) ?: 'h3';
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<div class="container">
    <?php if ($heading) : ?>
        <<?php echo $heading_tag; ?> class="accordions-heading a-up"><?php echo $heading; ?></<?php echo $heading_tag; ?>>
    <?php endif; ?>
    <?php if (have_rows('accordions')) : ?>
        <?php while (have_rows('accordions')) : the_row(); ?>
            <div class="accordion a-up">
                <?php if ($title = get_sub_field('title')) : ?>
                    <div class="accordion-title"><?php echo $title; ?></div>
                <?php endif; ?>
                <div class="accordion-content">
                    <div class="accordion-content__inner">
                        <?php echo the_sub_field( 'content' ); ?>
                    </div>
                    <?php if( have_rows( 'menu_content' ) ): 
                    while( have_rows( 'menu_content' ) ): the_row(); 
                        if( have_rows( 'columns' ) ): ?>
                            <div class="accordion-content__menu">
                                <?php while( have_rows( 'columns' ) ): the_row(); ?>
                                    <div class="col">
                                        <?php if( have_rows( 'menus' ) ): 
                                        while( have_rows( 'menus' ) ): the_row(); ?>
                                            <div class="accordion-menu">
                                                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'title', 't' => 'h6', 'tc' => 'accordion-menu__title' ) ); ?>
                                                <?php if( have_rows( 'menu' ) ): ?>
                                                    <div class="accordion-menu__list">
                                                        <?php while( have_rows( 'menu' ) ): the_row(); ?>
                                                            <div class="accordion-menu__content">
                                                                <div class="accordion-menu__content--header">
                                                                    <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'name', 't' => 'p', 'tc' => 'accordion-menu__content--name' ) ); ?> 
                                                                    <?php if( $price = get_sub_field( 'price' ) ): ?>
                                                                        <p class="accordion-menu__content--price">$<?php echo number_format( floatval( $price ), 2 ); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 't' => 'p', 'tc' => 'accordion-menu__content--desc' ) ); ?> 
                                                            </div>
                                                        <?php endwhile; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; 
                                        endif; ?>
                                        <?php get_template_part_args( 'templates/content-module-text', array( 'v' => 'description', 't' => 'div', 'tc' => 'col-desc' ) ); ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif;
                        endwhile;
                    endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
</section>