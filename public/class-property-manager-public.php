<?php

/**
 * This class manage the initialization of public assets 
 */
class WP_Property_Manager_Public extends WP_Property_Manager_Base
{
    /**
     * @return void
     */
    public static function enqueue_scripts()
    {
        wp_enqueue_style( self::getCPT().'-public-script', self::getPublicUrl() . 'css/wp_property_manager.css',[], self::getVersion(), false );
        wp_enqueue_script(self::getCPT().'font-awesome', 'https://kit.fontawesome.com/d75d87c174.js');
    }

    /**
     * Initialize the public classes
     * @param null $initClasses
     * @return void
     */
    public static function init($initClasses = null)
    {
        add_action('wp_enqueue_scripts', [self::class,'enqueue_scripts']);

        if (!is_null($initClasses) && is_array($initClasses)) {
            foreach ($initClasses as $class) {
                $class::init();
            }
        }
    }
}
