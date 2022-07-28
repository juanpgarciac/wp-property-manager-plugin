<?php

class WP_Property_Manager_Bath_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'bath';
        $this->meta_key = '_bath';
        $this->title = 'Baths Qty:';
        $this->description = 'Bath quantity:';
        parent::__construct();
    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>
        <div>
            <input type="number" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" value="<?=$this->getValue($post,0);?>" />
        </div>
        <?php
    }
}