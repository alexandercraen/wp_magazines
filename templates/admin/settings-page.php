<?php
/**
 * Admin Settings Page Template
 */

use WPPlugin\Controllers\Tijdschrift_Controller;
use WPPlugin\Database\DB;

\$db = new DB();
\$tijdschrift_controller = new Tijdschrift_Controller(\$db);
\$tijdschriften = \$tijdschrift_controller->get_all_tijdschriften();
?>

<div class="wrap">
    <h1><?php _e('Rosaceus Info Manager Settings', 'rosaceus-info-manager'); ?></h1>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <?php wp_nonce_field('add_publicatie', 'rosaceus_info_nonce'); ?>
        <input type="hidden" name="action" value="add_publicatie">

        <table class="form-table">
            <tr>
                <th scope="row"><label for="titel"><?php _e('Titel', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="titel" type="text" id="titel" value="" class="regular-text" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="auteur"><?php _e('Auteur', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="auteur" type="text" id="auteur" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="inhoud"><?php _e('Inhoud', 'rosaceus-info-manager'); ?></label></th>
                <td><textarea name="inhoud" id="inhoud" class="large-text" rows="5"></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="publicatiedatum"><?php _e('Publicatiedatum', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="publicatiedatum" type="date" id="publicatiedatum" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="korte_inhoud"><?php _e('Korte Inhoud', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="korte_inhoud" type="text" id="korte_inhoud" value="" class="regular-text" maxlength="100"></td>
            </tr>
            <tr>
                <th scope="row"><label for="inhoudstafel"><?php _e('Inhoudstafel', 'rosaceus-info-manager'); ?></label></th>
                <td><textarea name="inhoudstafel" id="inhoudstafel" class="large-text" rows="5"></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="pdf_url"><?php _e('PDF URL', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="pdf_url" type="url" id="pdf_url" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="coverimage_urls"><?php _e('Cover Images URLs', 'rosaceus-info-manager'); ?></label></th>
                <td><input name="coverimage_urls[]" type="url" id="coverimage_urls" value="" class="regular-text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="jaargang_id"><?php _e('Jaargang', 'rosaceus-info-manager'); ?></label></th>
                <td>
                    <select name="jaargang_id" id="jaargang_id">
                        <?php foreach (\$jaargangen as \$jaargang): ?>
                            <option value="<?php echo esc_attr(\$jaargang->get_id()); ?>"><?php echo esc_html(\$jaargang->get_jaar()); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="tijdschrift_id"><?php _e('Tijdschrift', 'rosaceus-info-manager'); ?></label></th>
                <td>
                    <select name="tijdschrift_id" id="tijdschrift_id">
                        <?php foreach (\$tijdschriften as \$tijdschrift): ?>
                            <option value="<?php echo esc_attr(\$tijdschrift->get_id()); ?>"><?php echo esc_html(\$tijdschrift->get_naam()); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <!-- Voeg extra velden toe indien nodig -->
        </table>

        <?php submit_button(__('Publicatie Toevoegen', 'rosaceus-info-manager'), 'primary', 'add_publicatie'); ?>
    </form>
</div>
