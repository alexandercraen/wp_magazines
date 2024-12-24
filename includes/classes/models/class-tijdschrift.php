<?php
namespace WPPlugin\Models;

class Tijdschrift {
    private \$id;
    private \$naam;
    private \$prefix;
    private \$beschrijving;
    private \$logo_url;
    private \$uitgeef_frequentie;
    private \$startdatum;
    private \$created_at;
    private \$updated_at;

    public function __construct(\$data = []) {
        \$this->id = isset(\$data['id']) ? intval(\$data['id']) : null;
        \$this->naam = isset(\$data['naam']) ? sanitize_text_field(\$data['naam']) : '';
        \$this->prefix = isset(\$data['prefix']) ? sanitize_text_field(\$data['prefix']) : '';
        \$this->beschrijving = isset(\$data['beschrijving']) ? sanitize_textarea_field(\$data['beschrijving']) : '';
        \$this->logo_url = isset(\$data['logo_url']) ? esc_url_raw(\$data['logo_url']) : '';
        \$this->uitgeef_frequentie = isset(\$data['uitgeef_frequentie']) ? sanitize_text_field(\$data['uitgeef_frequentie']) : '';
        \$this->startdatum = isset(\$data['startdatum']) ? sanitize_text_field(\$data['startdatum']) : '';
        \$this->created_at = isset(\$data['created_at']) ? sanitize_text_field(\$data['created_at']) : '';
        \$this->updated_at = isset(\$data['updated_at']) ? sanitize_text_field(\$data['updated_at']) : '';
    }

    // Getters
    public function get_id() {
        return \$this->id;
    }

    public function get_naam() {
        return \$this->naam;
    }

    public function get_prefix() {
        return \$this->prefix;
    }

    public function get_beschrijving() {
        return \$this->beschrijving;
    }

    public function get_logo_url() {
        return \$this->logo_url;
    }

    public function get_uitgeef_frequentie() {
        return \$this->uitgeef_frequentie;
    }

    public function get_startdatum() {
        return \$this->startdatum;
    }

    public function get_created_at() {
        return \$this->created_at;
    }

    public function get_updated_at() {
        return \$this->updated_at;
    }

    // Setters indien nodig
}
