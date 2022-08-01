<?php

class WP_Property_Manager_Type_Metabox extends WP_Property_Manager_Metabox_Taxonomy_Base
{
    
    public function __construct()
    {
        $this->setID('housetype');
        $this->setTitle('House Type:');
        $this->setDescription('Select house type');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_HOUSE_TYPE);
        parent::__construct();

    }

}