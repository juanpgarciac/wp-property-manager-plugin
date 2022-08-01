<?php

class WP_Property_Manager_Taxonomy extends WP_Property_Manager_Base
{
    public const TAX_LOCATION = 'property-cpt-location';

    public const TAX_SALE_STATUS = 'property-cpt-sale-status';

    public const TAX_CONSTRUCTION_STATUS = 'property-cpt-construction-status';

    public const TAX_HOUSE_TYPE = 'property-cpt-house-type';

    public const TAX_ARRAY = [
        self::TAX_LOCATION,
        self::TAX_SALE_STATUS,
        self::TAX_CONSTRUCTION_STATUS,
        self::TAX_HOUSE_TYPE
    ];

    public static function register_location()
    {
        $labels = array(
            'name'                       => _x('Locations', 'Locations', WP_PM_DOMAIN),
            'singular_name'              => _x('Location', 'Location', WP_PM_DOMAIN),
            'menu_name'                  => __('Location', WP_PM_DOMAIN),
            'all_items'                  => __('All locations', WP_PM_DOMAIN),
            'parent_item'                => __('Parent Location', WP_PM_DOMAIN),
            'parent_item_colon'          => __('Parent Location:', WP_PM_DOMAIN),
            'new_item_name'              => __('New Locationm Name', WP_PM_DOMAIN),
            'add_new_item'               => __('Add New Location', WP_PM_DOMAIN),
            'edit_item'                  => __('Edit Location', WP_PM_DOMAIN),
            'update_item'                => __('Update Location', WP_PM_DOMAIN),
            'view_item'                  => __('View Location', WP_PM_DOMAIN),
            'separate_items_with_commas' => __('Separate locations with commas', WP_PM_DOMAIN),
            'add_or_remove_items'        => __('Add or remove locations', WP_PM_DOMAIN),
            'choose_from_most_used'      => __('Choose from the most used', WP_PM_DOMAIN),
            'popular_items'              => __('Popular Locations', WP_PM_DOMAIN),
            'search_items'               => __('Search Locations', WP_PM_DOMAIN),
            'not_found'                  => __('Not Found', WP_PM_DOMAIN),
            'no_terms'                   => __('No locations', WP_PM_DOMAIN),
            'items_list'                 => __('Locations list', WP_PM_DOMAIN),
            'items_list_navigation'      => __('Locations list navigation', WP_PM_DOMAIN),
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
        register_taxonomy(self::TAX_LOCATION, array( self::getCPT() ), $args);
    }


    public static function register_sale_status()
    {
        $labels = array(
            'name'                       => _x('Sale status', 'Sale status', WP_PM_DOMAIN),
            'singular_name'              => _x('Sale status', 'Sale status', WP_PM_DOMAIN),
            'menu_name'                  => __('Sale status', WP_PM_DOMAIN),
            'all_items'                  => __('All Sale status', WP_PM_DOMAIN),
            'parent_item'                => __('Parent Sale status', WP_PM_DOMAIN),
            'parent_item_colon'          => __('Parent Sale status:', WP_PM_DOMAIN),
            'new_item_name'              => __('New Sale status Name', WP_PM_DOMAIN),
            'add_new_item'               => __('Add New Sale status', WP_PM_DOMAIN),
            'edit_item'                  => __('Edit Sale status', WP_PM_DOMAIN),
            'update_item'                => __('Update Sale status', WP_PM_DOMAIN),
            'view_item'                  => __('View Sale status', WP_PM_DOMAIN),
            'separate_items_with_commas' => __('Separate sale status with commas', WP_PM_DOMAIN),
            'add_or_remove_items'        => __('Add or remove sale status', WP_PM_DOMAIN),
            'choose_from_most_used'      => __('Choose from the most used', WP_PM_DOMAIN),
            'popular_items'              => __('Popular Sale status', WP_PM_DOMAIN),
            'search_items'               => __('Search Sale status', WP_PM_DOMAIN),
            'not_found'                  => __('Not Found', WP_PM_DOMAIN),
            'no_terms'                   => __('No sale status', WP_PM_DOMAIN),
            'items_list'                 => __('Sale status list', WP_PM_DOMAIN),
            'items_list_navigation'      => __('Sale status list navigation', WP_PM_DOMAIN),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_in_quick_edit'         => false,
            'meta_box_cb'                => false,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy(self::TAX_SALE_STATUS, array( self::getCPT() ), $args);
    }

    public static function register_construction_status()
    {
        $labels = array(
            'name'                       => _x('Construction status', 'Construction status', WP_PM_DOMAIN),
            'singular_name'              => _x('Construction status', 'Construction status', WP_PM_DOMAIN),
            'menu_name'                  => __('Construction status', WP_PM_DOMAIN),
            'all_items'                  => __('All Construction status', WP_PM_DOMAIN),
            'parent_item'                => __('Parent Construction status', WP_PM_DOMAIN),
            'parent_item_colon'          => __('Parent Construction status:', WP_PM_DOMAIN),
            'new_item_name'              => __('New Construction status Name', WP_PM_DOMAIN),
            'add_new_item'               => __('Add New Construction status', WP_PM_DOMAIN),
            'edit_item'                  => __('Edit Construction status', WP_PM_DOMAIN),
            'update_item'                => __('Update Construction status', WP_PM_DOMAIN),
            'view_item'                  => __('View Construction status', WP_PM_DOMAIN),
            'separate_items_with_commas' => __('Separate construction status with commas', WP_PM_DOMAIN),
            'add_or_remove_items'        => __('Add or remove construction status ', WP_PM_DOMAIN),
            'choose_from_most_used'      => __('Choose from the most used', WP_PM_DOMAIN),
            'popular_items'              => __('Popular Construction status', WP_PM_DOMAIN),
            'search_items'               => __('Search Construction status', WP_PM_DOMAIN),
            'not_found'                  => __('Not Found', WP_PM_DOMAIN),
            'no_terms'                   => __('No construction status ', WP_PM_DOMAIN),
            'items_list'                 => __('Construction status list', WP_PM_DOMAIN),
            'items_list_navigation'      => __('Construction status list navigation', WP_PM_DOMAIN),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_in_quick_edit'         => false,
            'meta_box_cb'                => false,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy(self::TAX_CONSTRUCTION_STATUS, array( self::getCPT() ), $args);
    }

    public static function register_house_type()
    {
        $labels = array(
            'name'                       => _x('House Type', 'House Type', WP_PM_DOMAIN),
            'singular_name'              => _x('House Type', 'House Type', WP_PM_DOMAIN),
            'menu_name'                  => __('House Type', WP_PM_DOMAIN),
            'all_items'                  => __('All House Types', WP_PM_DOMAIN),
            'parent_item'                => __('Parent House type', WP_PM_DOMAIN),
            'parent_item_colon'          => __('Parent House type:', WP_PM_DOMAIN),
            'new_item_name'              => __('New House type Name', WP_PM_DOMAIN),
            'add_new_item'               => __('Add New House type', WP_PM_DOMAIN),
            'edit_item'                  => __('Edit House type', WP_PM_DOMAIN),
            'update_item'                => __('Update House type', WP_PM_DOMAIN),
            'view_item'                  => __('View House type', WP_PM_DOMAIN),
            'separate_items_with_commas' => __('Separate house types with commas', WP_PM_DOMAIN),
            'add_or_remove_items'        => __('Add or remove house types', WP_PM_DOMAIN),
            'choose_from_most_used'      => __('Choose from the most used', WP_PM_DOMAIN),
            'popular_items'              => __('Popular House Types', WP_PM_DOMAIN),
            'search_items'               => __('Search House Types', WP_PM_DOMAIN),
            'not_found'                  => __('Not Found', WP_PM_DOMAIN),
            'no_terms'                   => __('No house types', WP_PM_DOMAIN),
            'items_list'                 => __('House types list', WP_PM_DOMAIN),
            'items_list_navigation'      => __('House types list navigation', WP_PM_DOMAIN),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_in_quick_edit'         => false,
            'meta_box_cb'                => false,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy(self::TAX_HOUSE_TYPE, array( self::getCPT() ), $args);
    }

    public static function init()
    {
        add_action('init', [self::class,'register_location'], 0);
        add_action('init', [self::class,'register_sale_status'], 0);
        add_action('init', [self::class,'register_construction_status'], 0);
        add_action('init', [self::class,'register_house_type'], 0);
    }
}
