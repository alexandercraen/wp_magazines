<?php
namespace WPPlugin\Admin;

use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;
use WPPlugin\Services\Security_Service;
use WPPlugin\Services\Statistics_Service;
use WPPlugin\Services\Logging_Service;

class Admin {
    private \$flipbook_service;
    private \$filebird_service;
    private \$security_service;
    private \$statistics_service;
    private \$logging_service;

    public function __construct(Flipbook_Service \$flipbook_service, FileBird_Service \$filebird_service, Security_Service \$security_service, Statistics_Service \$statistics_service, Logging_Service \$logging_service) {
        \$this->flipbook_service = \$flipbook_service;
        \$this->filebird_service = \$filebird_service;
        \$this->security_service = \$security_service;
        \$this->statistics_service = \$statistics_service;
        \$this->logging_service = \$logging_service;

        // Voeg admin hooks toe
        add_action('admin_menu', array(\$this, 'add_admin_menu'));
        add_action('admin_post_add_publicatie', array(\$this, 'handle_form_submission'));
    }

    public function enqueue_admin_scripts() {
        // Laad admin specifieke scripts en styles
        wp_enqueue_style('admin-style', plugins_url('../assets/css/admin.css', __FILE__));
        wp_enqueue_script('admin-script', plugins_url('../assets/js/admin.js', __FILE__), array('jquery'), null, true);
    }

    public function add_admin_menu() {
        add_menu_page(
            __('Rosaceus Info Manager', 'rosaceus-info-manager'),
            __('Rosaceus Info', 'rosaceus-info-manager'),
            'manage_options',
            'rosaceus-info-manager',
            array(\$this, 'render_settings_page'),
            'dashicons-book',
            6
        );
    }

    public function render_settings_page() {
        include plugin_dir_path(__FILE__) . '../../templates/admin/settings-page.php';
    }

    public function handle_form_submission() {
        // Verwerk form data en voeg publicatie toe
        if (isset($_POST['add_publicatie'])) {
            // Controleer nonce
            if ( ! isset($_POST['rosaceus_info_nonce']) || ! wp_verify_nonce($_POST['rosaceus_info_nonce'], 'add_publicatie') ) {
                wp_die(__('Nonce verification failed', 'rosaceus-info-manager'));
            }

            // Valideer en saniteer input
            \$data = [
                'titel' => sanitize_text_field($_POST['titel']),
                'auteur' => sanitize_text_field($_POST['auteur']),
                'inhoud' => sanitize_textarea_field($_POST['inhoud']),
                'publicatiedatum' => sanitize_text_field($_POST['publicatiedatum']),
                'korte_inhoud' => sanitize_text_field($_POST['korte_inhoud']),
                'inhoudstafel' => sanitize_textarea_field($_POST['inhoudstafel']),
                'pdf_url' => esc_url_raw($_POST['pdf_url']),
                'coverimage_urls' => wp_json_encode($_POST['coverimage_urls']),
                'jaargang_id' => intval($_POST['jaargang_id']),
                'tijdschrift_id' => intval($_POST['tijdschrift_id']),
                // Voeg overige velden toe
            ];

            // Voeg publicatie toe via controller
            // Assuming access to controller
            // This needs to be adjusted based on actual implementation
            // \$this->publicatie_controller->add_publicatie(\$data);

            // Voor eenvoud in dit voorbeeld:
            // \$this->flipbook_service->create_flipbook(\$data); // Niet correct, moet via controller

            // Redirect terug naar instellingenpagina met succesbericht
            wp_redirect( add_query_arg('status', 'success', admin_url('admin.php?page=rosaceus-info-manager')) );
            exit;
        }
    }
}
