<?php
namespace WPPlugin\Controllers;

use WPPlugin\Models\Formaat;
use WPPlugin\Database\DB;

class Formaat_Controller {
    private \$db;

    public function __construct(DB \$db) {
        \$this->db = \$db;
    }

    public function add_formaat(\$data) {
        \$formaat = new Formaat(\$data);
        \$this->db->insert_formaat(\$formaat);
    }

    public function edit_formaat(\$id, \$data) {
        \$formaat = \$this->db->get_formaat(\$id);
        if (\$formaat) {
            // Update properties
            \$this->db->update_formaat(\$formaat);
        }
    }

    public function delete_formaat(\$id) {
        \$this->db->delete_formaat(\$id);
    }

    public function get_all_formaten() {
        return \$this->db->get_all_formaten();
    }

    public function get_formaat(\$id) {
        return \$this->db->get_formaat(\$id);
    }
}
