<?php

class WP_Property_Manager_Taxonomy extends WP_Property_Manager_Base
{

    public static function register_location()
    {
        $labels = array(
            'name'                       => _x( 'Locations', 'Locations', WP_PM_DOMAIN ),
            'singular_name'              => _x( 'Location', 'Location', WP_PM_DOMAIN ),
            'menu_name'                  => __( 'Taxonomy', WP_PM_DOMAIN ),
            'all_items'                  => __( 'All Items', WP_PM_DOMAIN ),
            'parent_item'                => __( 'Parent Item', WP_PM_DOMAIN ),
            'parent_item_colon'          => __( 'Parent Item:', WP_PM_DOMAIN ),
            'new_item_name'              => __( 'New Item Name', WP_PM_DOMAIN ),
            'add_new_item'               => __( 'Add New Item', WP_PM_DOMAIN ),
            'edit_item'                  => __( 'Edit Item', WP_PM_DOMAIN ),
            'update_item'                => __( 'Update Item', WP_PM_DOMAIN ),
            'view_item'                  => __( 'View Item', WP_PM_DOMAIN ),
            'separate_items_with_commas' => __( 'Separate items with commas', WP_PM_DOMAIN ),
            'add_or_remove_items'        => __( 'Add or remove items', WP_PM_DOMAIN ),
            'choose_from_most_used'      => __( 'Choose from the most used', WP_PM_DOMAIN ),
            'popular_items'              => __( 'Popular Items', WP_PM_DOMAIN ),
            'search_items'               => __( 'Search Items', WP_PM_DOMAIN ),
            'not_found'                  => __( 'Not Found', WP_PM_DOMAIN ),
            'no_terms'                   => __( 'No items', WP_PM_DOMAIN ),
            'items_list'                 => __( 'Items list', WP_PM_DOMAIN ),
            'items_list_navigation'      => __( 'Items list navigation', WP_PM_DOMAIN ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'property-cpt-location', array( self::getCPT() ), $args );
    }

    public static function init()
    {
        add_action( 'init', [self::class,'register_location'], 0 );
    }


}