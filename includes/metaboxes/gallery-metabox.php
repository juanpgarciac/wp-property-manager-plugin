<?php

class WP_Property_Manager_Gallery_Metabox extends WP_Property_Manager_Metabox_Base
{
    public function __construct()
    {
        $this->setID('gallery');
        $this->setTitle('Gallery:');
        $this->setDescription('Gallery');
        parent::__construct();

        //dd( self::getAdminDir() . 'css/'.$this->getFieldID().'.css');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style($this->getFieldID(), self::getAdminUrl() . 'css/'.$this->getFieldID().'.css', array(), self::getVersion(), 'all');
        wp_enqueue_script($this->getFieldID(), self::getAdminUrl() . 'js/'.$this->getFieldID().'.js', array( 'jquery' ), self::getVersion(), false);
    }

    public function custom_box_html($post)
    {
        $banner_img = get_post_meta($post->ID, $this->getMetaKey(), true); ?>
        <table cellspacing="10" cellpadding="10">
            <tr>
                <td>
                    <?php echo $this->multi_media_uploader_field($this->getFieldID(), $banner_img); ?>
                </td>
            </tr>
        </table>
        <?php
    }


    public function multi_media_uploader_field($name, $value = '')
    {
        $image = '">Add Media';
        $image_str = '';
        $image_size = 'full';
        $display = 'none';
        $value = explode(',', $value);

        if (!empty($value)) {
            foreach ($value as $values) {
                if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {
                    $image_str .= '<li data-attechment-id=' . $values . '><a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a><i class="dashicons dashicons-no delete-img"></i></li>';
                }
            }
        }

        if ($image_str) {
            $display = 'inline-block';
        }

        return '<div class="'.$this->getFieldID().' multi-upload-medias"><ul>'. $image_str . '</ul><a href="#" class="'.$this->getFieldID().' wc_multi_upload_image_button button' . $image . '</a><input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" /><a href="#" class="'.$this->getFieldID().' wc_multi_remove_image_button button" style="display:inline-block;display:' . $display . '">Remove media</a></div>';
    }
}
