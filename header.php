<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Courtyard
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site container">
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="site-logo">
				<a href="/">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="128.027" height="53.766" viewBox="0 0 128.027 53.766" enable-background="new 0 0 128.027 53.766" xml:space="preserve"><polygon points="0,53.486 0,29.308 5.919,29.308 8.671,45.75 8.72,45.75 11.643,29.308 17.367,29.308 17.367,53.486 13.787,53.486   13.787,34.833 13.738,34.833 10.352,53.486 6.845,53.486 3.629,34.833 3.581,34.833 3.581,53.486 "></polygon><rect x="20.662" y="29.308" width="3.678" height="24.179"></rect><polygon points="37.659,29.308 37.659,33.326 33.567,33.326 33.567,53.486 29.889,53.486 29.889,33.326 25.797,33.326   25.797,29.308 "></polygon><polygon points="40.547,53.43 40.547,29.249 42.691,29.249 42.691,51.621 50.695,51.621 50.695,53.43 "></polygon><path d="M52.535 36.517h2.01V53.43h-2.01V36.517zM52.3 29.249h2.478v2.545H52.3V29.249z"></path><path d="M57.154 53.431c0.101-0.57 0.201-1.106 0.201-1.676V29.249h2.01v9.176l0.067 0.067c1.037-1.606 2.377-2.311 4.286-2.311 5.493 0 5.058 5.761 5.058 8.774 0 3.719-0.301 8.81-5.225 8.81 -1.976 0-3.416-0.804-4.253-2.378h-0.067v2.043H57.154zM62.948 52.157c3.718 0 3.818-3.182 3.818-7.134s-0.101-7.233-3.818-7.233c-3.249 0-3.65 4.387-3.65 6.933C59.298 47.401 59.298 52.157 62.948 52.157"></path><path d="M72.79 38.794h0.066c0.838-1.607 2.613-2.611 4.656-2.611v2.043c-2.847-0.235-4.723 1.474-4.723 4.319v10.886h-2.01V36.517h2.01V38.794z"></path><path d="M86.852 51.353h-0.067c-1.072 1.608-2.713 2.412-4.789 2.412 -3.015 0-4.656-2.043-4.656-4.99 0-5.929 5.963-5.325 9.377-5.592v-1.408c0-2.478-0.735-3.985-3.414-3.985 -1.844 0-3.317 0.905-3.317 2.914h-2.144c0.168-3.249 2.68-4.521 5.627-4.521 1.709 0 5.259 0.166 5.259 4.487v8.507c0 1.205 0 2.277 0.2 4.254h-2.075V51.353zM86.716 44.789c-2.879 0.101-7.233-0.233-7.233 3.885 0 1.909 0.972 3.483 3.048 3.483 2.311 0 4.186-2.076 4.186-4.287V44.789z"></path><path d="M93.61 38.794h0.067c0.839-1.607 2.613-2.611 4.656-2.611v2.043c-2.847-0.235-4.724 1.474-4.724 4.319v10.886h-2.01V36.517h2.01V38.794z"></path><path d="M99.936 36.517h2.009V53.43h-2.009V36.517zM99.7 29.249h2.479v2.545H99.7V29.249z"></path><path d="M106.765 45.393v1.306c0 2.344 0.637 5.459 3.818 5.459 2.512 0 3.752-1.607 3.719-3.885h2.109c-0.234 4.086-2.445 5.492-5.828 5.492 -2.914 0-5.827-1.172-5.827-6.296v-4.153c0-4.89 2.043-7.134 5.827-7.134 5.828 0 5.828 4.187 5.828 9.211H106.765zM114.401 43.784c0-3.751-0.603-5.994-3.818-5.994 -3.215 0-3.818 2.243-3.818 5.994H114.401z"></path><path d="M123.038 53.765c-3.651 0-5.092-1.774-5.058-5.358h2.043c0 2.312 0.535 3.852 3.114 3.852 1.943 0 2.88-1.104 2.88-2.981 0-4.42-7.603-3.281-7.603-8.875 0-3.114 2.144-4.219 5.092-4.219 3.349 0 4.42 2.311 4.42 4.889h-1.977c-0.1-2.144-0.67-3.282-2.947-3.282 -1.439 0-2.578 0.938-2.578 2.444 0 4.221 7.603 3.082 7.603 8.742C128.027 52.157 126.186 53.765 123.038 53.765"></path><path class="arch" fill-rule="evenodd" clip-rule="evenodd" d="M121.487 19.746c-33.822-10.8-82.05-10.8-115.805 0C36.39 3.176 90.661 3.176 121.487 19.746"></path><path class="arch" fill-rule="evenodd" clip-rule="evenodd" d="M105.419 8.979c-24.436-7.803-59.282-7.803-83.67 0C43.936-2.993 83.147-2.993 105.419 8.979"></path></svg>
				</a>
			</div>
			<?php if ( is_front_page() || is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_attr_e( 'Skip to content', 'courtyard' ); ?></a>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
                    <span class="sr-only"><?php esc_attr_e( 'Toggle navigation', 'courtyard' ); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#">Brand</a>-->
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-main">
	            <ul class="nav navbar-nav">
		            <?php if ( has_nav_menu( 'primary' ) ) :
			            wp_nav_menu( array(
		                        'theme_location'  => 'primary',
		                        'container'       => false,
		                        // 'menu_class'      => 'nav navbar-nav',//  'nav navbar-right'
		                        'walker'          => new Bootstrap_Nav_Menu(),
		                        'fallback_cb'     => null,
				                'items_wrap'      => '%3$s',// Skip the containing <ul>.
		                    )
		                );
	                else :
		                wp_list_pages( array(
				                'menu_class'      => 'nav navbar-nav',// 'nav navbar-right'
				                'walker'          => new Bootstrap_Page_Menu(),
				                'title_li'        => null,
			                )
		                );
		            endif; ?>
	            </ul>
	            <?php get_search_form(); ?>
            </div><!-- /.navbar-collapse -->

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
