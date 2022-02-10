<?php
/**
 *
 * Field: Group
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */
if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_group' ) ) {

	/**
	 *
	 * Field: group
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_group extends SPLC_FREE_Fields {

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
					'max'                    => 0,
					'min'                    => 0,
					'fields'                 => array(),
					'button_title'           => esc_html__( 'Add New', 'splogocarousel' ),
					'accordion_title_prefix' => '',
					'accordion_title_number' => false,
					'accordion_title_auto'   => true,
				)
			);

			$title_prefix = ( ! empty( $args['accordion_title_prefix'] ) ) ? $args['accordion_title_prefix'] : '';
			$title_number = ( ! empty( $args['accordion_title_number'] ) ) ? true : false;
			$title_auto   = ( ! empty( $args['accordion_title_auto'] ) ) ? true : false;

			if ( preg_match( '/' . preg_quote( '[' . $this->field['id'] . ']' ) . '/', $this->unique ) ) {
				echo '<div class="splogocarousel-notice splogocarousel-notice-danger">' . esc_html__( 'Error: Field ID conflict.', 'splogocarousel' ) . '</div>';
			} else {

				echo wp_kses_post( $this->field_before() );

				echo '<div class="splogocarousel-cloneable-item splogocarousel-cloneable-hidden" data-depend-id="' . esc_attr( $this->field['id'] ) . '">';

				echo '<div class="splogocarousel-cloneable-helper">';
				echo '<i class="splogocarousel-cloneable-sort fas fa-arrows-alt"></i>';
				echo '<i class="splogocarousel-cloneable-clone far fa-clone"></i>';
				echo '<i class="splogocarousel-cloneable-remove splogocarousel-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'splogocarousel' ) . '"></i>';
				echo '</div>';

				echo '<h4 class="splogocarousel-cloneable-title">';
				echo '<span class="splogocarousel-cloneable-text">';
				echo ( $title_number ) ? '<span class="splogocarousel-cloneable-title-number"></span>' : '';
				echo ( $title_prefix ) ? '<span class="splogocarousel-cloneable-title-prefix">' . esc_attr( $title_prefix ) . '</span>' : '';
				echo ( $title_auto ) ? '<span class="splogocarousel-cloneable-value"><span class="splogocarousel-cloneable-placeholder"></span></span>' : '';
				echo '</span>';
				echo '</h4>';

				echo '<div class="splogocarousel-cloneable-content">';
				foreach ( $this->field['fields'] as $field ) {

					$field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
					$field_unique  = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][0]' : $this->field['id'] . '[0]';

					SPLC::field( $field, $field_default, '___' . $field_unique, 'field/group' );

				}
				echo '</div>';

				echo '</div>';

				echo '<div class="splogocarousel-cloneable-wrapper splogocarousel-data-wrapper" data-title-number="' . esc_attr( $title_number ) . '" data-field-id="[' . esc_attr( $this->field['id'] ) . ']" data-max="' . esc_attr( $args['max'] ) . '" data-min="' . esc_attr( $args['min'] ) . '">';

				if ( ! empty( $this->value ) ) {

					$num = 0;

					foreach ( $this->value as $value ) {

						$first_id    = ( isset( $this->field['fields'][0]['id'] ) ) ? $this->field['fields'][0]['id'] : '';
						$first_value = ( isset( $value[ $first_id ] ) ) ? $value[ $first_id ] : '';
						$first_value = ( is_array( $first_value ) ) ? reset( $first_value ) : $first_value;

						echo '<div class="splogocarousel-cloneable-item">';

						echo '<div class="splogocarousel-cloneable-helper">';
							echo '<i class="splogocarousel-cloneable-sort fas fa-arrows-alt"></i>';
							echo '<i class="splogocarousel-cloneable-clone far fa-clone"></i>';
							echo '<i class="splogocarousel-cloneable-remove splogocarousel-confirm fas fa-times" data-confirm="' . esc_html__( 'Are you sure to delete this item?', 'splogocarousel' ) . '"></i>';
							echo '</div>';

							echo '<h4 class="splogocarousel-cloneable-title">';
							echo '<span class="splogocarousel-cloneable-text">';
							echo ( $title_number ) ? '<span class="splogocarousel-cloneable-title-number">' . esc_attr( $num + 1 ) . '.</span>' : '';
							echo ( $title_prefix ) ? '<span class="splogocarousel-cloneable-title-prefix">' . esc_attr( $title_prefix ) . '</span>' : '';
							echo ( $title_auto ) ? '<span class="splogocarousel-cloneable-value">' . esc_attr( $first_value ) . '</span>' : '';
							echo '</span>';
							echo '</h4>';

							echo '<div class="splogocarousel-cloneable-content">';

						foreach ( $this->field['fields'] as $field ) {

							$field_unique = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . '][' . $num . ']' : $this->field['id'] . '[' . $num . ']';
							$field_value  = ( isset( $field['id'] ) && isset( $value[ $field['id'] ] ) ) ? $value[ $field['id'] ] : '';

							SPLC::field( $field, $field_value, $field_unique, 'field/group' );

						}

							echo '</div>';

						echo '</div>';

					$num++;

					}
				}

				echo '</div>';

				echo '<div class="splogocarousel-cloneable-alert splogocarousel-cloneable-max">' . esc_html__( 'You cannot add more.', 'splogocarousel' ) . '</div>';
				echo '<div class="splogocarousel-cloneable-alert splogocarousel-cloneable-min">' . esc_html__( 'You cannot remove more.', 'splogocarousel' ) . '</div>';
				echo '<a href="#" class="button button-primary splogocarousel-cloneable-add">' . esc_html( $args['button_title'] ) . '</a>';

				echo wp_kses_post( $this->field_after() );

			}

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_script_is( 'jquery-ui-accordion' ) ) {
				wp_enqueue_script( 'jquery-ui-accordion' );
			}

			if ( ! wp_script_is( 'jquery-ui-sortable' ) ) {
				wp_enqueue_script( 'jquery-ui-sortable' );
			}

		}

	}
}
