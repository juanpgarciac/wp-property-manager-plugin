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
            'add_new'               => __( 'Add New Property', WP_PM_DOMAIN ),
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


    public function getID(){
        return get_the_ID();
    }


    public static function show_list_item()
    {
        $result = '';
        $post = get_post();
        if(!empty( $post )){
/* */
            $pricemeta = new WP_Property_Manager_Price_Metabox(); 
            $type = new WP_Property_Manager_Type_Metabox();
            $gallery = new WP_Property_Manager_Gallery_Metabox();
            $bedrooms = new WP_Property_Manager_Bedrooms_Metabox();
            $baths = new WP_Property_Manager_Bath_Metabox();
            $sqfoot = new WP_Property_Manager_Surface_Metabox();
            $banner_img = $gallery->getValue($post,'');
            $banner_img = explode(',', $banner_img) ;
            if(!empty($banner_img) && !empty($banner_img[0])) {
                $banner_img = wp_get_attachment_url( $banner_img[0] );
            }else{
                $banner_img = self::getPublicUrl().'assets/noimage.png';                
            }
            
            $result .= '</i><section id="home-'.get_the_ID().'" class="home-listing-item col-lg-6" style="position: relative;">
                <figure>
                    <a href="'.$banner_img.'">
                        <img loading="lazy" class="home lazy" data-src="'.$banner_img.'" src="'.$banner_img.'" style="max-width:300px;height:auto;">
                    </a>
                </figure>
                <div class="home-info">
                    <p class="title-and-price">
                        <b class="home-title">' . get_the_title() . '</b>
                        <b class="home-price"><i class="fa-solid fa-dollar-sign"></i> ' . number_format($pricemeta->getValue($post)) . '</b>
                    </p>
                    <p class="home-info-details">
                        <span class="home-type"><i class="fa-solid fa-house"></i> '.$type->getValue($post).'</span>
                        <span class="home-bed"><i class="fa-solid fa-bed"></i> '.$bedrooms->getValue($post).' Bedrooms</span>
                        <span class="home-bath"><i class="fa-solid fa-bath"></i> '.$baths->getValue($post).' Bath</span>
                        <span class="home-sqft"><i class="fa-solid fa-globe"></i> '.number_format($sqfoot->getValue($post)).' sqft</span>
                    </p>';
                    /* *<div class="home-actions">
                        <a class="home-details" href="https://www.morgantaylorhomes.com/laveen/durango/32x3-w-carver-rd-laveen-az-85339/" title="Get details" target="_blank"><i class="icon-info"></i><span>Get Details</span></a>
                        <a class="home-sharer" href="#" data-home-id="21523" title="Share"><i class="icon-share"></i><span>Share</span></a>
                    </div>
                    <section class="home-share-overlay" data-home-id="21523">
                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://www.morgantaylorhomes.com/laveen/durango/32x3-w-carver-rd-laveen-az-85339/" target="_blank"><i class="icon-facebook"></i></a>
                        <a class="twitter" href="https://twitter.com/share?url=https://www.morgantaylorhomes.com/laveen/durango/32x3-w-carver-rd-laveen-az-85339/" target="_blank"><i class="icon-twitter "></i></a>
                        <a class="pinterest" href="https://pinterest.com/pin/create/bookmarklet/?media=https://www.morgantaylorhomes.com/wp-content/uploads/2021/07/20210708145711683271000000-o-384x256.jpg&amp;url=https://www.morgantaylorhomes.com/laveen/durango/32x3-w-carver-rd-laveen-az-85339/" target="_blank"><i class="icon-pinterest"></i></a>
                    </section>
                    **/ 
            $result .= '</div></section><br>';




        }
        return $result;
    }


}