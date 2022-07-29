<?php

class WP_Property_Manager_Taxonomy extends WP_Property_Manager_Base
{
    const TAX_LOCATION = 'property-cpt-location';
    
    const TAX_SALE_STATUS = 'property-cpt-sale-status';
    
    const TAX_CONSTRUCTION_STATUS = 'property-cpt-construction-status';

    const TAX_HOUSE_TYPE = 'property-cpt-house-type';

    const TAX_ARRAY = [
        self::TAX_LOCATION, 
        self::TAX_SALE_STATUS, 
        self::TAX_CONSTRUCTION_STATUS,
        self::TAX_HOUSE_TYPE
    ];

    public static function register_location()
    {
        $labels = array(
            'name'                       => _x( 'Locations', 'Locations', WP_PM_DOMAIN ),
            'singular_name'              => _x( 'Location', 'Location', WP_PM_DOMAIN ),
            'menu_name'                  => __( 'Location', WP_PM_DOMAIN ),
            'all_items'                  => __( 'All locations', WP_PM_DOMAIN ),
            'parent_item'                => __( 'Parent Location', WP_PM_DOMAIN ),
            'parent_item_colon'          => __( 'Parent Location:', WP_PM_DOMAIN ),
            'new_item_name'              => __( 'New Locationm Name', WP_PM_DOMAIN ),
            'add_new_item'               => __( 'Add New Location', WP_PM_DOMAIN ),
            'edit_item'                  => __( 'Edit Location', WP_PM_DOMAIN ),
            'update_item'                => __( 'Update Location', WP_PM_DOMAIN ),
            'view_item'                  => __( 'View Location', WP_PM_DOMAIN ),
            'separate_items_with_commas' => __( 'Separate locations with commas', WP_PM_DOMAIN ),
            'add_or_remove_items'        => __( 'Add or remove locations', WP_PM_DOMAIN ),
            'choose_from_most_used'      => __( 'Choose from the most used', WP_PM_DOMAIN ),
            'popular_items'              => __( 'Popular Locations', WP_PM_DOMAIN ),
            'search_items'               => __( 'Search Locations', WP_PM_DOMAIN ),
            'not_found'                  => __( 'Not Found', WP_PM_DOMAIN ),
            'no_terms'                   => __( 'No locations', WP_PM_DOMAIN ),
            'items_list'                 => __( 'Locations list', WP_PM_DOMAIN ),
            'items_list_navigation'      => __( 'Locations list navigation', WP_PM_DOMAIN ),
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
        register_taxonomy( self::TAX_LOCATION, array( self::getCPT() ), $args );
    }


    public static function register_sale_status()
    {
        $labels = array(
            'name'                       => _x( 'Sale status', 'Sale status', WP_PM_DOMAIN ),
            'singular_name'              => _x( 'Sale status', 'Sale status', WP_PM_DOMAIN ),
            'menu_name'                  => __( 'Sale status', WP_PM_DOMAIN ),
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
            'show_in_quick_edit'         => false,
            'meta_box_cb'                => false,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( self::TAX_SALE_STATUS, array( self::getCPT() ), $args );
    }


    public static function init()
    {
        add_action( 'init', [self::class,'register_location'], 0 );
        add_action( 'init', [self::class,'register_sale_status'], 0 );
    }


}