<?php
/**
 *
 * Field: Gallery
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_gallery' ) ) {

	/**
	 *
	 * Field: gallery
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_gallery extends SPLC_FREE_Fields {

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
					'add_title'   => esc_html__( 'Add Gallery', 'splogocarousel' ),
					'edit_title'  => esc_html__( 'Edit Gallery', 'splogocarousel' ),
					'clear_title' => esc_html__( 'Clear', 'splogocarousel' ),
				)
			);

			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo wp_kses_post( $this->field_before() );

			echo '<ul>';
			if ( ! empty( $this->value ) ) {

				$values = explode( ',', $this->value );

				foreach ( $values as $id ) {
					$attachment = wp_get_attachment_image_src( $id, 'thumbnail' );
					echo '<li><img src="' . esc_url( $attachment[0] ) . '" /></li>';
				}
			}
			echo '</ul>';

			echo '<a href="#" class="button button-primary splogocarousel-button">' . esc_html( $args['add_title'] ) . '</a>';
			echo '<a href="#" class="button splogocarousel-edit-gallery' . esc_attr( $hidden ) . '">' . esc_html( $args['edit_title'] ) . '</a>';
			echo '<a href="#" class="button splogocarousel-warning-primary splogocarousel-clear-gallery' . esc_attr( $hidden ) . '">' . esc_html( $args['clear_title'] ) . '</a>';
			echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '"' . $this->field_attributes() . '/>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			echo wp_kses_post( $this->field_after() );

		}

	}
}
