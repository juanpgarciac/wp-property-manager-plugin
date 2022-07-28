<?php

class WP_Property_Manager_Garage_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('garage');
        $this->setTitle('Garage:');
        $this->setDescription('Does the property have a garage?');
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $this->label()
        ?>
        <div>
            <input type="radio" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>-yes" value="yes" <?=$this->getValue($post)=='yes'?'checked':'';?>  />Yes &nbsp;
            <input type="radio" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>-no" value="no"  <?=$this->getValue($post,'no')=='no'?'checked':'';?>  />No
        </div>
        <?php
    }

}