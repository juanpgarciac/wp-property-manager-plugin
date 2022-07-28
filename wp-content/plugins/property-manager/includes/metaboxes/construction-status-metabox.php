<?php

class WP_Property_Manager_Construction_Status_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'constructionstatus';
        $this->title = 'Construction status:';
        $this->description = 'Select status';
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $options = [
            "" =>  __('Please select',self::getDomain()),
            "on-construction"=>__('On construction',self::getDomain()),
            "pending"=>__('Pending',self::getDomain()),
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