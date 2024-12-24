<?php
/**
 * Template for Publicaties Overview Page
 */

use WPPlugin\Controllers\Publicatie_Controller;
use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;
use WPPlugin\Database\DB;

\$db = new DB();
\$flipbook_service = new Flipbook_Service();
\$filebird_service = new FileBird_Service();
\$publicatie_controller = new Publicatie_Controller(\$db, \$flipbook_service, \$filebird_service);
\$publicaties = \$publicatie_controller->get_all_publicaties();
?>

<div class="publicaties-overview">
    <?php foreach (\$publicaties as \$publicatie): ?>
        <div class="publicatie-item">
            <h2><?php echo esc_html(\$publicatie->get_titel()); ?></h2>
            <p><?php echo esc_html(\$publicatie->get_auteur()); ?></p>
            <!-- Voeg meer details toe indien nodig -->
            <a href="<?php echo get_permalink(\$publicatie->get_post_id()); ?>"><?php _e('Bekijk Publicatie', 'rosaceus-info-manager'); ?></a>
        </div>
    <?php endforeach; ?>
</div>
