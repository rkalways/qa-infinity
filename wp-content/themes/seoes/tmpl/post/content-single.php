<?php
defined( 'ABSPATH' ) or die();

?>
	<div id="post-<?php the_ID() ?>" <?php post_class( 'post' ) ?>>

		<div class="post-format format_<?php echo get_post_format(); ?>">
			<?php switch( get_post_format() ){
				case 'gallery':
					$gallery = explode(',', rb_get_metabox('format_gallery'));
					if( is_array($gallery) ) : ?>

						<div class="rb_carousel_wrapper" data-pagination="on" data-draggable="on" duto-height="on">
							<div class="rb_carousel">
								<?php 
									foreach ($gallery as $image) {
										$alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
										$src = wp_get_attachment_image_src( $image, 'full' )[0];

										echo "<img src='".esc_url($src)."' alt='".esc_attr($alt)."' />";
									} 
								?>
							</div>
						</div>

					<?php endif;
					break;
				case 'link':
					$link_title = rb_get_metabox('format_link_title');
					$link_url = rb_get_metabox('format_link_url');

					if( !empty($link_title) && !empty($link_url) )
						echo '<a href="'.esc_url($link_url).'" target="_blank">'.esc_html($link_title).'</a>';
					break;
				case 'quote':
					$quote_title = rb_get_metabox('format_quote');
					$quote_author = rb_get_metabox('format_quote_author');

					if( !empty($quote_title) ){
						echo '<blockquote>';
							echo esc_html($quote_title);
							echo !empty($quote_author) ? '<cite>'.esc_html($quote_author).'</cite>' : '';
						echo '</blockquote>';
					}

					break;
				case 'video':
					$video = rb_get_metabox('format_video');
					
					if( !empty($video) ){
						echo apply_filters( "the_content", "[embed]".$video."[/embed]" );
					}

					break;
				case 'audio':
					$audio = rb_get_metabox('format_audio');
					
					if( !empty($audio) ){
						echo apply_filters( "the_content", "[embed]".$audio."[/embed]" );
					}

					break;
			} ?>
		</div>

		<div class="post-inner">
			<div class="post-content" itemprop="text">
				<div class="post-content-inner">
					<?php the_content() ?>
				</div>

				<?php 
				wp_link_pages( array(
					'before'      => '<div class="paging-navigation in-post"><div class="pagination"><span class="page-links-title">' . esc_html__( 'Pages:', 'seoes' ) . '</span>',
					'after'       => '</div></div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>

				<?php
				if( !empty(get_the_tags()) || !empty(get_the_category()) ) : ?>
					
					<div class="post-meta">
	
					<?php get_template_part( 'tmpl/post/content-sharing' ); ?>

					<?php if( !empty(get_the_tags()) ){ ?>
						<div class="post-tags"><?php the_tags('', ' '); ?></div>
					<?php } ?>

					</div>

				<?php endif; ?>

			</div>

			<?php if( !empty(get_the_author_meta( 'description' )) ) : ?>
				<div class="author-information">
					<div class="author-image">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 'thumbnail' ); ?> 
					</div>
					<div class="author-content">
						<h5 class="author-name">
							<?php echo get_the_author_meta( 'user_nicename' ); ?>
						</h5>
						<p class="author-biography">
							<?php echo get_the_author_meta( 'description' ); ?>
						</p>
						<ul class="author-socials">
							
						</ul>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>