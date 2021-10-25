<?php

/**
 * Media Content Tab Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'media-content-tab-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'media-content-tab';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if (have_rows('tabs')) : ?>
            <div class="media-content-tab__links">
                <?php while (have_rows('tabs')) : the_row(); 
                    $link = get_sub_field('link'); ?>
                    <a href="#media-content-tab__content--<?php echo get_row_index() ?>" 
                        class="media-content-tab__link <?php echo get_row_index()==1 ? 'active' : ''; ?>">
                        <?php echo $link; ?>
                    </a>
                <?php endwhile; ?>
            </div>
    <?php endif; ?>
    <?php if (have_rows('tabs')) : ?>
        <div class="media-content-tab__contents">
            <?php while (have_rows('tabs')) : the_row(); 
                $content = get_sub_field('content');
                $direction = $content['content_direction'];
                $image = $content['image'];
                $video = $content['video'];
                $heading = $content['heading'];
                $text = $content['text'];
                $cta = $content['cta']; ?>
                <div class="media-content-tab__content <?php echo get_row_index()==1 ? 'active' : ''; ?>"
                    id="media-content-tab__content--<?php echo get_row_index() ?>">
                    <div class="media-content 
                                <?php echo $direction == true ? 'media-content--left' : ''; ?>">
                        <div class="container">
                            <?php if ($image || $video) : ?>
                                <div class="media-content__media">
                                    <?php 
                                        get_template_part( 'templates/content-modules', 'image', array(
                                            'image' => $image,
                                            'video' => $video
                                        ) );
                                    ?>
                                </div>
                            <?php endif; ?>
                            <div class="media-content__content">
                                <?php if ($heading) : ?>
                                    <h2 class="media-content__title a-up"><?php echo $heading; ?></h2>
                                <?php endif; ?>
                                <?php if ($text) : ?>
                                    <div class="media-content__text a-up a-delay-1">
                                        <?php echo $text; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($cta) : ?>
                                    <a href="<?php echo $cta['url']; ?>" 
                                        class="btn btn--accent media-content__cta a-up a-delay-2" 
                                        target="<?php echo $cta['target']; ?>">
                                        <?php echo $cta['title']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>