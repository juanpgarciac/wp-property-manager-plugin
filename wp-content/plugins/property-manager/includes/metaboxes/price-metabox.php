<?php

class WP_Property_Manager_Price_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'price';
        $this->meta_key = '_price';
        $this->title = 'Price:';
        $this->description = 'Property price';
        parent::__construct();

    }

}