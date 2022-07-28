<?php 
/**
 * @package Property_Manager
 * @version 1.0.0
 */
/*
Plugin Name: Property Manager
Plugin URI: http://google.com/
Description: Ptoperty manager description
Author: JPG
Version: 1.0.0
Author URI: http://github.com/juanpgarciac
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_property_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-activator.php';
	WP_Property_Manager_Activator::activate();
}

function deactivate_property_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-deactivator.php';
	WP_Property_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_property_manager' );
register_deactivation_hook( __FILE__, 'deactivate_property_manager' );

if ( !class_exists( 'WP_Property_Manager_Base' ) ) {
    
    define('WP_PM_CPT','property-manager-cpt');
    define('WP_PM_DOMAIN','property-manager-domain');

    require plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-base.php';
    require plugin_dir_path( __FILE__ ) . 'includes/class-property-manager.php';
    require plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-cpt.php';
    require plugin_dir_path( __FILE__ ) . 'includes/class-property-manager-taxonomy.php';
    
    $initClasses = [
        WP_Property_Manager_CPT::class,
        WP_Property_Manager_Taxonomy::class

    ];
    
    WP_Property_Manager::init($initClasses);

}