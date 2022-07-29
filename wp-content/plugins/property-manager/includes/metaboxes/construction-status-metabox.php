<?php

class WP_Property_Manager_Construction_Status_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('constructionstatus');
        $this->setTitle('Construction status:');
        $this->setDescription('Select status');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS);
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>        
        <div>
            <select name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>">
                <option value=""><?=__('Please select',self::getDomain())?></option>
                <?php

                    $taxonomy = get_taxonomy($this->getTaxonomy());
                    $term_query = get_terms( array(
                        'taxonomy' => $this->getTaxonomy(),
                        'hide_empty' => false,
                    ) );

                    
                    if ( ! empty( $term_query ) ) {
                        foreach ( $term_query as $term ) {                            
                            $identifier = $taxonomy->hierarchical?$term->term_id:$term->name;                            
                            ?> <option value="<?=$identifier?>" <?=$this->getValue($post)==$identifier?'selected':'';?>><?=$term->name?></option><?php
                        }
                    }
                ?>
            </select>
        </div>
        <?php
    }

}