<?php
namespace WPPlugin\Controllers;

use WPPlugin\Models\Publicatie;
use WPPlugin\Database\DB;
use WPPlugin\Services\Flipbook_Service;
use WPPlugin\Services\FileBird_Service;

class Publicatie_Controller {
    private $db;
    private $flipbook_service;
    private $filebird_service;

    public function __construct(DB $db, Flipbook_Service $flipbook_service, FileBird_Service $filebird_service) {
        $this->db = $db;
        $this->flipbook_service = $flipbook_service;
        $this->filebird_service = $filebird_service;
    }

    public function add_publicatie($data) {
        $publicatie = new Publicatie($data);
        $publicatie_id = $this->db->insert_publicatie($publicatie);
        $publicatie->set_id($publicatie_id);

        // Creëer folder structuur via FileBird
        $this->filebird_service->create_folder_structure($publicatie);

        // Creëer flipboek via Flipbook Service
        $this->flipbook_service->create_flipbook($publicatie);
    }

    public function edit_publicatie($id, $data) {
        $publicatie = $this->db->get_publicatie($id);
        if ($publicatie) {
            // Update properties met $data
            $this->db->update_publicatie($publicatie);

            // Update flipboek
            $this->flipbook_service->update_flipbook($publicatie);
        }
    }

    public function delete_publicatie($id) {
        $publicatie = $this->db->get_publicatie($id);
        if ($publicatie) {
            // Verwijder flipboek
            $this->flipbook_service->delete_flipbook($publicatie);

            // Verwijder publicatie
            $this->db->delete_publicatie($id);
        }
    }

    public function get_all_publicaties() {
        return $this->db->get_all_publicaties();
    }

    public function get_publicatie($id) {
        return $this->db->get_publicatie($id);
    }
}
