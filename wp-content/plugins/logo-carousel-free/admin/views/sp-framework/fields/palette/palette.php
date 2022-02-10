<?php
/**
 *
 * Field: Palette
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_palette' ) ) {

	/**
	 *
	 * Field: palette
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_palette extends SPLC_FREE_Fields {

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

			$palette = ( ! empty( $this->field['options'] ) ) ? $this->field['options'] : array();

			echo wp_kses_post( $this->field_before() );

			if ( ! empty( $palette ) ) {

				echo '<div class="splogocarousel-siblings splogocarousel--palettes">';

				foreach ( $palette as $key => $colors ) {

					$active  = ( $key === $this->value ) ? ' splogocarousel--active' : '';
					$checked = ( $key === $this->value ) ? ' checked' : '';

					echo '<div class="splogocarousel--sibling splogocarousel--palette' . esc_attr( $active ) . '">';

					if ( ! empty( $colors ) ) {

						foreach ( $colors as $color ) {
							echo '<span style="background-color: ' . esc_attr( $color ) . ';"></span>';
						}
					}

					echo '<input type="radio" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $key ) . '"' . $this->field_attributes() . esc_attr( $checked ) . '/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';

				}

				echo '</div>';

			}

			echo wp_kses_post( $this->field_after() );

		}

	}
}
