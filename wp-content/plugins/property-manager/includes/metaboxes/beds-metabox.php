<?php

class WP_Property_Manager_Beds_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'beds';
        $this->meta_key = '_beds';
        $this->title = 'Beds Qty:';
        $this->description = 'How many beds?';
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $this->label()
        ?>        
        <div><input type="number" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" value="<?=$this->getValue($post,0);?>" /></div>
        <?php
    }

}