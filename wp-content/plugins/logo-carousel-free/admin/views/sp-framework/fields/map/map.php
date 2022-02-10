<?php
/**
 *
 * Field: Map
 *
 * @link       https://shapedplugin.com/
 *
 * @package    Logo_Carousel_Free
 * @subpackage Logo_Carousel_Free/sp-framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPLC_FREE_Field_map' ) ) {


	/**
	 *
	 * Field: map
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_map extends SPLC_FREE_Fields {

		/**
		 * Version
		 *
		 * @var string
		 */
		public $version = '1.7.1';
		/**
		 * CDN_url
		 *
		 * @var string
		 */
		public $cdn_url = 'https://cdn.jsdelivr.net/npm/leaflet@';

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
					'placeholder'    => esc_html__( 'Search...', 'splogocarousel' ),
					'latitude_text'  => esc_html__( 'Latitude', 'splogocarousel' ),
					'longitude_text' => esc_html__( 'Longitude', 'splogocarousel' ),
					'address_field'  => '',
					'height'         => '',
				)
			);

			$value = wp_parse_args(
				$this->value,
				array(
					'address'   => '',
					'latitude'  => '20',
					'longitude' => '0',
					'zoom'      => '2',
				)
			);

			$default_settings = array(
				'center'          => array( $value['latitude'], $value['longitude'] ),
				'zoom'            => $value['zoom'],
				'scrollWheelZoom' => false,
			);

			$settings = ( ! empty( $this->field['settings'] ) ) ? $this->field['settings'] : array();
			$settings = wp_parse_args( $settings, $default_settings );

			$style_attr  = ( ! empty( $args['height'] ) ) ? ' style="min-height:' . esc_attr( $args['height'] ) . ';"' : '';
			$placeholder = ( ! empty( $args['placeholder'] ) ) ? array( 'placeholder' => $args['placeholder'] ) : '';

			echo wp_kses_post( $this->field_before() );

			if ( empty( $args['address_field'] ) ) {
				echo '<div class="splogocarousel--map-search">';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[address]' ) ) . '" value="' . esc_attr( $value['address'] ) . '"' . $this->field_attributes( $placeholder ) . ' />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</div>';
			} else {
				echo '<div class="splogocarousel--address-field" data-address-field="' . esc_attr( $args['address_field'] ) . '"></div>';
			}

			echo '<div class="splogocarousel--map-osm-wrap"><div class="splogocarousel--map-osm" data-map="' . esc_attr( wp_json_encode( $settings ) ) . '"' . $style_attr . '></div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			echo '<div class="splogocarousel--map-inputs">';

			echo '<div class="splogocarousel--map-input">';
			echo '<label>' . esc_attr( $args['latitude_text'] ) . '</label>';
			echo '<input type="text" name="' . esc_attr( $this->field_name( '[latitude]' ) ) . '" value="' . esc_attr( $value['latitude'] ) . '" class="splogocarousel--latitude" />';
			echo '</div>';

			echo '<div class="splogocarousel--map-input">';
			echo '<label>' . esc_attr( $args['longitude_text'] ) . '</label>';
			echo '<input type="text" name="' . esc_attr( $this->field_name( '[longitude]' ) ) . '" value="' . esc_attr( $value['longitude'] ) . '" class="splogocarousel--longitude" />';
			echo '</div>';

			echo '</div>';

			echo '<input type="hidden" name="' . esc_attr( $this->field_name( '[zoom]' ) ) . '" value="' . esc_attr( $value['zoom'] ) . '" class="splogocarousel--zoom" />';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			if ( ! wp_script_is( 'splogocarousel-leaflet' ) ) {
				wp_enqueue_script( 'splogocarousel-leaflet', esc_url( $this->cdn_url . $this->version . '/dist/leaflet.js' ), array( 'splogocarousel' ), $this->version, true );
			}

			if ( ! wp_style_is( 'splogocarousel-leaflet' ) ) {
				wp_enqueue_style( 'splogocarousel-leaflet', esc_url( $this->cdn_url . $this->version . '/dist/leaflet.css' ), array(), $this->version );
			}

			if ( ! wp_script_is( 'jquery-ui-autocomplete' ) ) {
				wp_enqueue_script( 'jquery-ui-autocomplete' );
			}

		}

	}
}
