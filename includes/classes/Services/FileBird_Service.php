<?php
namespace WPPlugin\Services;

use WPPlugin\Interfaces\FileBird_Interface;
use WPPlugin\Models\Publicatie;

class FileBird_Service implements FileBird_Interface {
    public function create_folder_structure(Publicatie $publicatie) {
        // Implementatie voor FileBird
    }

    public function assign_files_to_folders(Publicatie $publicatie) {
        // Implementatie voor FileBird
    }

    public function get_folder_path(Publicatie $publicatie) {
        return 'Info PDF/' . $publicatie->get_jaargang_id();
    }
}
