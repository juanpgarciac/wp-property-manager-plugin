<?php

abstract class WP_Property_Manager_Base
{
    static public function init(){}

    static public function getCPT(){
        return !defined('WP_PM_CPT')?:'property-manager-cpt';
    }

    static public function getDomain(){
        return !defined('WP_PM_DOMAIN')?:'property-manager-domain';
    }

}