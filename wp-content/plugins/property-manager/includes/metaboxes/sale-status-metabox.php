<?php

class WP_Property_Manager_Sale_Status_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('salestatus');
        $this->setTitle('Sale status:');
        $this->setDescription('Select status');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_SALE_STATUS);
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>        
        <div>
            <select name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>">
                <option><?=__('Please select',self::getDomain())?></option>
                <?php
                    $term_query = get_terms( array(
                        'taxonomy' => $this->getTaxonomy(),
                        'hide_empty' => false,
                    ) );
                    if ( ! empty( $term_query ) ) {
                        foreach ( $term_query as $term ) {
                            ?> <option value="<?=$term->term_id?>" <?=$this->getValue($post)==$term->term_id?'selected':'';?>><?=$term->name?></option><?php
                        }
                    }
                ?>
            </select>
        </div>
        <?php
    }

}