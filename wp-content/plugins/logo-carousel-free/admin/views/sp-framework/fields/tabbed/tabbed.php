<?php
/**
 *
 * Field: Tabbed
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */


if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_tabbed' ) ) {

	/**
	 *
	 * Field: tabbed
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_tabbed extends SPLC_FREE_Fields {

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

			$unallows = array( 'tabbed' );

			echo wp_kses_post( $this->field_before() );

			echo '<div class="splogocarousel-tabbed-nav" data-depend-id="' . esc_attr( $this->field['id'] ) . '">';
			foreach ( $this->field['tabs'] as $key => $tab ) {

				$tabbed_icon   = ( ! empty( $tab['icon'] ) ) ? '<i class="splogocarousel--icon ' . esc_attr( $tab['icon'] ) . '"></i>' : '';
				$tabbed_active = ( empty( $key ) ) ? 'splogocarousel-tabbed-active' : '';

				echo '<a href="#" class="' . esc_attr( $tabbed_active ) . '"">' . wp_kses_post( $tabbed_icon . $tab['title'] ) . '</a>';

			}
			echo '</div>';

			echo '<div class="splogocarousel-tabbed-contents">';
			foreach ( $this->field['tabs'] as $key => $tab ) {

				$tabbed_hidden = ( ! empty( $key ) ) ? ' hidden' : '';

				echo '<div class="splogocarousel-tabbed-content' . esc_attr( $tabbed_hidden ) . '">';

				foreach ( $tab['fields'] as $field ) {

					if ( in_array( $field['type'], $unallows ) ) {
						$field['_notice'] = true; }

					$field_id      = ( isset( $field['id'] ) ) ? $field['id'] : '';
					$field_default = ( isset( $field['default'] ) ) ? $field['default'] : '';
					$field_value   = ( isset( $this->value[ $field_id ] ) ) ? $this->value[ $field_id ] : $field_default;
					$unique_id     = ( ! empty( $this->unique ) ) ? $this->unique . '[' . $this->field['id'] . ']' : $this->field['id'];

					SPLC::field( $field, $field_value, $unique_id, 'field/tabbed' );

				}

				echo '</div>';

			}
			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

	}
}
