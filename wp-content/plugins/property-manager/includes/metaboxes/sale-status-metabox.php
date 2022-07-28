<?php

class WP_Property_Manager_Sale_Status_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'salestatus';
        $this->meta_key = '_salestatus';
        $this->title = 'Sale status:';
        $this->description = 'Select status';
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $options = [
            "" =>  __('Please select',self::getDomain()),
            "on-sale"=>__('On sale',self::getDomain()),
            "sold"=>__('Sold',self::getDomain()),
        ];
        $this->label();
        ?>        
        <div>
            <select name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>">
                <?php
                foreach($options as $k => $o){
                    ?><option value="<?=$k?>"  <?=$this->getValue($post)==$k?'selected':'';?>  ><?=$o?></option><?php
                }
                ?>
            </select>
        </div>
        <?php
    }

}