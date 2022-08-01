<?php

/**
 * This class handle the custom meta field visuals and behavior
 */
class WP_Property_Manager_Metabox_Base extends WP_Property_Manager_Base
{
    public const field_base = 'wp_property_manager';
    /**
     * @var string
     */
    private $id = 'default_base_id';
    /**
     * @var string
     */
    private $title = '_default_base_title';
    /**
     * @var string
     */
    private $description = '_defaut_base_description';


    public function __construct()
    {
        //Only if admin, hook to adminside functions
        if (is_admin()) {
            add_action('add_meta_boxes', [$this, 'add_custom_box']);
            add_action('save_post', [$this, 'save_postdata']);
            add_action('admin_enqueue_scripts', [$this,'enqueue_scripts']);
        }
    }

    /**
     * generates an Metabox instance
     * @return WP_Property_Manager_Metabox_Base
     */
    public static function init()
    {
        return new static();
    }

    /**
     * @return void
     */
    public function enqueue_scripts()
    {
    }

    /**
     * sets the metabox ID
     * @param mixed $id
     *
     * @return void
     */
    public function setID($id)
    {
        $this->id = $id;
    }

    /**
     * Sets the metabox title label
     * @param mixed $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Sets the metabox description label
     * @param mixed $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Gets metabox title label
     * @return string
     */
    public function getTitle()
    {
        return __($this->title, self::getDomain());
    }

    /**
     * Gets metabox description label
     * @return [type]
     */
    public function getDescription()
    {
        return __($this->description, self::getDomain());
    }

    /**
     * Gets the metabox ID
     * @return string
     */
    public function getID()
    {
        return $this->id;
    }


    /**
     * Gets the metabox value from the post_meta
     * If no post object is sent, it will use get_post() WP function to retrieve it
     * @param null $post
     * @param null $default
     *
     * @return mixed
     */
    public function getValue($post = null, $default = null)
    {
        $post = $post ? $post : get_post();
        $value = get_post_meta($post->ID, $this->getMetaKey(), true);
        return $value ? $value : $default;
    }

    /**
     * Gets the field's ID for HTML rendering and meta key use
     * @return string
     */
    protected function getFieldID()
    {
        return self::field_base .'_'. $this->getID();
    }

    /**
     * Gets the field's formatted metakey
     * @return string
     */
    public function getMetaKey()
    {
        return '_'.$this->getFieldID();
    }

    /**
     * set the custom box for the current metabox
     * @return void
     */
    public function add_custom_box()
    {
        add_meta_box(
            $this->getFieldID(),        // Unique ID
            $this->getTitle(),               // Box title
            [$this,'custom_box_html'],  //Content callback, must be of type callable
            self::getCPT()              // Post type
        );
    }

    /**
     * Renders HTML label for the metabox
     * @param bool $print
     *
     * @return void
     */
    public function label($print = true)
    {
        ?>
            <label for="<?=$this->getFieldID()?>"><?=__($this->getDescription(), self::getDomain())?></label>
        <?php
    }

    /**
     * Renders HTML input for the metabox
     * @param mixed $post
     *
     * @return void
     */
    public function custom_box_html($post)
    {
        $this->label(); ?>        
        <div><input name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>" value="<?=$this->getValue($post); ?>" /></div>
        <?php
    }

    /**
     * Handles the meta value saving/update
     * @param mixed $post_id
     *
     * @return void
     */
    public function save_postdata($post_id)
    {
        if (array_key_exists($this->getFieldID(), $_POST)) {
            update_post_meta(
                $post_id,
                $this->getMetaKey(),
                $_POST[$this->getFieldID()]
            );
        }
    }
}

/**
 * Class to handle the metabox when it refers a Taxonomy
 */
class WP_Property_Manager_Metabox_Taxonomy_Base extends WP_Property_Manager_Metabox_Base
{
    private $taxonomy = null;

    /**
     * Sets the metabox taxonomy
     * @param mixed $taxonomy
     *
     * @return void
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * Gets metabox taxonomy
     * @return string
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * Indicates if the current mextabox is/have a taxomy
     * @return boolean
     */
    public function isTaxonomy()
    {
        return !is_null($this->getTaxonomy()) && !empty($this->getTaxonomy());
    }

    /**
     * Handles the meta value saving/update and the corresponding taxonomy relation
     * @param mixed $post_id
     *
     * @return void
     */
    public function save_postdata($post_id)
    {
        if (array_key_exists($this->getFieldID(), $_POST)) {
            update_post_meta(
                $post_id,
                $this->getMetaKey(),
                $_POST[$this->getFieldID()]
            );
            if ($this->isTaxonomy()) {
                //delete all relation for this taxonomy with the post
                wp_delete_object_term_relationships($post_id, $this->getTaxonomy());
                //then set new relation
                wp_set_post_terms($post_id, $_POST[$this->getFieldID()], $this->getTaxonomy());
            }
        }
    }

    /**
     * Renders HTML input for the metabox with taxonomy selection helper
     * @param mixed $post
     *
     * @return void
     */
    public function custom_box_html($post)
    {
        $this->label(); ?>        
        <div>
            <select name="<?=$this->getFieldID()?>" id="<?=$this->getFieldID()?>">
                <option value=""><?=__('Please select', self::getDomain())?></option>
                <?php

                    $taxonomy = get_taxonomy($this->getTaxonomy());
        $term_query = get_terms(array(
                        'taxonomy' => $this->getTaxonomy(),
                        'hide_empty' => false,
                    ));


        if (! empty($term_query)) {
            foreach ($term_query as $term) {
                $identifier = $taxonomy->hierarchical ? $term->term_id : $term->name; ?> <option value="<?=$identifier?>" <?=$this->getValue($post)==$identifier ? 'selected' : ''; ?>><?=$term->name?></option><?php
            }
        } ?>
            </select>
        </div>
        <?php
    }
}
