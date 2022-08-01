<?php

class WP_Property_Manager_Public extends WP_Property_Manager_Base
{
    public static function enqueue_scripts()
    {
        //wp_enqueue_script( self::getCPT().'-public-script', self::getPublicUrl() . 'js/wp_property_manager.js', array( 'jquery' ), self::getVersion(), false );
        wp_enqueue_script(self::getCPT().'font-awesome', 'https://kit.fontawesome.com/d75d87c174.js');
    }

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
