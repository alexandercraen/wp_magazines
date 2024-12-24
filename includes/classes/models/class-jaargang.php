<?php
namespace WPPlugin\Models;

class Jaargang {
    private \$id;
    private \$jaar;
    private \$tijdschrift_id;
    private \$publicatiedatum;
    private \$afbeelding_url;
    private \$created_at;
    private \$updated_at;

    public function __construct(\$data = []) {
        \$this->id = isset(\$data['id']) ? intval(\$data['id']) : null;
        \$this->jaar = isset(\$data['jaar']) ? intval(\$data['jaar']) : date('Y');
        \$this->tijdschrift_id = isset(\$data['tijdschrift_id']) ? intval(\$data['tijdschrift_id']) : 0;
        \$this->publicatiedatum = isset(\$data['publicatiedatum']) ? sanitize_text_field(\$data['publicatiedatum']) : '';
        \$this->afbeelding_url = isset(\$data['afbeelding_url']) ? esc_url_raw(\$data['afbeelding_url']) : '';
        \$this->created_at = isset(\$data['created_at']) ? sanitize_text_field(\$data['created_at']) : '';
        \$this->updated_at = isset(\$data['updated_at']) ? sanitize_text_field(\$data['updated_at']) : '';
    }

    // Getters
    public function get_id() {
        return \$this->id;
    }

    public function get_jaar() {
        return \$this->jaar;
    }

    public function get_tijdschrift_id() {
        return \$this->tijdschrift_id;
    }

    public function get_publicatiedatum() {
        return \$this->publicatiedatum;
    }

    public function get_afbeelding_url() {
        return \$this->afbeelding_url;
    }

    public function get_created_at() {
        return \$this->created_at;
    }

    public function get_updated_at() {
        return \$this->updated_at;
    }

    // Setters indien nodig
}
