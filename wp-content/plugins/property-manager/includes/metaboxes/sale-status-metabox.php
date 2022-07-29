<?php

class WP_Property_Manager_Sale_Status_Metabox extends WP_Property_Manager_Metabox_Taxonomy_Base
{
    
    public function __construct()
    {
        $this->setID('salestatus');
        $this->setTitle('Sale status:');
        $this->setDescription('Select status');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_SALE_STATUS);
        parent::__construct();

    }

}