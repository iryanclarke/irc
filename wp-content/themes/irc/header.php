<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package irc
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<script>document.documentElement.className = 'js';</script>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'irc' ); ?></a>

	<header>
		<div class="bottom-menu menu-container">
			<a href="/#hero" class="logo-link"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/dld-logo.svg" alt="irc logo" id="nav-logo" class="logo"></a>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<input type="checkbox" id="toggle-right">
				<label for="toggle-right" class="menu-toggle" style="z-index: 999;">
					<svg viewBox="0 0 800 600">
						<path d="M300,230 C300,230 520,230 540,230 C740,230 640,555 520,420 C440,340 300,200 300,200" id="top"></path>
				    <path d="M300,320 L540,320" id="middle"></path>
				    <path d="M300,230 C300,230 520,230 540,230 C740,230 640,550 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
				  </svg>
				</label>
				<div class="mobile-pullout">
					<div class="white-bottom"></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'header-center-menu' ) ); ?>
					<div class="header-right-menu">
						<a href="https://www.facebook.com/irc/">
			        <i class="fa fa-2x fa-facebook-square" aria-hidden="true"></i>
			      </a>
			      <a href="https://www.instagram.com/irc/">
			        <i class="fa fa-2x fa-instagram" aria-hidden="true"></i>
			      </a>
			      <a href="https://twitter.com/irc">
			        <i class="fa fa-2x fa-twitter-square" aria-hidden="true"></i>
			      </a>
					</div>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header>



	<div id="content" class="site-content">
