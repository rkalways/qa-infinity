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

if ( ! class_exists( 'SPLC_FREE_Field_icon' ) ) {
	/**
	 *
	 * Field: icon
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPLC_FREE_Field_icon extends SPLC_FREE_Fields {

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
					'button_title' => esc_html__( 'Add Icon', 'splogocarousel' ),
					'remove_title' => esc_html__( 'Remove Icon', 'splogocarousel' ),
				)
			);

			echo wp_kses_post( $this->field_before() );

			$nonce  = wp_create_nonce( 'splogocarousel_icon_nonce' );
			$hidden = ( empty( $this->value ) ) ? ' hidden' : '';

			echo '<div class="splogocarousel-icon-select">';
			echo '<span class="splogocarousel-icon-preview' . esc_attr( $hidden ) . '"><i class="' . esc_attr( $this->value ) . '"></i></span>';
			echo '<a href="#" class="button button-primary splogocarousel-icon-add" data-nonce="' . esc_attr( $nonce ) . '">' . esc_html( $args['button_title'] ) . '</a>';
			echo '<a href="#" class="button splogocarousel-warning-primary splogocarousel-icon-remove' . esc_attr( $hidden ) . '">' . esc_html( $args['remove_title'] ) . '</a>';
			echo '<input type="text" name="' . esc_attr( $this->field_name() ) . '" value="' . esc_attr( $this->value ) . '" class="splogocarousel-icon-value"' . $this->field_attributes() . ' />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {
			add_action( 'admin_footer', array( &$this, 'add_footer_modal_icon' ) );
		}

		/**
		 * Add_footer_modal_icon
		 *
		 * @return void
		 */
		public function add_footer_modal_icon() {
			?>
	<div id="splogocarousel-modal-icon" class="splogocarousel-modal splogocarousel-modal-icon hidden">
		<div class="splogocarousel-modal-table">
		<div class="splogocarousel-modal-table-cell">
			<div class="splogocarousel-modal-overlay"></div>
			<div class="splogocarousel-modal-inner">
			<div class="splogocarousel-modal-title">
				<?php esc_html_e( 'Add Icon', 'splogocarousel' ); ?>
				<div class="splogocarousel-modal-close splogocarousel-icon-close"></div>
			</div>
			<div class="splogocarousel-modal-header">
				<input type="text" placeholder="<?php esc_html_e( 'Search...', 'splogocarousel' ); ?>" class="splogocarousel-icon-search" />
			</div>
		<div class="splogocarousel-modal-content">
				<div class="splogocarousel-modal-loading"><div class="splogocarousel-loading"></div></div>
				<div class="splogocarousel-modal-load"></div>
			</div>
			</div>
		</div>
		</div>
	</div>
			<?php
		}

	}
}
