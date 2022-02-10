<?php
/**
 *
 * Field: Repeater
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_repeater' ) ) {
	/**
	 *
	 * Field: repeater
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_repeater extends SPLC_FREE_Fields {

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
					'max'          => 0,
					'min'          => 0,
					'button_title' => '<i class="fas fa-plus-circle"></i>',
				)
			);

			if ( preg_match( '/' . preg_quote( '[' . $this->field['id'] . ']' ) . '/', $this->unique ) ) {

				echo '<div class="splogocarousel-notice splogocarousel-notice-danger">' . esc_html__( 'Error: Field ID conflict.', 'splogocarousel' ) . '</div>';

			} else {

				echo wp_kses_post( $this->field_before() );

				echo '<div class="splogocarousel-repeater-item splogocarousel-repeater-hidden" data-depend-id="' . esc_attr( $this->field['id'] ) . '">';
				echo '<div class="splogocarousel-repeater-content">';
				foreach ( $this->field['fields'] as $field ) {

					$field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
					$field_unique  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][0]' : $this->field['id'] . '[0]';

					SPLC::field( $field, $field_default, '___' . $field_unique, 'field/repeater' );

				}
				echo '</div>';
				echo '<div class="splogocarousel-repeater-helper">';
				echo '<div class="splogocarousel-repeater-helper-inner">';
				echo '<i class="splogocarousel-repeater-sort fas fa-arrows-alt"></i>';
				echo '<i class="splogocarousel-repeater-clone far fa-clone"></i>';
				echo '<i class="splogocarousel-repeater-remove splogocarousel-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'splogocarousel' ) . '"></i>';
				echo '</div>';
				echo '</div>';
				echo '</div>';

				echo '<div class="splogocarousel-repeater-wrapper splogocarousel-data-wrapper" data-field-id="[' . esc_attr( $this->field['id'] ) . ']" data-max="' . esc_attr( $args['max'] ) . '" data-min="' . esc_attr( $args['min'] ) . '">';

				if ( ! empty( $this->value ) && is_array( $this->value ) ) {

					$num = 0;

					foreach ( $this->value as $key => $value ) {

						echo '<div class="splogocarousel-repeater-item">';
						echo '<div class="splogocarousel-repeater-content">';
						foreach ( $this->field['fields'] as $field ) {

							$field_unique = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][' . $num . ']' : $this->field['id'] . '[' . $num . ']';
							$field_value  = ( isset( $field['id'] ) && isset( $this->value[ $key ][ $field['id'] ] ) ) ? $this->value[ $key ][ $field['id'] ] : '';

							SPLC::field( $field, $field_value, $field_unique, 'field/repeater' );

						}
						echo '</div>';
						echo '<div class="splogocarousel-repeater-helper">';
						echo '<div class="splogocarousel-repeater-helper-inner">';
						echo '<i class="splogocarousel-repeater-sort fas fa-arrows-alt"></i>';
						echo '<i class="splogocarousel-repeater-clone far fa-clone"></i>';
						echo '<i class="splogocarousel-repeater-remove splogocarousel-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'splogocarousel' ) . '"></i>';
						echo '</div>';
						echo '</div>';
						echo '</div>';

						$num++;

					}
				}

				echo '</div>';

				echo '<div class="splogocarousel-repeater-alert splogocarousel-repeater-max">' . esc_html__( 'You cannot add more.', 'splogocarousel' ) . '</div>';
				echo '<div class="splogocarousel-repeater-alert splogocarousel-repeater-min">' . esc_html__( 'You cannot remove more.', 'splogocarousel' ) . '</div>';
				echo '<a href="#" class="button button-primary splogocarousel-repeater-add">' . esc_html( $args['button_title'] ) . '</a>';

				echo wp_kses_post( $this->field_after() );

			}

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
