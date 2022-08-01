<?php

class WP_Property_Manager_Garage_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('garage');
        $this->setTitle('Garage:');
        $this->setDescription('How many cars fit on the property garage?');
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