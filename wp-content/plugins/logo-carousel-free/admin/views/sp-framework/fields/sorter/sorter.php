<?php
/**
 *
 * Field: Icon
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_sorter' ) ) {
	/**
	 *
	 * Field: sorter
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_sorter extends SPLC_FREE_Fields {

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
					'disabled'       => true,
					'enabled_title'  => esc_html__( 'Enabled', 'splogocarousel' ),
					'disabled_title' => esc_html__( 'Disabled', 'splogocarousel' ),
				)
			);

			echo wp_kses_post( $this->field_before() );

			$this->value      = ( ! empty( $this->value ) ) ? $this->value : $this->field['default'];
			$enabled_options  = ( ! empty( $this->value['enabled'] ) ) ? $this->value['enabled'] : array();
			$disabled_options = ( ! empty( $this->value['disabled'] ) ) ? $this->value['disabled'] : array();

			echo '<div class="splogocarousel-sorter" data-depend-id="' . esc_attr( $this->field['id'] ) . '"></div>';

			echo ( $args['disabled'] ) ? '<div class="splogocarousel-modules">' : '';

			echo ( ! empty( $args['enabled_title'] ) ) ? '<div class="splogocarousel-sorter-title">' . esc_attr( $args['enabled_title'] ) . '</div>' : '';
			echo '<ul class="splogocarousel-enabled">';
			if ( ! empty( $enabled_options ) ) {
				foreach ( $enabled_options as $key => $value ) {
					echo '<li><input type="hidden" name="' . esc_attr( $this->field_name( '[enabled][' . $key . ']' ) ) . '" value="' . esc_attr( $value ) . '"/><label>' . esc_attr( $value ) . '</label></li>';
				}
			}
			echo '</ul>';

			// Check for hide/show disabled section.
			if ( $args['disabled'] ) {
				echo '</div>';
				echo '<div class="splogocarousel-modules">';
				echo ( ! empty( $args['disabled_title'] ) ) ? '<div class="splogocarousel-sorter-title">' . esc_attr( $args['disabled_title'] ) . '</div>' : '';
				echo '<ul class="splogocarousel-disabled">';
				if ( ! empty( $disabled_options ) ) {
					foreach ( $disabled_options as $key => $value ) {
						echo '<li><input type="hidden" name="' . esc_attr( $this->field_name( '[disabled][' . $key . ']' ) ) . '" value="' . esc_attr( $value ) . '"/><label>' . esc_attr( $value ) . '</label></li>';
					}
				}
				echo '</ul>';
				echo '</div>';

			}

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}

		}

	}
}
