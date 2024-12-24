<?php
namespace WPPlugin\Public_View;

use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;

class Public_View {
    private \$flipbook_service;
    private \$filebird_service;

    public function __construct(Flipbook_Service \$flipbook_service, FileBird_Service \$filebird_service) {
        \$this->flipbook_service = \$flipbook_service;
        \$this->filebird_service = \$filebird_service;

        // Voeg acties toe
        add_action('template_include', array(\$this, 'load_custom_templates'));
    }

    public function enqueue_public_scripts() {
        // Laad publieke scripts en styles
        wp_enqueue_style('public-style', plugins_url('../assets/css/public.css', __FILE__));
        wp_enqueue_script('public-script', plugins_url('../assets/js/public.js', __FILE__), array('jquery'), null, true);
    }

    public function register_shortcodes() {
        add_shortcode('jaargangen_overview', array(\$this, 'render_overview_pages'));
        add_shortcode('publicatie_detail', array(\$this, 'render_detail_page'));
    }

    public function render_overview_pages() {
        ob_start();
        include plugin_dir_path(__FILE__) . '../../templates/public/overzicht-publicaties.php';
        return ob_get_clean();
    }

    public function render_detail_page() {
        ob_start();
        include plugin_dir_path(__FILE__) . '../../templates/public/detail-publicatie.php';
        return ob_get_clean();
    }

    public function load_custom_templates(\$template) {
        if ( is_singular('publicatie') ) {
            \$new_template = plugin_dir_path(__FILE__) . '../../templates/public/detail-publicatie.php';
            if ( file_exists(\$new_template) ) {
                return \$new_template;
            }
        }

        return \$template;
    }
}
