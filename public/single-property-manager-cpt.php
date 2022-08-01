<?php
/**
 * The template for displaying all single posts for protery-manager-cpt
 *
 * If you wan to override this template, copy this file to the template folder
 *
 */

get_header();

$result = '';
$post = get_post();
if (!empty($post)) {
    $pricemeta = new WP_Property_Manager_Price_Metabox();
    $type = new WP_Property_Manager_Type_Metabox();
    $gallery = new WP_Property_Manager_Gallery_Metabox();
    $blueprint = new WP_Property_Manager_Blueprint_Metabox();
    $bedrooms = new WP_Property_Manager_Bedrooms_Metabox();
    $baths = new WP_Property_Manager_Bath_Metabox();
    $sqfoot = new WP_Property_Manager_Surface_Metabox();

    $address = new WP_Property_Manager_Address_Metabox();

    $coordinates = new WP_Property_Manager_Coordinates_Metabox();
    $coordinates = unserialize($coordinates->getValue());

    $garage = new WP_Property_Manager_Garage_Metabox();
    $salestatus = new WP_Property_Manager_Sale_Status_Metabox();
    $constructionstatus = new WP_Property_Manager_Construction_Status_Metabox();

    $location  = get_the_terms(get_the_ID(), WP_Property_Manager_Taxonomy::TAX_LOCATION); ?>
<style>
    .property-container{
        width:80%;
        margin:0 auto;
    }
    .property-container section{
        margin: 0;
        padding: 0;
        margin-bottom: 5px;
    }
</style>

<div class="property-container">
    <h2><?=get_the_title()?></h2>
    <?php if(!empty($location)):?>
    <h4>Located at:  <?=implode(', ', array_reverse(array_column($location,'name'))); ?></h4>
    <?php endif;?>
    <br>
    <section>
        <h3>Specs</h3>
        <div id="home-<?=get_the_ID()?>" style="position: relative;">
            <div class="home-info">
                <span class="home-price">Price: <i class="fa-solid fa-dollar-sign"></i> <?=number_format($pricemeta->getValue())?></span>
                <p class="home-info-details">
                    
                    <span class="home-type"><i class="fa-solid fa-house"></i> <?=$type->getValue()?></span>
                    <span class="home-bed"><i class="fa-solid fa-bed"></i> <?=$bedrooms->getValue()?> Bedrooms</span>
                    <span class="home-bath"><i class="fa-solid fa-bath"></i> <?=$baths->getValue()?> Bath</span>
                </p>
                <p>
                <span class="home-garage"><i class="fa-solid fa-warehouse"></i> <?=$garage->getValue(null,'No')?> Garage spots</span>
                    <span class="home-sqft"><i class="fa-solid fa-globe"></i> <?=number_format($sqfoot->getValue())?> sqft</span>                    
                </p>
                <p>                    
                    <span class="home-sqft"><i class="fa-solid fa-file-signature"></i> Sale status: <?= $salestatus->getValue() ?></span>                    
                </p>
                <p>
                <span class="home-coords"><i class="fa-solid fa-person-digging"></i>Construction status: <?= $constructionstatus->getValue() ?></span>
                </p>
            </div>
        </div>
    </section>

    <section>
        <h3>Description</h3>
        <p><?=the_content()?></p>
    </section>

    <section>
        <h3>Address</h3>
        <p><span class="home-coords"><i class="fa-solid fa-location-pin"></i> Coordinates (lat, lon): (<?=$coordinates['lat']?>, <?=$coordinates['lon']?>)</span></p>
        <p><?=$address->getValue()?></p>
        
    </section>

<?php

    $banner_img = $gallery->getValue($post, '');
    $banner_img = !empty($banner_img) ? array_map('wp_get_attachment_url', explode(',', $banner_img)) : false ;
    if (!$banner_img) {
        $banner_img = [WP_Property_Manager_Base::getPublicUrl().'assets/noimage.png'];
    } ?>
    <section>
        <h3>Gallery</h3>    
        <?php
        foreach ($banner_img as $img) {?>
            <a href="<?=$img?>" target="_blank">
                <img loading="lazy" class="home lazy" data-src="<?=$img?>" src="<?=$img?>" style="max-width:300px;height:auto;">
            </a>   
        <?php
        } ?>
    </section>
<?php

    $banner_img = $blueprint->getValue($post, '');
    $banner_img = !empty($banner_img) ? array_map('wp_get_attachment_url', explode(',', $banner_img)) : false ;
    if (!$banner_img) {
        $banner_img = [WP_Property_Manager_Base::getPublicUrl().'assets/noimage.png'];
    } ?>
    <section>
        <h3>Blueprint</h3>    
        <?php
        foreach ($banner_img as $img) {?>
            <a href="<?=$img?>" target="_blank">
                <img loading="lazy" class="home lazy" data-src="<?=$img?>" src="<?=$img?>" style="max-width:300px;height:auto;">
            </a>   
        <?php
        } ?>
    </section>
</div>
<?php
}
get_footer();
