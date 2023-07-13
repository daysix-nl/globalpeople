<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GlobalPeople
 */

?>


<!DOCTYPE html>
<html lang="en">
	<head>

		<!-- Site Meta  			=================================== -->

			<meta name="viewport" content="width=device-width, initial-scale=1.0 , maximum-scale=6, user-scalable=yes">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta http-equiv="expires" content="0">
			<meta http-equiv="cache-control" content="no-cache">
			<meta http-equiv="pragma" content="no-cache">
			<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
			<meta charset="utf-8">


		<!-- Site Scripts & styles  =================================== -->




<!-- 		<style type="text/css">
			
			#loader {
			    width: 100%;
			    height: 100%;
			    background: white;
			    z-index: 1999999999999;
			    position: fixed;
			    top: 0;
			    left: 0;
			}

		</style> -->
		
		<!-- font -->
		<script defer type="text/javascript">
			WebFontConfig = {
				google: { families: [ 'DM+Sans:400,500,700'] }
			};
			(function() {
				var wf = document.createElement('script');
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
				wf.type = 'text/javascript';
				wf.async = 'true';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(wf, s);
			})(); 
		</script>
	


	  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/libraries.css" media="screen">
	  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/animations.css" media="screen">
	  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/main.css?v=12" media="screen">
	  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/main2.css" media="screen">
	  	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/blog.css" media="screen">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/assets/css/query.css?v=12" media="screen">
		

		<link rel="icon" href="/wp-content/uploads/2021/01/global-favicon.svg" media="(prefers-color-scheme:no-preference)">
		<link rel="icon" href="/wp-content/uploads/2021/01/global-favicon-white.svg"  media="(prefers-color-scheme:dark)">
		<link rel="icon" href="/wp-content/uploads/2021/01/global-favicon.svg" media="(prefers-color-scheme:light)">

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-J2S6FG4S3M"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		 

		  gtag('config', 'G-J2S6FG4S3M');
		</script>
			
		<?php  wp_head(); ?>

		<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/a21adca52c75948df22dec3e1/8f04b306b3808dbdcfcac8462.js");</script>


  
	</head>


<body <?php body_class(); ?>>


<div id="loader"></div>




<section class="header <?php echo ($args['header_class'] ?? ''); ?>">

	<div class="container">
		<div class="header-flex">

			<div class="menu-wrapper">
			  	<div class="hamburger-menu"></div>	  
			</div>

			<div class="logo">
				<a href="/"> 
					<img 
						<?php if ( ($args['header_class'] ?? '') != "h_orange" &&  ($args['header_class'] ?? '') != "h_silver" &&  ($args['header_class'] ?? '') != "h_white" ) { echo 'style="filter:brightness(10)"';}?>
						src="<?=get_field('header_logo', 6)?>" 
						alt="GlobalPeople Logo"
					/> 

				</a>

			</div>

			<div class="menu">
 				<?php 

					wp_nav_menu(
						array(

							'theme_location' => 'header-menu',
							'container_class' => 'navbar',
							'menu_class' => 'menu-list'
						)
					);

				?>
			</div>

		</div>
	</div>
	
</section>


