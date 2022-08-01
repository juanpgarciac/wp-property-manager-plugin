<?php

/**
 * @package Property_Manager
 * @version 1.0.0
 */
/*
Plugin Name: Property Manager
Plugin URI: http://github.com/juanpgarciac/wp-property-manager-plugin
Description: A Property manager plugin
Author: JPG
Version: 1.0.0
Author URI: http://github.com/juanpgarciac
*/

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * run the proper activation method
 * @return void
 */
function activate_property_manager()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-property-manager-activator.php';
    WP_Property_Manager_Activator::activate();
}

/**
 * run the proper deactivation method
 * @return void
 */
function deactivate_property_manager()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-property-manager-deactivator.php';
    WP_Property_Manager_Deactivator::deactivate();
}

//Activate proper activation and deactivation hooks
register_activation_hook(__FILE__, 'activate_property_manager');
register_deactivation_hook(__FILE__, 'deactivate_property_manager');

//Initialize the plugin
if (!class_exists('WP_Property_Manager_Base')) {

    //Some constants
    define('WP_PM_VERSION', '1.0.0');
    define('WP_PM_CPT', 'property-manager-cpt');
    define('WP_PM_DOMAIN', 'property-manager-domain');
    define('WP_PM_PLUGINDIR', plugin_dir_path(__FILE__));
    define('WP_PM_PLUGINURL', plugin_dir_url(__FILE__));

    //Custom quick autoloader
    $fileGroups = [

        plugin_dir_path(__FILE__)."includes/*.php",
        plugin_dir_path(__FILE__)."admin/*.php",
        plugin_dir_path(__FILE__)."includes/metaboxes/*.php",
        plugin_dir_path(__FILE__)."public/*.php",
    ];

    $ignoreFiles = [
        'single-property-manager-cpt.php'
    ];

    foreach ($fileGroups as $currDirectory) {
        foreach (glob($currDirectory, GLOB_NOCHECK) as $filename) {
            if (file_exists($filename) && !in_array(basename($filename), $ignoreFiles)) {
                require $filename;
            }
        }
    }


    $initClasses = [
        WP_Property_Manager_CPT::class,
        WP_Property_Manager_Taxonomy::class,
        WP_Property_Manager_CreationDate_Metabox::class,
        WP_Property_Manager_Address_Metabox::class,
        WP_Property_Manager_Coordinates_Metabox::class,
        WP_Property_Manager_Bedrooms_Metabox::class,
        WP_Property_Manager_Bath_Metabox::class,
        WP_Property_Manager_Garage_Metabox::class,
        WP_Property_Manager_Price_Metabox::class,
        WP_Property_Manager_Surface_Metabox::class,
        WP_Property_Manager_Construction_Status_Metabox::class,
        WP_Property_Manager_Sale_Status_Metabox::class,
        WP_Property_Manager_Type_Metabox::class,
        WP_Property_Manager_Blueprint_Metabox::class,
        WP_Property_Manager_Gallery_Metabox::class

    ];

    WP_Property_Manager::init($initClasses);

    if (is_admin()) {
        $initAdminClasses = [ ];
        WP_Property_Manager_Admin::init($initAdminClasses);
    }

    $initPublicClass = [ WP_Property_Manager_Search::class ];
    WP_Property_Manager_Public::init($initPublicClass);
}



if (!function_exists('dd')) {
    /**
     * "Dump and Die"
     * Print the arguments sent then die.
     * For debuggin purposes only
     * @param mixed ...$args
     *
     * @return void
     */
    function dd(...$args)
    {
        ob_clean();
        foreach ($args as $a) {
            var_dump($a);
        }
        die();
    }
}
