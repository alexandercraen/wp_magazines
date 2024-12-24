<?php
/**
 * Template for Publicatie Detail Page
 */

use WPPlugin\Controllers\Publicatie_Controller;
use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;
use WPPlugin\Database\DB;

$db = new DB();
$flipbook_service = new Flipbook_Service();
$filebird_service = new FileBird_Service();
$publicatie_controller = new Publicatie_Controller(\$db, \$flipbook_service, \$filebird_service);
\$publicatie_id = get_the_ID();
\$publicatie = \$publicatie_controller->get_publicatie(\$publicatie_id);

if ( !\$publicatie ) {
    echo '<p>' . __('Publicatie niet gevonden.', 'rosaceus-info-manager') . '</p>';
    return;
}

\$flipbook_shortcode = \$flipbook_service->get_flipbook_shortcode(\$publicatie);
?>

<div class="publicatie-detail">
    <h1><?php echo esc_html(\$publicatie->get_titel()); ?></h1>
    <p><?php echo esc_html(\$publicatie->get_auteur()); ?></p>
    <div class="coverimages">
        <?php 
        \$coverimages = json_decode(\$publicatie->get_coverimage_urls(), true);
        if (is_array(\$coverimages)) {
            foreach (\$coverimages as \$coverimage_url): ?>
                <img src="<?php echo esc_url(\$coverimage_url); ?>" alt="<?php echo esc_attr(\$publicatie->get_titel()); ?> Cover Image">
            <?php endforeach;
        }
        ?>
    </div>
    <div class="inhoudstafel">
        <h2><?php _e('Inhoudstafel', 'rosaceus-info-manager'); ?></h2>
        <?php echo wp_kses_post(\$publicatie->get_inhoudstafel()); ?>
    </div>
    <div class="korte-inhoud">
        <h2><?php _e('Samenvatting', 'rosaceus-info-manager'); ?></h2>
        <p><?php echo esc_html(\$publicatie->get_korte_inhoud()); ?></p>
    </div>
    <div class="flipbook-view">
        <?php echo do_shortcode(\$flipbook_shortcode); ?>
    </div>
    <div class="download-pdf">
        <a href="<?php echo esc_url(\$publicatie->get_pdf_url()); ?>" download><?php _e('Download PDF', 'rosaceus-info-manager'); ?></a>
    </div>
</div>
