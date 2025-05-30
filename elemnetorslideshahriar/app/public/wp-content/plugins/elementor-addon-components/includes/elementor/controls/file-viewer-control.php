<?php
/**
 * Class: File_Viewer_Control
 * Type: file-viewer
 *
 * Description: Les controls pour le lecteur de fichiers
 *
 * @since 1.8.9
 */

namespace EACCustomWidgets\Includes\Elementor\Controls;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use EACCustomWidgets\Includes\EAC_Plugin;

use Elementor\Base_Data_Control;

class File_Viewer_Control extends Base_Data_Control {

	/**
	 * Get control type.
	 *
	 * Retrieve the control type, in this case 'file-viewer'.
	 *
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'FILE_VIEWER';
	}

	/**
	 * Enqueue control scripts and styles.
	 *
	 * Used to register and enqueue custom scripts and styles
	 * for this control.
	 *
	 * @access public
	 */
	public function enqueue() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		} else {
			wp_enqueue_style( 'thickbox' );
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
		}

		// Charge le script
		wp_register_script( 'eac-viewer-control', EAC_Plugin::instance()->get_script_url( 'assets/js/elementor/controls/eac-file-viewer-control' ), array( 'jquery' ), '1.8.9', true );
		wp_enqueue_script( 'eac-viewer-control' );
	}

	/**
	 * Get default settings.
	 *
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return array( 'label_block' => true );
	}

	/**
	 * Rendu du contrôle dans l'éditeur.
	 *
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class='eac-viewer_control-field elementor-control-field'>
			<label for="<?php echo esc_attr( $control_uid ); ?>" class='elementor-control-title'>{{{ data.label }}}</label>

			<div class='elementor-control-input-wrapper'>
				<div>
					<a href='#' class='eac-select-file elementor-button elementor-button-success tooltip-target' data-tooltip='Select file' id="select-file-<?php echo esc_attr( $control_uid ); ?>">
						<# if (!data.controlValue) { #><?php echo esc_html__( 'Sélectionner', 'eac-components' ); ?><# } #>
						<# if (!!data.controlValue) { #><?php echo esc_html__( 'Changer', 'eac-components' ); ?><# } #>
						<i class='eicon-upload' aria-hidden='true'></i>
					</a>
				</div>

				<# if (!!data.controlValue) { #>
					<div>
						<a href='#' class='eac-remove-file elementor-button elementor-button-danger tooltip-target' data-tooltip='Remove file' id="select-file-<?php echo esc_attr( $control_uid ); ?>-remove">
							<i class='eicon-trash' aria-hidden='true'></i>
						</a>
					</div>
				<# } #>

				<input type='hidden' class='eac-selected-file-url' id="<?php echo esc_attr( $control_uid ); ?>" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}">
			</div>
			<# if (data.description) { #><div class='elementor-control-field-description'>{{{ data.description }}}</div><# } #>
			<# if (!!data.controlValue) { #><input class='eac-selected-file-name' type='text' readonly value="{{{ data.controlValue }}}"><# } #>
		</div>
		<?php
	}
}
