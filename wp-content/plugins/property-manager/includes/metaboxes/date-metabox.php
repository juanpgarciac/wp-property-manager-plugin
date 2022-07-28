<?php

class WP_Property_Manager_CreationDate_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'creationdate';
        $this->meta_key = '_creationdate';
        $this->title = 'Creation date:';
        $this->description = 'Creation date:';
        parent::__construct();
    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>
        <div>
            <input type="date" name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" value="<?=$this->getValue($post)?>" >
        </div>
    <?php
    }
}