<?php

/**
 * Property manager base class, basically to handle constants
 */
abstract class WP_Property_Manager_Base
{
    public static function init()
    {
    }

    public static function getCPT()
    {
        return defined('WP_PM_CPT') ? WP_PM_CPT : 'property-manager-cpt';
    }

    public static function getDomain()
    {
        return defined('WP_PM_DOMAIN') ? WP_PM_DOMAIN : 'property-manager-domain';
    }

    public static function getAdminDir()
    {
        return defined('WP_PM_PLUGINDIR') ? WP_PM_PLUGINDIR.'admin/' : plugin_dir_path(__FILE__).'../admin/';
    }
    public static function getAdminUrl()
    {
        return defined('WP_PM_PLUGINURL') ? WP_PM_PLUGINURL.'admin/' : plugin_dir_url(__FILE__).'../admin/';
    }
    public static function getPublicDir()
    {
        return defined('WP_PM_PLUGINDIR') ? WP_PM_PLUGINDIR.'public/' : plugin_dir_path(__FILE__).'../public/';
    }
    public static function getPublicUrl()
    {
        return defined('WP_PM_PLUGINURL') ? WP_PM_PLUGINURL.'public/' : plugin_dir_url(__FILE__).'../public/';
    }
    public static function getVersion()
    {
        return defined('WP_PM_VERSION') ? WP_PM_VERSION : '1.0.0';
    }
}
