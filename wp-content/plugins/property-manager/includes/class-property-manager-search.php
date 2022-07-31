<?php

class WP_Property_Manager_Search extends WP_Property_Manager_Base
{
    const SC_SEARCH = 'property-manager-search';

    static public function enqueue_scripts() {
        wp_enqueue_style( self::getCPT().'-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', [], self::getVersion(), false );
        wp_enqueue_script( self::getCPT().'-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['jquery'], self::getVersion(), false );        
        wp_enqueue_script( self::getCPT().'-search', self::getPublicUrl() . 'js/wp_property_manager_search.js', ['jquery'], self::getVersion(), false );        
    }

    public static function init()
    {
        add_action('wp_enqueue_scripts',[self::class,'enqueue_scripts']);
        add_shortcode( self::SC_SEARCH, [self::class,'create_shortcode_property_manager_search'] ); 
    }


    public static function search_form()
    {
        //form 
        $form = '<form action"" method="GET">';

        //header
        $title = '<h3>'.__('Search',self::getDomain()).'</h3>';

        //print location selector
        $location_selector = self::location_selector();

        //print construction selector
        $construction_selector = self::construction_selector();

        //print price range selector 

        //submit button
        $button = '<button type="submit">Search</button>';

        return $form.$title.$location_selector.'<br>'.$construction_selector.'<br>'.$button.'</form>';
    }


    public static function location_selector()
    {
        $location = isset($_GET['property-manager-location-select']) ? $_GET['property-manager-location-select'] : null;
        $label = '<label for="property-manager-location-select">Location</label>';
        $input = '<select name="property-manager-location-select" id="property-manager-location-select">';
        $input .= '<option value="">'.__('Any',self::getDomain()).'</option>';
        

                $taxonomy = get_taxonomy(WP_Property_Manager_Taxonomy::TAX_LOCATION);
                $term_query = get_terms( array(
                    'taxonomy' => WP_Property_Manager_Taxonomy::TAX_LOCATION,
                    'hide_empty' => false,
                ) );
                if ( ! empty( $term_query ) ) {
                    foreach ( $term_query as $term ) {                            
                        $identifier = $taxonomy->hierarchical?$term->term_id:$term->name;                            
                        $input .= '<option value="'.$identifier.'" '.($location==$identifier?'selected':'').'>'.$term->name.'</option>';
                    }
                }
        $input .= '</select>';

        return $label.$input;
    }

    public static function construction_selector()
    {
        $selector = 'property-manager-construction-select';
        $location = isset($_GET[$selector]) ? $_GET[$selector] : null;
        $label = '<label for="'.$selector.'">Construction status</label>';
        $input = '<select name="'.$selector.'" id="'.$selector.'">';
        $input .= '<option value="">'.__('Any',self::getDomain()).'</option>';
                $taxonomy = get_taxonomy(WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS);
                $term_query = get_terms( array(
                    'taxonomy' => WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS,
                    'hide_empty' => false,
                ) );
                if ( ! empty( $term_query ) ) {
                    foreach ( $term_query as $term ) {                            
                        $identifier = $taxonomy->hierarchical?$term->term_id:$term->name;                            
                        $input .= '<option value="'.$identifier.'" '.($location==$identifier?'selected':'').'>'.$term->name.'</option>';
                    }
                }
        $input .= '</select>';

        return $label.$input;
    }

    public static function property_item()
    {

    }



    public static function create_shortcode_property_manager_search(){
        
        $location = isset($_GET['property-manager-location-select']) ? $_GET['property-manager-location-select'] : null;
        $construction = isset($_GET['property-manager-construction-select']) ? $_GET['property-manager-construction-select'] : null;
        $tax_query = [];
        if(!empty($location)){            
            $location_query = array(
                'taxonomy' => WP_Property_Manager_Taxonomy::TAX_LOCATION,
                'terms'    => $location,
            );
            $tax_query[] = $location_query;
        }
        if(!empty($construction)){            
            $construction_query = array(
                'taxonomy' => WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS,
                'field' => 'name',
                'terms'    => $construction,
            );
            $tax_query[] = $construction_query;
        }
            
        $args = array(
                        'post_type'      => self::getCPT(),
                        'posts_per_page' => '10',
                        'publish_status' => 'published',
                        'tax_query' => $tax_query,
                    );
    
        //dd($args);
        $query = new WP_Query($args);

        $result = '';
        if($query->have_posts()) :
    
            while($query->have_posts()) :
    
                $query->the_post() ;
                $id = get_the_ID();
                $banner_img = get_post_meta($id, '_wp_property_manager_gallery', true);	
                $banner_img = explode(',', $banner_img);
                //dd($banner_img);
                $result .= '<div class="movie-item">';
                if(!empty($banner_img)) {
                    $result .= "<div><img src=". wp_get_attachment_url( $banner_img[0] )."></div>";
                }
                
                $result .= '<div class="movie-name"><h3>' . get_the_title() . '</h3></div>';
                $result .= '<div class="movie-desc"><p>' . get_the_content() . '</p></div>'; 
                $result .= '</div>';
    
            endwhile;
    
            wp_reset_postdata();
    
        endif;    
    
        return self::search_form().$result;            
    }
}

/* *

// Use below code to show metabox values from anywhere
$id = get_the_ID();
	$banner_img = get_post_meta($id, 'post_banner_img', true);	
	$banner_img = explode(',', $banner_img);
	if(!empty($banner_img)) {
		?>
		<table class="plugin-detail-tabl" width="100%" cellspacing="0" cellpadding="0">
			<tbody>
				<?php  foreach ($banner_img as $attachment_id) { ?>
					<tr>
						<td><img src="<?php echo wp_get_attachment_url( $attachment_id );?>"></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php
	}

*/