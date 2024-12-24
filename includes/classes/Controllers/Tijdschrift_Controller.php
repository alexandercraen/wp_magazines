<?php
namespace WPPlugin\Controllers;

use WPPlugin\Models\Tijdschrift;
use WPPlugin\Database\DB;

class Tijdschrift_Controller {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function add_tijdschrift($data) {
        $tijdschrift = new Tijdschrift($data);
        $this->db->insert_tijdschrift($tijdschrift);
    }

    public function edit_tijdschrift($id, $data) {
        $tijdschrift = $this->db->get_tijdschrift($id);
        if ($tijdschrift) {
            // Update properties
            $this->db->update_tijdschrift($tijdschrift);
        }
    }

    public function delete_tijdschrift($id) {
        $this->db->delete_tijdschrift($id);
    }

    public function get_all_tijdschriften() {
        return $this->db->get_all_tijdschriften();
    }

    public function get_tijdschrift($id) {
        return $this->db->get_tijdschrift($id);
    }
}
