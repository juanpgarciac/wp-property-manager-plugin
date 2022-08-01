<?php

class WP_Property_Manager_Construction_Status_Metabox extends WP_Property_Manager_Metabox_Taxonomy_Base
{
    
    public function __construct()
    {
        $this->setID('constructionstatus');
        $this->setTitle('Construction status:');
        $this->setDescription('Select status');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS);
        parent::__construct();

    }



}