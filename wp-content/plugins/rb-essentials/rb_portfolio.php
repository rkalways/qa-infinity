<?php

add_action( "init", "register_rb_portfolio_cat", 1 );
add_action( "init", "register_rb_portfolio_tag", 2 );
add_action( "init", "register_rb_portfolio", 3 );

function register_rb_portfolio (){
	$rewrite_slug = rb_get_slug('portfolio');

	$labels = array(
		'name' => esc_html_x( 'Portfolio', 'backend', 'seoes' ),
		'singular_name' => esc_html_x( 'Portfolio Item', 'backend', 'seoes' ),
		'menu_name' => esc_html_x( 'Portfolio', 'backend', 'seoes' ),
		'add_new' => esc_html_x( 'Add New', 'backend', 'seoes' ),
		'add_new_item' => esc_html_x( 'Add New Portfolio Item', 'backend', 'seoes' ),
		'edit_item' => esc_html_x('Edit Portfolio Item', 'backend', 'seoes' ),
		'new_item' => esc_html_x( 'New Portfolio Item', 'backend', 'seoes' ),
		'view_item' => esc_html_x( 'View Portfolio Item', 'backend', 'seoes' ),
		'search_items' => esc_html_x( 'Search Portfolio Item', 'backend', 'seoes' ),
		'not_found' => esc_html_x( 'No Portfolio Items found', 'backend', 'seoes' ),
		'not_found_in_trash' => esc_html_x( 'No Portfolio Items found in Trash', 'backend', 'seoes' ),
		'parent_item_colon' => '',
	);

	register_post_type( 'rb_portfolio', array(
		'label' => esc_html_x( 'Portfolio items', 'backend', 'seoes' ),
		'labels' => $labels,
		'public' => true,
		'rewrite' => array( 'slug' => $rewrite_slug ),
		'capability_type' => 'post',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'page-attributes',
			'thumbnail'
		),
		'menu_position' => 23,
		'menu_icon' => 'dashicons-format-gallery',
		'taxonomies' => array( 'rb_portfolio_cat' ),
		'has_archive' => true,
		'show_in_rest' => true
	));
}

function register_rb_portfolio_cat(){
	$rewrite_slug = rb_get_slug('portfolio');

	register_taxonomy( 'rb_portfolio_cat', 'rb_portfolio', array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $rewrite_slug . '_category' ),
		'show_in_rest' => true
	));
}

function register_rb_portfolio_tag(){
	$rewrite_slug = rb_get_slug('portfolio');

	register_taxonomy( 'rb_portfolio_tag', 'rb_portfolio', array(
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $rewrite_slug . '_tag' ),
		'show_tagcloud' => false,
		'show_in_rest' => true
	));
}

//Add portfolio orders
function add_portfolio_order_column( $columns ) {
  $columns['menu_order'] = "Order";
  return $columns;
}
add_action('manage_edit-rb_portfolio_columns', 'add_portfolio_order_column');

//Show portfolio order on 'edit all' page
function show_portfolio_order_column($name){
  global $post;
  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_rb_portfolio_posts_custom_column', 'show_portfolio_order_column');

//Show portfolio thumbnails on 'edit all' page
function add_rb_portfolio_thumb_name ($columns) {
	$columns = array_slice($columns, 0, 1, true) +
				array('rb_portfolio_thumbnail' => esc_html_x('Thumbnails', 'backend', 'seoes')) +
				array_slice($columns, 1, NULL, true);
	return $columns;
}
add_filter('manage_rb_portfolio_posts_columns', 'add_rb_portfolio_thumb_name');

function add_rb_portfolio_thumb ($column, $id) {
	if ('rb_portfolio_thumbnail' === $column) {
		echo the_post_thumbnail('thumbnail');
	}
}
add_action('manage_rb_portfolio_posts_custom_column', 'add_rb_portfolio_thumb', 5, 2);