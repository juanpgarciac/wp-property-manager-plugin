<?php

class WP_Property_Manager_Metabox_Base extends WP_Property_Manager_Base
{

    private $field_base = 'wp_property_manager_';
    private $id = 'default_base_id';
    private $title = '_default_base_title';
    private $description = '_defaut_base_description';
    private $taxonomy = null;
    static private $instance;

    public function __construct(){
        add_action( 'add_meta_boxes', [$this, 'add_custom_box']);
        add_action( 'save_post', [$this, 'save_postdata']);
        add_action('admin_enqueue_scripts',[$this,'enqueue_scripts']);
    }  

    static public function init()
    {
        return new static();
    }

    public function enqueue_scripts(){ }

    public function setID($id){
        $this->id = $id;        
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setTaxonomy($taxonomy){
        $this->taxonomy = $taxonomy;
    }

    public function getTaxonomy(){
        return $this->taxonomy;
    }

    public function isTaxonomy(){
        return !is_null($this->getTaxonomy()) && !empty($this->getTaxonomy());
    }

    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }

    public function getID(){
        return $this->id;
    }


    protected function getValue($post,$default = null)
    {
        $value = get_post_meta( $post->ID, $this->getMetaKey(), true );
        return $value?$value:$default;
    }

    protected  function getFieldID(){
        return $this->field_base . $this->getID();
    }

    protected  function getMetaKey(){
        return '_'.$this->getFieldID();
    }

    public function add_custom_box()
    {
        add_meta_box(
            $this->getFieldID(),        // Unique ID
            $this->getTitle(),               // Box title
            [$this,'custom_box_html'],  //Content callback, must be of type callable
            self::getCPT()              // Post type
        );
    }

    public function label($print = true)
    {
        ?>
            <label for="<?=$this->getFieldID()?>"><?=__($this->getDescription(),self::getDomain())?></label>
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
                $this->getMetaKey(),
                $_POST[$this->getFieldID()]
            );
            if($this->isTaxonomy()){
                wp_delete_object_term_relationships($post_id, $this->getTaxonomy());
                wp_set_post_terms($post_id, $_POST[$this->getFieldID()], $this->getTaxonomy());
            }
        }
    }

}