<?php
/**
 *
 * Field: Link
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_link' ) ) {
	/**
	 *
	 * Field: link
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_link extends SPLC_FREE_Fields {

		/**
		 * The class constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * The render method.
		 *
		 * @return void
		 */
		public function render() {

			$args = wp_parse_args(
				$this->field,
				array(
					'add_title'    => esc_html__( 'Add Link', 'splogocarousel' ),
					'edit_title'   => esc_html__( 'Edit Link', 'splogocarousel' ),
					'remove_title' => esc_html__( 'Remove Link', 'splogocarousel' ),
				)
			);

			$default_values = array(
				'url'    => '',
				'text'   => '',
				'target' => '',
			);

			$value = wp_parse_args( $this->value, $default_values );

			$hidden = ( ! empty( $value['url'] ) || ! empty( $value['url'] ) || ! empty( $value['url'] ) ) ? ' hidden' : '';

			$maybe_hidden = ( empty( $hidden ) ) ? ' hidden' : '';

			echo wp_kses_post( $this->field_before() );

			echo '<textarea readonly="readonly" class="splogocarousel--link hidden"></textarea>';

			echo '<div class="' . esc_attr( $maybe_hidden ) . '"><div class="splogocarousel--result">' . sprintf( '{url:"%s", text:"%s", target:"%s"}', esc_url( $value['url'] ), esc_attr( $value['text'] ), esc_attr( $value['target'] ) ) . '</div></div>';

			echo '<input type="text" name="' . esc_attr( $this->field_name( '[url]' ) ) . '" value="' . esc_attr( $value['url'] ) . '"' . $this->field_attributes( array( 'class' => 'splogocarousel--url hidden' ) ) . ' />';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<input type="text" name="' . esc_attr( $this->field_name( '[text]' ) ) . '" value="' . esc_attr( $value['text'] ) . '" class="splogocarousel--text hidden" />';
			echo '<input type="text" name="' . esc_attr( $this->field_name( '[target]' ) ) . '" value="' . esc_attr( $value['target'] ) . '" class="splogocarousel--target hidden" />';

			echo '<a href="#" class="button button-primary splogocarousel--add' . esc_attr( $hidden ) . '">' . esc_html( $args['add_title'] ) . '</a> ';
			echo '<a href="#" class="button splogocarousel--edit' . esc_attr( $maybe_hidden ) . '">' . esc_html( $args['edit_title'] ) . '</a> ';
			echo '<a href="#" class="button splogocarousel-warning-primary splogocarousel--remove' . esc_attr( $maybe_hidden ) . '">' . esc_html( $args['remove_title'] ) . '</a>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_script_is( 'wplink' ) ) {
				wp_enqueue_script( 'wplink' );
			}

			if ( ! wp_script_is( 'jquery-ui-autocomplete' ) ) {
				wp_enqueue_script( 'jquery-ui-autocomplete' );
			}

			add_action( 'admin_print_footer_scripts', array( &$this, 'add_wp_link_dialog' ) );

		}

		/**
		 * Add_wp_link_dialog
		 *
		 * @return void
		 */
		public function add_wp_link_dialog() {

			if ( ! class_exists( '_WP_Editors' ) ) {
				require_once ABSPATH . WPINC . '/class-wp-editor.php';
			}

			wp_print_styles( 'editor-buttons' );

			_WP_Editors::wp_link_dialog();

		}

	}
}
