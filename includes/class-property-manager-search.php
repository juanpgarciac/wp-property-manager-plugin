<?php

class WP_Property_Manager_Search extends WP_Property_Manager_Base
{
    public const SC_SEARCH = 'property-manager-search';

    public static function enqueue_scripts()
    {
        wp_enqueue_style(self::getCPT().'-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', [], self::getVersion(), false);
        wp_enqueue_script(self::getCPT().'-select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['jquery'], self::getVersion(), false);
        wp_enqueue_script(self::getCPT().'-search', self::getPublicUrl() . 'js/wp_property_manager_search.js', ['jquery'], self::getVersion(), false);
    }

    public static function init()
    {
        add_action('wp_enqueue_scripts', [self::class,'enqueue_scripts']);
        add_shortcode(self::SC_SEARCH, [self::class,'create_shortcode_property_manager_search']);
    }


    public static function search_form()
    {
        //form
        $form = '<form action="" method="GET" >';

        //header
        $title = '<h3>'.__('Search', self::getDomain()).'</h3>';

        //print location selector
        $location_selector = self::location_selector();

        //print construction selector
        $construction_selector = self::construction_selector();

        //print price range selector
        $price_selector = self::price_selector();

        //submit button
        $button = '<button type="submit">Search</button>';

        return $form.$title.$location_selector.'<br>'.$construction_selector.'<br>'.$price_selector.'<br>'.$button.'</form>';
    }


    public static function location_selector()
    {
        $location = isset($_GET['property-manager-location-select']) ? $_GET['property-manager-location-select'] : null;
        $label = '<label for="property-manager-location-select">Location</label>&nbsp;';
        $input = '<select name="property-manager-location-select" id="property-manager-location-select" style="width:60%">';
        $input .= '<option value="">'.__('Any', self::getDomain()).'</option>';
        $taxonomy = get_taxonomy(WP_Property_Manager_Taxonomy::TAX_LOCATION);
        $term_query = get_terms(array(
                    'taxonomy' => WP_Property_Manager_Taxonomy::TAX_LOCATION,
                    'hide_empty' => false,
                ));
        if (! empty($term_query)) {
            foreach ($term_query as $term) {
                $identifier = $taxonomy->hierarchical ? $term->term_id : $term->name;
                $input .= '<option value="'.$identifier.'" '.($location==$identifier ? 'selected' : '').'>'.$term->name.'</option>';
            }
        }
        $input .= '</select>';

        return $label.$input;
    }

    public static function construction_selector()
    {
        $selector = 'property-manager-construction-select';
        $location = isset($_GET[$selector]) ? $_GET[$selector] : null;
        $label = '<label for="'.$selector.'">Construction status</label>&nbsp;';
        $input = '<select name="'.$selector.'" id="'.$selector.'">';
        $input .= '<option value="">'.__('Any', self::getDomain()).'</option>';
        $taxonomy = get_taxonomy(WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS);
        $term_query = get_terms(array(
                    'taxonomy' => WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS,
                    'hide_empty' => false,
                ));
        if (! empty($term_query)) {
            foreach ($term_query as $term) {
                $identifier = $taxonomy->hierarchical ? $term->term_id : $term->name;
                $input .= '<option value="'.$identifier.'" '.($location==$identifier ? 'selected' : '').'>'.$term->name.'</option>';
            }
        }
        $input .= '</select>';

        return $label.$input;
    }

    public static function price_selector()
    {
        $pricerange = [
            '0|250' => 'Under 250k',
            '250|350'=> 'calc',
            '350|450'=> 'calc',
            '450|750'=> 'calc',
            '750|1000'=> 'calc',
            '1000|0' => '+1 Million'];
        $selector = 'property-manager-price-select';
        $price = isset($_GET[$selector]) ? $_GET[$selector] : null;
        $selectorlabel = '<label for="'.$selector.'">Price range</label>&nbsp;';
        $input = '<select name="'.$selector.'" id="'.$selector.'">';
        $input .= '<option value="">'.__('Any', self::getDomain()).'</option>';
        foreach ($pricerange as $range => $label) {
            list($min, $max) = explode('|', $range);
            if ($label == 'calc') {
                $label = "{$min}k - ".($max < 1000 ? $max - 1 . 'k' : '1 Million');
            }
            $identifier = $min * 1000 ."|".$max * 1000;
            $input .= '<option value="'.$identifier.'" '.($price==$identifier ? 'selected' : '').'>'.$label.'</option>';
        }
        $input .= '</select>';

        return $selectorlabel.$input;
    }

    public static function property_item()
    {
    }



    public static function create_shortcode_property_manager_search()
    {
        $location = isset($_GET['property-manager-location-select']) ? $_GET['property-manager-location-select'] : null;
        $construction = isset($_GET['property-manager-construction-select']) ? $_GET['property-manager-construction-select'] : null;
        $price = isset($_GET['property-manager-price-select']) ? $_GET['property-manager-price-select'] : null;
        $tax_query = [];
        if (!empty($location)) {
            $location_query = array(
                'taxonomy' => WP_Property_Manager_Taxonomy::TAX_LOCATION,
                'terms'    => $location,
            );
            $tax_query[] = $location_query;
        }
        if (!empty($construction)) {
            $construction_query = array(
                'taxonomy' => WP_Property_Manager_Taxonomy::TAX_CONSTRUCTION_STATUS,
                'field' => 'name',
                'terms'    => $construction,
            );
            $tax_query[] = $construction_query;
        }

        $meta_query = [];
        if (!empty($price)) {
            $pricemetabox = new WP_Property_Manager_Price_Metabox();
            list($min, $max) = array_map('intval', explode('|', $price));
            if ($max > 0) {
                $value =  [$min, $max < 1000000 ? $max - 1 : $max];
                $operator = 'between';
            } else {
                $value = $min;
                $operator = '>';
            }
            $price_query = array(
                'key' => $pricemetabox->getMetaKey(),
                'value'    =>  $value,
                'type'     => 'numeric',
                'compare'  => $operator
            );
            $meta_query[] = $price_query;
        }

        $args = array(
                        'post_type'      => self::getCPT(),
                        'posts_per_page' => '10',
                        'publish_status' => 'published',
                        'tax_query' => $tax_query,
                        'meta_query' => $meta_query,
                    );

        //dd($args);
        $query = new WP_Query($args);

        $result = '<div class="property-manager-search-result">';
        $i = 0;
        if ($query->have_posts()) :

            while ($query->have_posts()) :
                $query->the_post();
                $result .= WP_Property_Manager_CPT::show_list_item();
            endwhile;

            wp_reset_postdata();

        endif;
        $resul .= '</div>';
        return self::search_form().$result;
    }
}
