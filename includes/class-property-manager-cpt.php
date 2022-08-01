<?php

/**
 * Class that handles the Property Manager Custom Post Type registration and visuals
 *
 */
class WP_Property_Manager_CPT extends WP_Property_Manager_Base
{
    /**
     * Register the Property Manager Custom Post Type
     * @return void
     */
    public static function register_cpt()
    {
        $labels = array(
            'name'                  => _x('Properties', 'Post Type General Name', WP_PM_DOMAIN),
            'singular_name'         => _x('Property', 'Post Type Singular Name', WP_PM_DOMAIN),
            'menu_name'             => __('Properties manager', WP_PM_DOMAIN),
            'name_admin_bar'        => __('Property manager', WP_PM_DOMAIN),
            'archives'              => __('Property Archives', WP_PM_DOMAIN),
            'attributes'            => __('Property Attributes', WP_PM_DOMAIN),
            'parent_item_colon'     => __('Parent Property:', WP_PM_DOMAIN),
            'all_items'             => __('All Properties', WP_PM_DOMAIN),
            'add_new_item'          => __('Add New Property', WP_PM_DOMAIN),
            'add_new'               => __('Add New Property', WP_PM_DOMAIN),
            'new_item'              => __('New Property', WP_PM_DOMAIN),
            'edit_item'             => __('Edit Property', WP_PM_DOMAIN),
            'update_item'           => __('Update Property', WP_PM_DOMAIN),
            'view_item'             => __('View Property', WP_PM_DOMAIN),
            'view_items'            => __('View Properties', WP_PM_DOMAIN),
            'search_items'          => __('Search Property', WP_PM_DOMAIN),
            'not_found'             => __('Not found', WP_PM_DOMAIN),
            'not_found_in_trash'    => __('Not found in Trash', WP_PM_DOMAIN),
            'featured_image'        => __('Featured Image', WP_PM_DOMAIN),
            'set_featured_image'    => __('Set featured image', WP_PM_DOMAIN),
            'remove_featured_image' => __('Remove featured image', WP_PM_DOMAIN),
            'use_featured_image'    => __('Use as featured image', WP_PM_DOMAIN),
            'insert_into_item'      => __('Insert into item', WP_PM_DOMAIN),
            'uploaded_to_this_item' => __('Uploaded to this item', WP_PM_DOMAIN),
            'items_list'            => __('Property list', WP_PM_DOMAIN),
            'items_list_navigation' => __('Property list navigation', WP_PM_DOMAIN),
            'filter_items_list'     => __('Filter property list', WP_PM_DOMAIN),
        );
        $args = array(
            'label'                 => __('Property', WP_PM_DOMAIN),
            'description'           => __('Property description', WP_PM_DOMAIN),
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

        register_post_type(self::getCPT(), $args);
    }

    /**
     * Initialize actions and filters
     * @return void
     */
    public static function init()
    {
        add_action('init', [self::class,'register_cpt'], 0);
        add_filter('single_template', [self::class,'single_template_override'], 0);
    }

    /**
     * Render a single property from the result list
     * @return string
     */
    public static function show_list_item()
    {
        $result = '';
        $post = get_post();
        if (!empty($post)) {
            /* */
            $pricemeta = new WP_Property_Manager_Price_Metabox();
            $type = new WP_Property_Manager_Type_Metabox();
            $gallery = new WP_Property_Manager_Gallery_Metabox();
            $bedrooms = new WP_Property_Manager_Bedrooms_Metabox();
            $baths = new WP_Property_Manager_Bath_Metabox();
            $sqfoot = new WP_Property_Manager_Surface_Metabox();
            $banner_img = $gallery->getValue($post, '');
            $banner_img = explode(',', $banner_img) ;
            if (!empty($banner_img) && !empty($banner_img[0])) {
                $banner_img = wp_get_attachment_url($banner_img[0]);
            } else {
                $banner_img = self::getPublicUrl().'assets/noimage.png';
            }

            $result .= '<section id="home-'.get_the_ID().'" class="home-listing-item col-lg-6" style="position: relative;">
                <figure>
                    <a href="'.$banner_img.'">
                        <img loading="lazy" class="home lazy" data-src="'.$banner_img.'" src="'.$banner_img.'" style="max-width:300px;height:auto;">
                    </a>
                </figure>
                <div class="home-info">
                    <p class="title-and-price">
                        <b class="home-title"><a href="'.get_post_permalink().'">' . get_the_title() . '</a></b>
                        <br>Price: <b class="home-price"><i class="fa-solid fa-dollar-sign"></i> ' . number_format($pricemeta->getValue()) . '</b>
                    </p>
                    <p class="home-info-details">
                        <span class="home-type"><i class="fa-solid fa-house"></i> '.$type->getValue().'</span>
                        <span class="home-bed"><i class="fa-solid fa-bed"></i> '.$bedrooms->getValue().' Bedrooms</span>
                        <span class="home-bath"><i class="fa-solid fa-bath"></i> '.$baths->getValue().' Bath</span>
                        <span class="home-sqft"><i class="fa-solid fa-globe"></i> '.number_format($sqfoot->getValue()).' sqft</span>
                    </p>';
            $result .= '</div></section><br>';
        }
        return $result;
    }

    /**
     * This filters allow to override the single template from plugin
     * @param mixed $template
     *
     * @return string
     */
    public static function single_template_override($template)
    {
        if (self::getCPT() == get_post_type(get_queried_object_id()) && strpos($template, 'single-'.self::getCPT().'.php') === false) {
            $template = self::getPublicDir() . 'single-property-manager-cpt.php';
        }
        return $template;
    }
}
