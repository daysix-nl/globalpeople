<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package GlobalPeople
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header container " style="padding: 100px 0; text-align: center;">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'globalpeople' ); ?></h1>
			</header><!-- .page-header -->

		</section>

	</main><!-- #main -->

<?php
get_footer();
