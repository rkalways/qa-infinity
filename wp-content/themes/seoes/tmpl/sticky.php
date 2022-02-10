<?php 
	defined( 'ABSPATH' ) or die();
?>

<!-- #site-sticky -->
<div id="site-sticky" class="site-sticky <?php echo get_theme_mod('sticky_shadow') ? 'shadow' : '' ?>">
	<div class="container">
		<a href="<?php echo esc_url( home_url('') ) ?>">
			<?php seoes_logo('sticky_logotype', 'sticky_logo_dimensions', 'h3') ?>
		</a>
		<nav class="menu-main-container header_menu" itemscope="itemscope">
			<?php wp_nav_menu( main_menu_args() ) ?>
		</nav>
	</div>
</div>
<!-- /#site-sticky -->