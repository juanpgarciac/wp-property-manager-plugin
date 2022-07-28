<?php

class WP_Property_Manager_Type_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->setID('housetype');
        $this->setTitle('House Type:');
        $this->setDescription('Select house type');
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $options = [
            "" =>  __('Please select',self::getDomain()),
            "custom-homes"=>__('Custom Homes',self::getDomain()),
            "residential"=>__('Residential',self::getDomain()),
            "single-family"=>__('Single family',self::getDomain()),
            "duplex"=>__('Duplex',self::getDomain()),
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