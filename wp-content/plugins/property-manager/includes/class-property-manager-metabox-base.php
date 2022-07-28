<?php

class WP_Property_Manager_Metabox_Base extends WP_Property_Manager_Base
{

     private $field_base = 'wp_property_manager_';
     protected $id = 'default_base_id';
     protected $meta_key = '_default_meta_key';
     protected $title = '_default_base_title';
     protected $description = '_defaut_base_description';

    static private $instance;

    public function __construct(){
        add_action( 'add_meta_boxes', [$this, 'add_custom_box']);
        add_action( 'save_post', [$this, 'save_postdata']);
    }  

    static public function init()
    {
        return new static();
    }

    protected function getValue($post,$default = null)
    {
        $value = get_post_meta( $post->ID, $this->meta_key, true );
        return $value?$value:$default;
    }

    protected  function getFieldID(){
        return $this->field_base . $this->id;
    }

    public function add_custom_box()
    {
        add_meta_box(
            $this->getFieldID(),        // Unique ID
            $this->title,               // Box title
            [$this,'custom_box_html'],  //Content callback, must be of type callable
            self::getCPT()              // Post type
        );
    }

    public function label($print = true)
    {
        ?>
            <label for="<?=$this->getFieldID()?>"><?=__($this->description,self::getDomain())?></label>
        <?php
    }

    public function custom_box_html( $post )
    {
        $this->label();
        ?>        
        <div><input name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" value="<?=$this->getValue($post);?>" /></div>
        <?php
    }

    public function save_postdata( $post_id ) {
        if ( array_key_exists( $this->getFieldID(), $_POST ) ) {
            update_post_meta(
                $post_id,
                $this->meta_key,
                $_POST[$this->getFieldID()]
            );
        }
    }

}