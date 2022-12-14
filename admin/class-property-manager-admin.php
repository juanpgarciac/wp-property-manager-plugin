<?php



/**
 * This class manage the initialization of admin assets
 */
class WP_Property_Manager_Admin extends WP_Property_Manager_Base
{
    /**
     *
     * @return void
     */
    public static function enqueue_scripts()
    {
        wp_enqueue_script(self::getCPT().'-admin-script', self::getAdminUrl() . 'js/wp_property_manager.js', array( 'jquery' ), self::getVersion(), false);
    }

    /**
     * Initialize the admin classes
     * @param null $initClasses
     *
     * @return [type]
     */
    public static function init($initClasses = null)
    {
        add_action('admin_enqueue_scripts', [self::class,'enqueue_scripts']);
        add_action('restrict_manage_posts', [self::class,'filter_backend_by_taxonomies'], 99, 2);
        if (!is_null($initClasses) && is_array($initClasses)) {
            foreach ($initClasses as $class) {
                $class::init();
            }
        }
    }


    /**
     * This function adds the filters in the property-manager-cpt list
     * @param mixed $post_type
     * @param mixed $which
     *
     * @return void
     */
    public static function filter_backend_by_taxonomies($post_type, $which)
    {
        // Apply this to a specific CPT
        if (self::getCPT() !== $post_type) {
            return;
        }

        // A list of custom taxonomy slugs to filter by
        $taxonomies = WP_Property_Manager_Taxonomy::TAX_ARRAY;

        foreach ($taxonomies as $taxonomy_slug) {

            // Retrieve taxonomy data
            $taxonomy_obj = get_taxonomy($taxonomy_slug);
            $taxonomy_name = $taxonomy_obj->labels->name;

            // Retrieve taxonomy terms
            $terms = get_terms([
                'taxonomy' => $taxonomy_slug,
                'hide_empty' => false
                ]);

            // Display filter HTML
            echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
            echo '<option value="">' . sprintf(esc_html__('Show All %s', 'text_domain'), $taxonomy_name) . '</option>';
            foreach ($terms as $term) {
                printf(
                    '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
                    $term->slug,
                    ((isset($_GET[$taxonomy_slug]) && ($_GET[$taxonomy_slug] == $term->slug)) ? ' selected="selected"' : ''),
                    $term->name,
                    $term->count
                );
            }
            echo '</select>';
        }
    }
}
