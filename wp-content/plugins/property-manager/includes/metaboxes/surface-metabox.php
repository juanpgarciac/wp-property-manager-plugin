<?php

class WP_Property_Manager_Surface_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'surface';
        $this->meta_key = '_surface';
        $this->title = 'Sq Foots:';
        $this->description = 'Property surface (sq foots)';
        parent::__construct();
    }

}