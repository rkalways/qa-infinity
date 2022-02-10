<?php
/**
 *
 * Field: Upload
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_upload' ) ) {
	/**
	 *
	 * Field: upload
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_upload extends SPLC_FREE_Fields {

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
					'library'      => array(),
					'button_title' => __( 'Upload', 'splogocarousel' ),
					'remove_title' => __( 'Remove', 'splogocarousel' ),
				)
			);

			echo wp_kses_post( $this->field_before() );

			$library = ( is_array( $args['library'] ) ) ? $args['library'] : array_filter( (array) $args['library'] );
			$library = ( ! empty( $library ) ) ? implode( ',', $library ) : '';
			$hidden  = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="splogocarousel--wrap">';
			echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '"' . $this->field_attributes() . '/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<a href="#" class="button button-primary splogocarousel--button" data-library="' . esc_attr( $library ) . '">' . esc_html( $args['button_title'] ) . '</a>';
			echo '<a href="#" class="button button-secondary splogocarousel-warning-primary splogocarousel--remove' . esc_attr( $hidden ) . '">' . esc_html( $args['remove_title'] ) . '</a>';
			echo '</div>';
			echo wp_kses_post( $this->field_after() );
		}
	}
}
