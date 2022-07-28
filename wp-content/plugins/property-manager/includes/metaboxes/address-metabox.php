<?php

class WP_Property_Manager_Address_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'address';
        $this->meta_key = '_address';
        $this->title = 'Address:';
        $this->description = 'Property address:';
        parent::__construct();
    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>
        <div>
            <textarea name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" cols="100"><?=$this->getValue($post)?></textarea>
        </div>
    <?php
    }
}