<?php
defined( 'ABSPATH' ) or die();
?>
	
	<div class="content blog_large" role="main" itemprop="mainContentOfPage">
		<?php if ( have_posts() ): ?>
			<?php 
				while ( have_posts() ): the_post();

				$extra_class = 'post';

				if( ( get_post_format() == 'link' || get_post_format() == 'quote' ) && ( !empty(rb_get_metabox('format_link_title')) || !empty(rb_get_metabox('format_quote')) ) ){
						$extra_class .= ' spacing-top';
				}
			?>
				<div id="post-<?php the_ID() ?>" <?php post_class( $extra_class ) ?>>
					<div class="post-inner">
						<?php if( !empty(seoes__post_featured()) ) : ?>
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
								<?php echo seoes__the_content(get_theme_mod('blog_chars_count')) ?>
							</div>
						<?php endif; ?>
						
						<!-- Post Meta -->
						<?php seoes__post_meta() ?>
					</div>
				</div>
			<?php endwhile ?>

			<?php seoes__pagination() ?>
		<?php else: ?>
			<?php get_template_part( 'tmpl/post/content-none' ) ?>
		<?php endif ?>
	</div>
	<!-- /.content -->
			