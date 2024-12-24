<?php
namespace WPPlugin\Controllers;

use WPPlugin\Models\Jaargang;
use WPPlugin\Database\DB;

class Jaargang_Controller {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function add_jaargang($data) {
        $jaargang = new Jaargang($data);
        $this->db->insert_jaargang($jaargang);
    }

    public function edit_jaargang($id, $data) {
        $jaargang = $this->db->get_jaargang($id);
        if ($jaargang) {
            // Update properties
            $this->db->update_jaargang($jaargang);
        }
    }

    public function delete_jaargang($id) {
        $this->db->delete_jaargang($id);
    }

    public function get_all_jaargangen() {
        return $this->db->get_all_jaargangen();
    }

    public function get_jaargang($id) {
        return $this->db->get_jaargang($id);
    }
}
