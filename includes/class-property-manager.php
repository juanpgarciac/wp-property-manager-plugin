<?php

/**
 * Handles the general initializations
 */
class WP_Property_Manager extends WP_Property_Manager_Base
{
    public static function init($initClasses = null)
    {
        if (!is_null($initClasses) && is_array($initClasses)) {
            foreach ($initClasses as $class) {
                $class::init();
            }
        }
    }
}
