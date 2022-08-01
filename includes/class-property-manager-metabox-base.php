<?php

class WP_Property_Manager_Metabox_Base extends WP_Property_Manager_Base
{

    const field_base = 'wp_property_manager';
    private $id = 'default_base_id';
    private $title = '_default_base_title';
    private $description = '_defaut_base_description';

    static private $instance;

    public function __construct(){
        if(is_admin()){
            add_action( 'add_meta_boxes', [$this, 'add_custom_box']);
            add_action( 'save_post', [$this, 'save_postdata']);
            add_action('admin_enqueue_scripts',[$this,'enqueue_scripts']);
        }

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

    public function getTitle(){
        return __($this->title,self::getDomain());
    }
    public function getDescription(){
        return __($this->description,self::getDomain());
    }

    public function getID(){
        return $this->id;
    }


    public function getValue($post = null,$default = null)
    {   
        $post = $post ? $post : get_post();
        $value = get_post_meta( $post->ID, $this->getMetaKey(), true );
        return $value?$value:$default;
    }

    protected  function getFieldID(){
        return self::field_base .'_'. $this->getID();
    }

    public  function getMetaKey(){
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
        }
    }

}

class WP_Property_Manager_Metabox_Taxonomy_Base extends WP_Property_Manager_Metabox_Base
{
    private $taxonomy = null;

    public function setTaxonomy($taxonomy){
        $this->taxonomy = $taxonomy;
    }

    public function getTaxonomy(){
        return $this->taxonomy;
    }

    public function isTaxonomy(){
        return !is_null($this->getTaxonomy()) && !empty($this->getTaxonomy());
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

    public function custom_box_html( $post )
    {
        $this->label();
        ?>        
        <div>
            <select name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>">
                <option value=""><?=__('Please select',self::getDomain())?></option>
                <?php

                    $taxonomy = get_taxonomy($this->getTaxonomy());
                    $term_query = get_terms( array(
                        'taxonomy' => $this->getTaxonomy(),
                        'hide_empty' => false,
                    ) );

                    
                    if ( ! empty( $term_query ) ) {
                        foreach ( $term_query as $term ) {                            
                            $identifier = $taxonomy->hierarchical?$term->term_id:$term->name;                            
                            ?> <option value="<?=$identifier?>" <?=$this->getValue($post)==$identifier?'selected':'';?>><?=$term->name?></option><?php
                        }
                    }
                ?>
            </select>
        </div>
        <?php
    }
}