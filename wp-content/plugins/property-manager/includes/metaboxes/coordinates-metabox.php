<?php

class WP_Property_Manager_Coordinates_Metabox extends WP_Property_Manager_Metabox_Base
{
    
    public function __construct()
    {
        $this->id = 'coordinates';
        $this->title = 'Coordinates Group:';
        $this->description = 'Please input he coordinates (Lat, Lon)';
        parent::__construct();

    }

    public function custom_box_html( $post )
    {
        $this->label();
        $value = unserialize($this->getValue($post,serialize(['lon'=>0.0, 'lat'=>0.0])));
        ?>        
        <div>
            Lon:  <input name="<?=$this->getFieldID()?>_lon" id="<?=$this->getFieldID()?>_lon" value="<?=$value['lon']?>" />
            Lat: <input name="<?=$this->getFieldID()?>_lat" id="<?=$this->getFieldID()?>_lat" value="<?=$value['lat']?>" />
        </div>
        <?php
    }

    public function save_postdata( $post_id ) {
        if ( array_key_exists( $this->getFieldID().'_lon', $_POST )  
             && array_key_exists( $this->getFieldID().'_lat', $_POST ) ) {

            //$value = $_POST[$this->getFieldID().'_lon'].'|'.$_POST[$this->getFieldID().'_lat'];

            $s = ['lon' => $_POST[$this->getFieldID().'_lon'], 'lat' => $_POST[$this->getFieldID().'_lat']];
            $value = serialize($s);
            update_post_meta(
                $post_id,
                $this->getMetaKey(),
                $value
            );
        }
    }

}