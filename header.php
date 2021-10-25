<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
	
	
	<?php 
	wp_head(); 
	?>
</head>

<body <?php body_class(); ?>>
	<!-- Begin Header  -->
	<?php $headerStyle = get_field( 'header_style' ); ?>
	<header class="header <?php echo 'header--' . $headerStyle; ?>">
		<nav class="header-nav">
			<button class="hamburger" type="button" tab-index="0" aria-label="Menu" role="button" aria-controls="navigation">
				<span></span>
				<span></span>
			</button>
			<?php 
			$logo = $headerStyle == 'dark' ? get_field('logo_dark', 'options') : get_field('logo', 'options'); 
			$logo_alt = $headerStyle == 'dark' ? get_field('logo', 'options') : get_field('logo_dark', 'options'); 
			$logo_scroll = get_field('logo_scroll', 'options');
			$logo_scroll_dark = get_field('logo_scroll_dark', 'options');
			?>
			<a href="<?php echo esc_url(home_url()); ?>" class="logo-link">
				<?php if ($logo) : ?>
					<img class="header-logo" src="<?php echo $logo; ?>" data-src-alt="<?php echo $logo_alt; ?>" alt="Madrona">
				<?php endif; ?>
				<?php if ($logo_scroll_dark) : ?>
					<img class="header-logo__scroll" src="<?php echo $logo_scroll_dark; ?>" alt="Madrona">
				<?php endif; ?>
				<?php if ($logo_scroll) : ?>
					<img class="header-logo__scroll--white" src="<?php echo $logo_scroll; ?>" alt="Madrona">
				<?php endif; ?>
				<?php if( $logo_mobile = get_field( 'logo_mobile', 'options' ) ) : ?>
					<img src="<?php echo $logo_mobile; ?>" alt="Madrona" class="header-logo__mobile">
				<?php endif; ?>
				<?php 
				$logo_mobile_dark = get_field( 'logo_mobile_dark', 'options' );
				if( $logo_mobile_dark && $headerStyle == 'room' ) : ?>
					<img src="<?php echo $logo_mobile_dark; ?>" alt="Madrona" class="header-logo__mobile--dark">
				<?php endif; ?>
			</a>
			<?php 
			wp_nav_menu( array(
				'menu' => 'Main Menu',
				'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
				'container'       => 'div',
				'container_class' => 'main-menu__wrapper',
				'menu_class'      => 'header-nav__menus',
				'fallback_cb'     => false,
				'walker'          => new WP_Bootstrap_Navwalker(),
			) );
			?>
			<button class="btn btn--accent header-cta btn-modal" data-target="#modal-booking">
				Check Availability
			</button>
			<button class="booking-popup__close">
				<svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<line x1="24.954" y1="24.0137" x2="1.47088" y2="0.530568" stroke="black" stroke-width="1.5"/>
					<line x1="1.46967" y1="24.4706" x2="24.9528" y2="0.987486" stroke="black" stroke-width="1.5"/>
				</svg>
			</button>
			<button class="btn header-cta--mobile btn-modal" data-target="#modal-booking">
				CHECK AVAILABILITY
			</button>
		</nav>
		<div class="header-menu" id="main-nav">
			<div class="header-menu__top">
				<button class="hamburger-close">
					<svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<line x1="29.5771" y1="30.9913" x2="1.2928" y2="2.70702" stroke="black" stroke-width="2"/>
						<line x1="1.29289" y1="29.5771" x2="29.5772" y2="1.2928" stroke="black" stroke-width="2"/>
					</svg>
				</button>
				<?php if ($logo_scroll_dark) : ?>
				<div class="divider"></div>
				<a href="<?php echo esc_url(home_url()); ?>" class="logo-link">
					<img class="header-logo--scroll" src="<?php echo $logo_scroll_dark; ?>" alt="Madrona">
				</a>
				<?php endif; ?>
			</div>
			<?php 
			wp_nav_menu( array(
				'menu' => 'Mobile Menu',
				'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
				'container'       => 'div',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => false,
				'walker'          => new WP_Bootstrap_Navwalker(),
			) );
			?>
		</div>
	</header>
	<!-- End Header -->
	<!-- Begin Main -->
	<main id="main" class="<?php echo (get_field('is_fullpage') == true) ? 'no-padding' : ''; ?>">