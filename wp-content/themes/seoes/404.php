<?php
defined( 'ABSPATH' ) or die();
?>

	<?php get_header() ?>
		<div class="content">
			<h1><?php echo esc_html_x( 'Sorry, Page Not Found', '404 Page', 'seoes' ) ?></h1>
			<div class="content-404">
				<?php echo esc_html_x( 'We looked everywhere for this page. Are you sure the website URL is correct? Get in touch with the site owner.', '404 Page', 'seoes' ) ?>
			</div>
			<a href="<?php echo esc_url(home_url( '/' )) ?>" class="rb_button"><?php echo esc_html_x( 'Go Back Home', '404 Page', 'seoes' ) ?></a>
		</div>
		<div class="image">
			<img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/404.png') ?>" alt="404" />
		</div>
		<!-- /.content-inner -->
	<?php get_footer() ?>
