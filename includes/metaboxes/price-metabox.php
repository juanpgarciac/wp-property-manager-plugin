<?php

class WP_Property_Manager_Price_Metabox extends WP_Property_Manager_Metabox_Base
{
    public function __construct()
    {
        $this->setID('price');
        $this->setTitle('Price:');
        $this->setDescription('Property price');
        parent::__construct();
    }
}
