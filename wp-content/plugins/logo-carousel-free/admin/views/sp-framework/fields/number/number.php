<?php
/**
 *
 * Field: Number
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_number' ) ) {
	/**
	 *
	 * Field: number
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_number extends SPLC_FREE_Fields {

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
					'unit' => '',
				)
			);

			echo wp_kses_post( $this->field_before() );
			echo '<div class="splogocarousel--wrap">';
			echo '<input type="number" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '"' . $this->field_attributes( array( 'class' => 'splogocarousel-input-number' ) ) . ' step="any" />';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo ( ! empty( $args['unit'] ) ) ? '<span class="splogocarousel--unit">' . esc_attr( $args['unit'] ) . '</span>' : '';
			echo '</div>';
			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Output
		 *
		 * @return CSS
		 */
		public function output() {

			$output    = '';
			$elements  = ( is_array( $this->field['output'] ) ) ? $this->field['output'] : array_filter( (array) $this->field['output'] );
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
			$mode      = ( ! empty( $this->field['output_mode'] ) ) ? $this->field['output_mode'] : 'width';
			$unit      = ( ! empty( $this->field['unit'] ) ) ? $this->field['unit'] : 'px';

			if ( ! empty( $elements ) && isset( $this->value ) && '' !== $this->value ) {
				foreach ( $elements as $key_property => $element ) {
					if ( is_numeric( $key_property ) ) {
						if ( $mode ) {
							$output = implode( ',', $elements ) . '{' . $mode . ':' . $this->value . $unit . $important . ';}';
						}
						break;
					} else {
						$output .= $element . '{' . $key_property . ':' . $this->value . $unit . $important . '}';
					}
				}
			}

			$this->parent->output_css .= $output;
			return $output;
		}

	}
}
