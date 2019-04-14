<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The commission admin settings 
 *
 * @author      Jamie Madden, WC Vendors
 * @category    Settings
 * @package     WCVendors/Admin/Settings
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WCVendors_Settings_Commission', false ) ) :

/**
 * WC_Admin_Settings_General.
 */
class WCVendors_Settings_Commission extends WCVendors_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'commission';
		$this->label = __( 'Commission', 'wcvendors' );

		parent::__construct();
	}

	/**
	 * Get sections.
	 *
	 * @return array
	 */
	public function get_sections() {
		$sections = array(
			''          => __( 'General', 'wcvendors' ),
		);

		return apply_filters( 'wcvendors_get_sections_' . $this->id, $sections );
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings( $current_section = '' ) {

		$settings = apply_filters( 'wcvendors_settings_comission', array(

			//  General Options 
			array(
				'type'     => 'title',
				'desc'     => __( 'These are the commission settings for your marketplace', 'wcvendors' ),
				'id'       => 'commission_options',
			),
			array(
				'title'    => sprintf( __( '%s Commission %%', 'wcvendors' ), wcv_get_vendor_name() ),
				'desc'     => sprintf( __( 'The global commission rate for your %s', 'wcvendors' ), lcfirst( wcv_get_vendor_name( false ) ) ),
				'id'       => 'wcvendors_vendor_commission_rate',
				'css'      => 'width:50px;',
				'default'  => '50',
				'type'     => 'number',
			),
			array( 'type' => 'sectionend', 'id' => 'commission_options' ),

		) ); 

		return apply_filters( 'wcvendors_get_settings_' . $this->id, $settings );
	}

}

endif;

return new WCVendors_Settings_Commission();
