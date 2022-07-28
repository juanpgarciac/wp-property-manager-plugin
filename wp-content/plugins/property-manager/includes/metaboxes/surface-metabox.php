<?php

class WP_Property_Manager_Surface_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('surface');
        $this->setTitle('Sq Foots:');
        $this->setDescription('Property surface (sq foots)');
        parent::__construct();
    }

}