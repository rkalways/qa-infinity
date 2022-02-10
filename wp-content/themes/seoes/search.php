<?php
defined( 'ABSPATH' ) or die();

global $wp_query;

$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
$index = 1 + ( ( $paged - 1 ) * $wp_query->query_vars['posts_per_page'] );
?>

	<?php get_header() ?>

		<?php if ( have_posts() ): ?>
			<div class="content blog_large" role="main" itemprop="mainContentOfPage">
				<div class="container">
					<?php get_search_form() ?>

					<?php 
						while ( have_posts() ): the_post(); 

						$extra_class = 'post';
					?>
						<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
							<div class="post-inner">
								<?php if( has_post_thumbnail() ): ?>
									<div class="post-media-wrapper">
										<!-- Featured Media -->
										<?php echo seoes__post_featured() ?>

										<!-- Post Date -->
										<?php seoes__post_date( '', 'complex' ) ?>
									</div>
								<?php endif; ?>

								<!-- Post Categories -->
								<?php seoes__post_category() ?>

								<!-- Post Title -->
								<?php seoes__post_title() ?>

								<!-- Post Content -->
								<?php if( !empty(seoes__the_content()) ) : ?>
									<!-- Post Content -->
									<div class="post-content">
										<?php echo seoes__the_content('180') ?>
									</div>
								<?php endif; ?>

								<!-- Post Meta -->
								<?php seoes__post_meta() ?>
							</div>
						</div>
					<?php endwhile ?>
				</div>
			</div>
			
			<?php seoes__pagination() ?>
		<?php else: ?>
			<div class="content">
				<div class="search-no-results">
					<h3><?php echo esc_html_x( 'Nothing Found', 'Search form', 'seoes' ) ?></h3>
					<p><?php echo esc_html_x( 'Sorry, no posts matched your criteria. Please try another search', 'Search form', 'seoes' ) ?></p>
					
					<p><?php echo esc_html_x( 'You might want to consider some of our suggestions to get better results:', 'Search form', 'seoes' ) ?></p>
					<ul>
						<li><?php echo esc_html_x( 'Check your spelling.', 'Search form', 'seoes' ) ?></li>
						<li><?php echo esc_html_x( 'Try a similar keyword, for example: tablet instead of laptop.', 'Search form', 'seoes' ) ?></li>
						<li><?php echo esc_html_x( 'Try using more than one keyword.', 'Search form', 'seoes' ) ?></li>
					</ul>
				</div>
				<?php get_search_form() ?>
			</div>
		<?php endif ?>

	<?php get_footer() ?>