<?php

class WP_Property_Manager_CPT extends WP_Property_Manager_Base
{
    public static function register_cpt()
    {
        $labels = array(
            'name'                  => _x( 'Properties', 'Post Type General Name', WP_PM_DOMAIN ),
            'singular_name'         => _x( 'Property', 'Post Type Singular Name', WP_PM_DOMAIN ),
            'menu_name'             => __( 'Properties manager', WP_PM_DOMAIN ),
            'name_admin_bar'        => __( 'Property manager', WP_PM_DOMAIN ),
            'archives'              => __( 'Property Archives', WP_PM_DOMAIN ),
            'attributes'            => __( 'Property Attributes', WP_PM_DOMAIN ),
            'parent_item_colon'     => __( 'Parent Property:', WP_PM_DOMAIN ),
            'all_items'             => __( 'All Properties', WP_PM_DOMAIN ),
            'add_new_item'          => __( 'Add New Property', WP_PM_DOMAIN ),
            'add_new'               => __( 'Add New', WP_PM_DOMAIN ),
            'new_item'              => __( 'New Property', WP_PM_DOMAIN ),
            'edit_item'             => __( 'Edit Property', WP_PM_DOMAIN ),
            'update_item'           => __( 'Update Property', WP_PM_DOMAIN ),
            'view_item'             => __( 'View Property', WP_PM_DOMAIN ),
            'view_items'            => __( 'View Properties', WP_PM_DOMAIN ),
            'search_items'          => __( 'Search Property', WP_PM_DOMAIN ),
            'not_found'             => __( 'Not found', WP_PM_DOMAIN ),
            'not_found_in_trash'    => __( 'Not found in Trash', WP_PM_DOMAIN ),
            'featured_image'        => __( 'Featured Image', WP_PM_DOMAIN ),
            'set_featured_image'    => __( 'Set featured image', WP_PM_DOMAIN ),
            'remove_featured_image' => __( 'Remove featured image', WP_PM_DOMAIN ),
            'use_featured_image'    => __( 'Use as featured image', WP_PM_DOMAIN ),
            'insert_into_item'      => __( 'Insert into item', WP_PM_DOMAIN ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', WP_PM_DOMAIN ),
            'items_list'            => __( 'Property list', WP_PM_DOMAIN ),
            'items_list_navigation' => __( 'Property list navigation', WP_PM_DOMAIN ),
            'filter_items_list'     => __( 'Filter property list', WP_PM_DOMAIN ),
        );
        $args = array(
            'label'                 => __( 'Property', WP_PM_DOMAIN ),
            'description'           => __( 'Property description', WP_PM_DOMAIN ),
            'labels'                => $labels,
            array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type( self::getCPT(), $args );
        
    }

    public static function init()
    {
        add_action( 'init', [self::class,'register_cpt'], 0 );
    }


}