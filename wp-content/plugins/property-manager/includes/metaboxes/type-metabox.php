<?php

class WP_Property_Manager_Type_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('housetype');
        $this->setTitle('House Type:');
        $this->setDescription('Select house type');
        $this->setTaxonomy(WP_Property_Manager_Taxonomy::TAX_HOUSE_TYPE);
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