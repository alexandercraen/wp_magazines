<?php
namespace WPPlugin;

use WPPlugin\Database\DB;
use WPPlugin\Admin\Admin;
use WPPlugin\Public_View\Public_View;
use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;
use WPPlugin\Services\Security_Service;
use WPPlugin\Services\Statistics_Service;
use WPPlugin\Services\Logging_Service;

class Plugin_Main {
    private $db;
    private $admin;
    private $public_view;
    private $flipbook_service;
    private $filebird_service;
    private $security_service;
    private $statistics_service;
    private $logging_service;

    public function __construct() {
        // Initialize services
        $this->flipbook_service = new Flipbook_Service();
        $this->filebird_service = new FileBird_Service();
        $this->security_service = new Security_Service();
        $this->statistics_service = new Statistics_Service();
        $this->logging_service = new Logging_Service();

        // Initialize database
        $this->db = new DB();
        $this->db->create_tables();

        // Initialize admin and public views
        $this->admin = new Admin($this->flipbook_service, $this->filebird_service, $this->security_service, $this->statistics_service, $this->logging_service);
        $this->public_view = new Public_View($this->flipbook_service, $this->filebird_service);

        // Register hooks
        $this->register_hooks();
    }

    private function register_hooks() {
        // Activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this->public_view, 'enqueue_public_scripts'));
        add_action('admin_enqueue_scripts', array($this->admin, 'enqueue_admin_scripts'));

        // Register shortcodes
        $this->public_view->register_shortcodes();
    }

    public function activate() {
        $this->db->create_tables();
        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }

    public function init_cpts() {
        // Register Custom Post Types if needed
    }
}
