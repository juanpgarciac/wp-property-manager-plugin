<?php

class WP_Property_Manager_Garage_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'garage';
        $this->meta_key = '_garage';
        $this->title = 'Garage:';
        $this->description = 'Does the property have a garage?';
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        ?>
        <label for="<?=$this->getFieldID()?>"><?=$this->description?></label>;
        <div>
            <input type="radio" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>-yes" value="yes" <?=$this->getValue($post)=='yes'?'checked':'';?>  />Yes &nbsp;
            <input type="radio" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>-no" value="no"  <?=$this->getValue($post,'no')=='no'?'checked':'';?>  />No
        </div>
        <?php
    }

}