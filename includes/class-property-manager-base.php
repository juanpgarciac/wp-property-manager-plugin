<?php

abstract class WP_Property_Manager_Base
{
    static public function init(){}

    static public function getCPT(){
        return defined('WP_PM_CPT')?WP_PM_CPT:'property-manager-cpt';
    }

    static public function getDomain(){
        return defined('WP_PM_DOMAIN')?WP_PM_DOMAIN:'property-manager-domain';
    }

    static public function getAdminDir(){
        return defined('WP_PM_PLUGINDIR')?WP_PM_PLUGINDIR.'admin/':plugin_dir_path( __FILE__ ).'../admin/';
    }
    static public function getAdminUrl(){
        return defined('WP_PM_PLUGINURL')?WP_PM_PLUGINURL.'admin/':plugin_dir_url( __FILE__ ).'../admin/';
    }
    static public function getPublicDir(){
        return defined('WP_PM_PLUGINDIR')?WP_PM_PLUGINDIR.'public/':plugin_dir_path( __FILE__ ).'../public/';
    }
    static public function getPublicUrl(){
        return defined('WP_PM_PLUGINURL')?WP_PM_PLUGINURL.'public/':plugin_dir_url( __FILE__ ).'../public/';
    }
    static public function getVersion(){
        return defined('WP_PM_VERSION')?WP_PM_VERSION:'1.0.0';
    }

}