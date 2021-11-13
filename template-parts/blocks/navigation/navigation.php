<?php

/**
 * Navigation Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = get_field('id') ? get_field('id') : 'navigation-block-' . $block['id'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'secondary-nav navigation-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
?>
<?php if( have_rows( 'links' ) ) : ?>
    <nav class="<?php echo $className; ?>" id="<?php echo $id; ?>">
        <div class="secondary-nav__mobile">
            <select name="" id="" class="secondary-nav__select">
                <?php while( have_rows( 'links' ) ) : the_row(); 
                    $link = get_sub_field( 'link' ); ?>
                    <option value="<?php echo $link['url']; ?>">
                        <?php echo $link['title']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <ul class="secondary-nav__desktop">
            <?php 
            $count = count( get_field( 'links' ) );
            while( have_rows( 'links' ) ) : the_row(); 
                $link = get_sub_field( 'link' ); ?>
                <?php if( get_row_index() == $count ): ?>
                    <li class="secondary-nav__item">
                        <span class="separater"></span>
                    </li>
                <?php endif; ?>
                <li class="secondary-nav__item">
                    <a href="<?php echo $link['url']; ?>" class="scroll-link secondary-nav__link">
                        <?php echo $link['title']; ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>
<?php endif; ?>
