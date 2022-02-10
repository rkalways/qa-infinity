<?php

/**
 *
 * Field: Link Color
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.


if ( ! class_exists( 'SPLC_FREE_Field_link_color' ) ) {
	/**
	 *
	 * Field: link_color
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_link_color extends SPLC_FREE_Fields {

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
					'color'   => true,
					'hover'   => true,
					'active'  => false,
					'visited' => false,
					'focus'   => false,
				)
			);

			$default_values = array(
				'color'   => '',
				'hover'   => '',
				'active'  => '',
				'visited' => '',
				'focus'   => '',
			);

			$color_props = array(
				'color'   => esc_html__( 'Normal', 'splogocarousel' ),
				'hover'   => esc_html__( 'Hover', 'splogocarousel' ),
				'active'  => esc_html__( 'Active', 'splogocarousel' ),
				'visited' => esc_html__( 'Visited', 'splogocarousel' ),
				'focus'   => esc_html__( 'Focus', 'splogocarousel' ),
			);

			$value = wp_parse_args( $this->value, $default_values );

			echo wp_kses_post( $this->field_before() );

			foreach ( $color_props as $color_prop_key => $color_prop_value ) {

				if ( ! empty( $args[ $color_prop_key ] ) ) {

					$default_attr = ( ! empty( $this->field['default'][ $color_prop_key ] ) ) ? ' data-default-color="' . esc_attr( $this->field['default'][ $color_prop_key ] ) . '"' : '';

					echo '<div class="splogocarousel--left splogocarousel-field-color">';
					echo '<div class="splogocarousel--title">' . esc_attr( $color_prop_value ) . '</div>';
					echo '<input type="text" name="' . esc_attr( $this->field_name( '[' . $color_prop_key . ']' ) ) . '" value="' . esc_attr( $value[ $color_prop_key ] ) . '" class="splogocarousel-color"' . $default_attr . $this->field_attributes() . '/>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';

				}
			}

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Output
		 *
		 * @return css
		 */
		public function output() {
			$output    = '';
			$elements  = ( is_array( $this->field['output'] ) ) ? $this->field['output'] : array_filter( (array) $this->field['output'] );
			$important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';

			if ( ! empty( $elements ) && isset( $this->value ) && '' !== $this->value ) {
				foreach ( $elements as $element ) {

					if ( isset( $this->value['color'] ) && '' !== $this->value['color'] ) {
						$output .= $element . '{color:' . $this->value['color'] . $important . ';}'; }
					if ( isset( $this->value['hover'] ) && '' !== $this->value['hover'] ) {
						$output .= $element . ':hover{color:' . $this->value['hover'] . $important . ';}'; }
					if ( isset( $this->value['active'] ) && '' !== $this->value['active'] ) {
						$output .= $element . ':active{color:' . $this->value['active'] . $important . ';}'; }
					if ( isset( $this->value['visited'] ) && '' !== $this->value['visited'] ) {
						$output .= $element . ':visited{color:' . $this->value['visited'] . $important . ';}'; }
					if ( isset( $this->value['focus'] ) && '' !== $this->value['focus'] ) {
						$output .= $element . ':focus{color:' . $this->value['focus'] . $important . ';}'; }
				}
			}

			$this->parent->output_css .= $output;

			return $output;

		}

	}
}
