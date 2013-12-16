<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36539941-1']);
  _gaq.push(['_setDomainName', 'atlantagoldandcoin.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Google Code for Contact Us Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 999276654;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "3W22CMri3wQQ7oC_3AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/999276654/?value=0&amp;label=3W22CMri3wQQ7oC_3AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- Google Code for Newsletter Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 999276654;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "PODnCMLj3wQQ7oC_3AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/999276654/?value=0&amp;label=PODnCMLj3wQQ7oC_3AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '', true, 'right' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<?php comments_popup_script(); ?> 
<meta name="ientry_id" content="a2debd6b73">
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="header">	
		<div id="masthead">
			
<div id="branding" role="banner">
<a href="http://atlantagoldandcoin.com" title="Homepage">
<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				
				
				<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="Atlanta Gold and Coin Buyers" /></a>
<div style="position:relative; text-align:right; z-index:10;"><p style="position:absolute; left:520px; top:45px; color:#D0CECE; font-size:26px;">

<a href="tel:404-236-9744" style="text-decoration:underline;color:#E6C247"><span style="color:#E6C247;font-size:36px;font-weight:bold;">404-236-9744</span></a>

<br /><br /><a style="color:#72A5DA;"href="mailto:sales@atlantagoldandcoin.com">sales@atlantagoldandcoin.com</a></div>						
					<?php endif; ?>

<!-- <?php if ( is_front_page() ) :
            echo get_bloginfo ( 'description' );
        endif;
?> -->

			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->


<!-- 
<?php
switch ($_SERVER['HTTP_HOST']) {
  case "atlantagoldandcoin.com":
    $output = "This is for atlantagoldandcoin.com";
    break;
  case "atlantagoldbuyers.com":
    $output = "This is for atlantagoldbuyers.com";
    break;
  case "example3.com":
    $output = "This is for example3.com";
    break;
}
print $output;
?>
-->
<?php if (is_front_page() || is_page( '702' )){ ?>

  <?php } ?>

		</div><!-- #masthead -->

	</div><!-- #header -->

	<div id="main"><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>