<?php
// Custom ACF Blocks
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Register Hero Block
        acf_register_block_type(array(
            'name'              => 'home_hero',
            'title'             => __('Home Hero'),
            'description'       => __('Home Hero'),
            'render_template'   => 'template-parts/blocks/home-hero/home-hero.php',
            'category'          => 'boston-blocks',
            'icon'              => 'cover-image',
            'keywords'          => array( 'hero', 'image', 'video' ),
        ));

        // Register Responsive Spacer Block
        acf_register_block_type(array(
            'name'              => 'responsive_spacer',
            'title'             => __('Responsive Spacer'),
            'description'       => __('Responsive Spacer'),
            'render_template'   => 'template-parts/blocks/responsive-spacer/responsive-spacer.php',
            'category'          => 'boston-blocks',
            'icon'              => 'image-flip-vertical',
            'keywords'          => array( 'responsive', 'spacer' ),
        ));
        
        // Register Media Content Two Images Block
        acf_register_block_type(array(
            'name'              => 'media_content_two_images',
            'title'             => __('Media Content Two Images'),
            'description'       => __('Media Content Two Images'),
            'render_template'   => 'template-parts/blocks/media-content-two-images/media-content-two-images.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'media', 'content', 'two', 'images' ),
        ));

        // Register Content Background Block
        acf_register_block_type(array(
            'name'              => 'content_background',
            'title'             => __('Content Background'),
            'description'       => __('Content Background'),
            'render_template'   => 'template-parts/blocks/content-background/content-background.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-image',
            'keywords'          => array( 'content', 'background' ),
        ));

        // Register Two Columns Alt
        acf_register_block_type(array(
            'name'              => 'two_columns_alt',
            'title'             => __('Two Columns Alt'),
            'description'       => __('Two Columns Alt'),
            'render_template'   => 'template-parts/blocks/two-columns-alt/two-columns-alt.php',
            'category'          => 'boston-blocks',
            'icon'              => 'columns',
            'keywords'          => array( 'two', 'columns' ),
        ));

        // Register Two Columns Alt
        acf_register_block_type(array(
            'name'              => 'boston_module',
            'title'             => __('Boston'),
            'description'       => __('Boston'),
            'render_template'   => 'template-parts/blocks/boston/boston.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-right',
            'keywords'          => array( 'boston' ),
        ));
        
        // Register Media Content Block
        acf_register_block_type(array(
            'name'              => 'media_content',
            'title'             => __('Media Content'),
            'description'       => __('Media Content'),
            'render_template'   => 'template-parts/blocks/media-content/media-content.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'media', 'content' ),
        ));
        
        // Register Custom Wysiwig Block
        acf_register_block_type(array(
            'name'              => 'custom_wysiwig',
            'title'             => __('Wysiwig'),
            'description'       => __('Wysiwig'),
            'render_template'   => 'template-parts/blocks/custom-wysiwig/custom-wysiwig.php',
            'category'          => 'boston-blocks',
            'icon'              => 'media-text',
            'keywords'          => array( 'wysiwig' ),
        ));

        // Register Two Columns Block
        acf_register_block_type(array(
            'name'              => 'two_columns',
            'title'             => __('Two Columns'),
            'description'       => __('Two Columns'),
            'render_template'   => 'template-parts/blocks/two-columns/two-columns.php',
            'category'          => 'boston-blocks',
            'icon'              => 'columns',
            'keywords'          => array( 'two columns' ),
        ));

        // Contact Form Block
        acf_register_block_type(array(
            'name'              => 'contact_form',
            'title'             => __('Contact form'),
            'description'       => __('Contact form'),
            'render_template'   => 'template-parts/blocks/contact-form/contact-form.php',
            'category'          => 'boston-blocks',
            'icon'              => 'forms',
            'keywords'          => array( 'contact form' ),
        ));
        
        // Register Accordion Block
        acf_register_block_type(array(
            'name'              => 'accordion',
            'title'             => __('Accordion'),
            'description'       => __('Accordion'),
            'render_template'   => 'template-parts/blocks/accordion/accordion.php',
            'category'          => 'boston-blocks',
            'icon'              => 'list-view',
            'keywords'          => array( 'accordion' ),
        ));

        // Register Slider Block
        acf_register_block_type(array(
            'name'              => 'slider',
            'title'             => __('Slider'),
            'description'       => __('Slider'),
            'render_template'   => 'template-parts/blocks/slider/slider.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'slides' ),
        ));

        // Offers
        acf_register_block_type(array(
            'name'              => 'offers',
            'title'             => __('Offers'),
            'description'       => __('Offers'),
            'render_template'   => 'template-parts/blocks/offers/offers.php',
            'category'          => 'boston-blocks',
            'icon'              => 'media-text',
            'keywords'          => array( 'offers' ),
        ));

        // Culinary
        acf_register_block_type(array(
            'name'              => 'culinary',
            'title'             => __('Culinary'),
            'description'       => __('Culinary'),
            'render_template'   => 'template-parts/blocks/culinary/culinary.php',
            'category'          => 'boston-blocks',
            'icon'              => 'food',
            'keywords'          => array( 'culinary' ),
        ));

        
        // Rooms Hero
        acf_register_block_type(array( 
            'name'              => 'rooms_hero',
            'title'             => __('Rooms Hero'),
            'description'       => __('Rooms Hero'),
            'render_template'   => 'template-parts/blocks/rooms-hero/rooms-hero.php',
            'category'          => 'boston-blocks',
            'icon'              => 'cover-image',
            'keywords'          => array( 'rooms', 'hero'),
        ));

        // Three Columns Block
        acf_register_block_type(array( 
            'name'              => 'three_columns',
            'title'             => __('Three Columns'),
            'description'       => __('Three Columns'),
            'render_template'   => 'template-parts/blocks/three-columns/three-columns.php',
            'category'          => 'boston-blocks',
            'icon'              => 'menu-alt3',
            'keywords'          => array( 'three', 'column'),
        ));
        
        // Navigation
        acf_register_block_type(array( 
            'name'              => 'navigation',
            'title'             => __('Navigation'),
            'description'       => __('Navigation'),
            'render_template'   => 'template-parts/blocks/navigation/navigation.php',
            'category'          => 'boston-blocks',
            'icon'              => 'menu',
            'keywords'          => array( 'navigation' ),
        ));

        // Rooms Carousel
        acf_register_block_type(array( 
            'name'              => 'rooms_carousel',
            'title'             => __('Rooms Carousel'),
            'description'       => __('Rooms Carousel'),
            'render_template'   => 'template-parts/blocks/rooms-carousel/rooms-carousel.php',
            'category'          => 'boston-blocks',
            'icon'              => 'building',
            'keywords'          => array( 'rooms', 'carousel'),
        ));

        // Tab Slider Block
        acf_register_block_type(array(
            'name'              => 'tab_slider',
            'title'             => __('Tab Slider'),
            'description'       => __('Tab Slider'),
            'render_template'   => 'template-parts/blocks/tab-slider/tab-slider.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'tab', 'slider', 'tab slider' ),
        ));

        // Rooms Module Block
        acf_register_block_type(array(
            'name'              => 'rooms_module',
            'title'             => __('Rooms Module'),
            'description'       => __('Rooms Module'),
            'render_template'   => 'template-parts/blocks/rooms-module/rooms-module.php',
            'category'          => 'boston-blocks',
            'icon'              => 'building',
            'keywords'          => array( 'rooms' ),
        ));

        
        // Gallery Hero 
        acf_register_block_type(array( 
            'name'              => 'gallery_hero',
            'title'             => __('Gallery Hero'),
            'description'       => __('Gallery Hero'),
            'render_template'   => 'template-parts/blocks/gallery-hero/gallery-hero.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'gallery', 'hero' ),
        ));

        // Single room booking
        acf_register_block_type(array( 
            'name'              => 'single_room_booking',
            'title'             => __('Single Room Booking'),
            'description'       => __('Single Room Booking'),
            'render_template'   => 'template-parts/blocks/single-room-booking/single-room-booking.php',
            'category'          => 'boston-blocks',
            'icon'              => 'tickets',
            'keywords'          => array( 'single', 'room', 'booking' ),
        ));

        // Amentities
        acf_register_block_type(array( 
            'name'              => 'amentities',
            'title'             => __('Amentities'),
            'description'       => __('Amentities'),
            'render_template'   => 'template-parts/blocks/amentities/amentities.php',
            'category'          => 'boston-blocks',
            'icon'              => 'info',
            'keywords'          => array( 'amentities' ),
        ));

        // Two Cards
        acf_register_block_type(array( 
            'name'              => 'two_cards',
            'title'             => __('Two Image Cards'),
            'description'       => __('Two Image Cards'),
            'render_template'   => 'template-parts/blocks/two-cards/two-cards.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-image',
            'keywords'          => array( 'two', 'cards' ),
        ));

        // Three Cards
        acf_register_block_type(array( 
            'name'              => 'three_cards',
            'title'             => __('Three Image Cards'),
            'description'       => __('Three Image Cards'),
            'render_template'   => 'template-parts/blocks/three-cards/three-cards.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-image',
            'keywords'          => array( 'three', 'cards' ),
        ));

        // Register Custom Blockquote Block
        acf_register_block_type(array(
            'name'              => 'custom_blockquote',
            'title'             => __('Blockquote'),
            'description'       => __('Blockquote'),
            'render_template'   => 'template-parts/blocks/custom-blockquote/custom-blockquote.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-quote',
            'keywords'          => array( 'quote' ),
        ));

        // Culinary Banner
        acf_register_block_type(array( 
            'name'              => 'culinary_banner',
            'title'             => __('Culinary Banner'),
            'description'       => __('Culinary Banner'),
            'render_template'   => 'template-parts/blocks/culinary-banner/culinary-banner.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'culinary', 'tab' ),
        ));

        // Culinary Grid
        acf_register_block_type(array( 
            'name'              => 'culinary_grid',
            'title'             => __('Culinary Grid'),
            'description'       => __('Culinary Grid'),
            'render_template'   => 'template-parts/blocks/culinary-grid/culinary-grid.php',
            'category'          => 'boston-blocks',
            'icon'              => 'food',
            'keywords'          => array( 'culinary', 'grid'),
        ));

        // Events & Experiences
        acf_register_block_type(array( 
            'name'              => 'events_experiences',
            'title'             => __('Events Experiences'),
            'description'       => __('Events Experiences'),
            'render_template'   => 'template-parts/blocks/events-experiences/events-experiences.php',
            'category'          => 'boston-blocks',
            'icon'              => 'columns',
            'keywords'          => array( 'events', 'experiences'),
        ));

        // Chef
        acf_register_block_type(array( 
            'name'              => 'chef',
            'title'             => __('Chef'),
            'description'       => __('Chef'),
            'render_template'   => 'template-parts/blocks/chef/chef.php',
            'category'          => 'boston-blocks',
            'icon'              => 'food',
            'keywords'          => array( 'chef'),
        ));

        // Culinary Hero
        acf_register_block_type(array( 
            'name'              => 'culinary_hero',
            'title'             => __('Culinary Hero'),
            'description'       => __('Culinary Hero'),
            'render_template'   => 'template-parts/blocks/culinary-hero/culinary-hero.php',
            'category'          => 'boston-blocks',
            'icon'              => 'cover-image',
            'keywords'          => array( 'culinary', 'hero'),
        ));
        
        // Culinary Detail
        acf_register_block_type(array( 
            'name'              => 'culinary_detail',
            'title'             => __('Culinary Detail'),
            'description'       => __('Culinary Detail'),
            'render_template'   => 'template-parts/blocks/culinary-detail/culinary-detail.php',
            'category'          => 'waldorf-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'culinary', 'detail' ),
        ));
        
        // Culinary Form
        acf_register_block_type(array( 
            'name'              => 'culinary_form',
            'title'             => __('Culinary Form'),
            'description'       => __('Culinary Form'),
            'render_template'   => 'template-parts/blocks/culinary-form/culinary-form.php',
            'category'          => 'waldorf-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'culinary', 'form' ),
        ));

        // Blog More
        acf_register_block_type(array( 
            'name'              => 'blog_more',
            'title'             => __('Blog More'),
            'description'       => __('Blog More'),
            'render_template'   => 'template-parts/blocks/blog-more/blog-more.php',
            'category'          => 'waldorf-blocks',
            'icon'              => 'admin-post',
            'keywords'          => array( 'blog', 'more' ),
        ));
        /*********************************** ****************************************/

        // Register Title Text Block
        acf_register_block_type(array(
            'name'              => 'title_text',
            'title'             => __('Title Text'),
            'description'       => __('Title Text'),
            'render_template'   => 'template-parts/blocks/title-text/title-text.php',
            'category'          => 'boston-blocks',
            'icon'              => 'heading',
            'keywords'          => array( 'title', 'text' ),
        ));
        

        // Register Custom Image Block
        acf_register_block_type(array(
            'name'              => 'custom_media',
            'title'             => __('Media'),
            'description'       => __('Media'),
            'render_template'   => 'template-parts/blocks/custom-media/custom-media.php',
            'category'          => 'boston-blocks',
            'icon'              => 'format-image',
            'keywords'          => array( 'media' ),
        ));

        // Post Slider Block
        acf_register_block_type(array(
            'name'              => 'post_slider',
            'title'             => __('Post Slider'),
            'description'       => __('Post Slider'),
            'render_template'   => 'template-parts/blocks/post-slider/post-slider.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'post', 'slider', 'post slider' ),
        ));

        // General Tab Block
        acf_register_block_type(array(
            'name'              => 'general_tab',
            'title'             => __('General Tab'),
            'description'       => __('General Tab'),
            'render_template'   => 'template-parts/blocks/general-tab/general-tab.php',
            'category'          => 'boston-blocks',
            'icon'              => 'admin-page',
            'keywords'          => array( 'tab', 'general', 'general tab' ),
        ));

        // Hover Carousel
        acf_register_block_type(array(
            'name'              => 'hover_carousel',
            'title'             => __('Hover Carousel'),
            'description'       => __('Hover Carousel'),
            'render_template'   => 'template-parts/blocks/hover-carousel/hover-carousel.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'hover', 'carousel'),
        ));

        // Media Content Spa
        acf_register_block_type(array(
            'name'              => 'media_content_spa',
            'title'             => __('Media Content Spa'),
            'description'       => __('Media Content Spa'),
            'render_template'   => 'template-parts/blocks/media-content-spa/media-content-spa.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'media', 'content', 'spa'),
        ));

        // Experience Gallery
        acf_register_block_type(array(
            'name'              => 'experience_gallery',
            'title'             => __('Experience Gallery'),
            'description'       => __('Experience Gallery'),
            'render_template'   => 'template-parts/blocks/experience-gallery/experience-gallery.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'experience', 'gallery'),
        ));

        // General Hero
        acf_register_block_type(array(
            'name'              => 'general_hero',
            'title'             => __('General Hero'),
            'description'       => __('General Hero'),
            'render_template'   => 'template-parts/blocks/general-hero/general-hero.php',
            'category'          => 'boston-blocks',
            'icon'              => 'cover-image',
            'keywords'          => array( 'hero' ),
        ));

        // Media Content Tab
        acf_register_block_type(array(
            'name'              => 'media_content_tab',
            'title'             => __('Media Content Tab'),
            'description'       => __('Media Content Tab'),
            'render_template'   => 'template-parts/blocks/media-content-tab/media-content-tab.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-left',
            'keywords'          => array( 'media', 'content', 'tab'),
        ));


        // Hover Carousel Alt
        acf_register_block_type(array( 
            'name'              => 'hover_carousel_alt',
            'title'             => __('Hover Carousel Alt'),
            'description'       => __('Hover Carousel Alt'),
            'render_template'   => 'template-parts/blocks/hover-carousel-alt/hover-carousel-alt.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'hover', 'carousel'),
        ));

        // Post
        acf_register_block_type(array( 
            'name'              => 'media-content-post',
            'title'             => __('Media Content Post'),
            'description'       => __('Media Content Post'),
            'render_template'   => 'template-parts/blocks/media-content-post/media-content-post.php',
            'category'          => 'boston-blocks',
            'icon'              => 'align-pull-right',
            'keywords'          => array( 'media', 'content', 'post'),
        ));

        // People Slider
        acf_register_block_type(array( 
            'name'              => 'people_slider',
            'title'             => __('People Slider'),
            'description'       => __('People Slider'),
            'render_template'   => 'template-parts/blocks/people-slider/people-slider.php',
            'category'          => 'boston-blocks',
            'icon'              => 'slides',
            'keywords'          => array( 'people', 'slider'),
        ));

        // Post Two Columns
        acf_register_block_type(array( 
            'name'              => 'post_two_cols',
            'title'             => __('Post Two Columns'),
            'description'       => __('Post Two Columns'),
            'render_template'   => 'template-parts/blocks/post-two-cols/post-two-cols.php',
            'category'          => 'boston-blocks',
            'icon'              => 'embed-post',
            'keywords'          => array( 'post', 'two'),
        ));

        // Page 
        acf_register_block_type(array( 
            'name'              => 'page_block',
            'title'             => __('Page Block'),
            'description'       => __('Page Block'),
            'render_template'   => 'template-parts/blocks/page-block/page-block.php',
            'category'          => 'boston-blocks',
            'icon'              => 'admin-page',
            'keywords'          => array( 'page' ),
        ));
    }
}


function custom_block_categories( $categories ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'boston-blocks',
				'title' => 'boston Blocks',
			],
		]
	);
}
add_action( 'block_categories', 'custom_block_categories', 10, 2 );