<?php
namespace WPPlugin\Interfaces;

use WPPlugin\Models\Publicatie;

interface FileBird_Interface {
    public function create_folder_structure(Publicatie \$publicatie);
    public function assign_files_to_folders(Publicatie \$publicatie);
    public function get_folder_path(Publicatie \$publicatie);
}
