<?php
namespace WPPlugin\Models;

class Publicatie {
    private \$id;
    private \$titel;
    private \$auteur;
    private \$inhoud;
    private \$publicatiedatum;
    private \$korte_inhoud;
    private \$inhoudstafel;
    private \$pdf_url;
    private \$coverimage_urls;
    private \$flipboek_id;
    private \$jaargang_id;
    private \$tijdschrift_id;
    private \$formaat;
    private \$weergave_opties;
    private \$tekst;
    private \$tags;
    private \$aantal_paginas;
    private \$offset;
    private \$post_id;
    private \$created_at;
    private \$updated_at;

    public function __construct(\$data = []) {
        \$this->id = isset(\$data['id']) ? intval(\$data['id']) : null;
        \$this->titel = isset(\$data['titel']) ? sanitize_text_field(\$data['titel']) : '';
        \$this->auteur = isset(\$data['auteur']) ? sanitize_text_field(\$data['auteur']) : '';
        \$this->inhoud = isset(\$data['inhoud']) ? sanitize_textarea_field(\$data['inhoud']) : '';
        \$this->publicatiedatum = isset(\$data['publicatiedatum']) ? sanitize_text_field(\$data['publicatiedatum']) : '';
        \$this->korte_inhoud = isset(\$data['korte_inhoud']) ? sanitize_text_field(\$data['korte_inhoud']) : '';
        \$this->inhoudstafel = isset(\$data['inhoudstafel']) ? sanitize_textarea_field(\$data['inhoudstafel']) : '';
        \$this->pdf_url = isset(\$data['pdf_url']) ? esc_url_raw(\$data['pdf_url']) : '';
        \$this->coverimage_urls = isset(\$data['coverimage_urls']) ? wp_json_encode(\$data['coverimage_urls']) : '';
        \$this->flipboek_id = isset(\$data['flipboek_id']) ? sanitize_text_field(\$data['flipboek_id']) : '';
        \$this->jaargang_id = isset(\$data['jaargang_id']) ? intval(\$data['jaargang_id']) : 0;
        \$this->tijdschrift_id = isset(\$data['tijdschrift_id']) ? intval(\$data['tijdschrift_id']) : 0;
        \$this->formaat = isset(\$data['formaat']) ? sanitize_text_field(\$data['formaat']) : 'PDF';
        \$this->weergave_opties = isset(\$data['weergave_opties']) ? wp_json_encode(\$data['weergave_opties']) : '';
        \$this->tekst = isset(\$data['tekst']) ? sanitize_textarea_field(\$data['tekst']) : '';
        \$this->tags = isset(\$data['tags']) ? sanitize_text_field(\$data['tags']) : '';
        \$this->aantal_paginas = isset(\$data['aantal_paginas']) ? intval(\$data['aantal_paginas']) : 0;
        \$this->offset = isset(\$data['offset']) ? intval(\$data['offset']) : 0;
        \$this->post_id = isset(\$data['post_id']) ? intval(\$data['post_id']) : 0;
        \$this->created_at = isset(\$data['created_at']) ? sanitize_text_field(\$data['created_at']) : '';
        \$this->updated_at = isset(\$data['updated_at']) ? sanitize_text_field(\$data['updated_at']) : '';
    }

    // Getters
    public function get_id() {
        return \$this->id;
    }

    public function get_titel() {
        return \$this->titel;
    }

    public function get_auteur() {
        return \$this->auteur;
    }

    public function get_inhoud() {
        return \$this->inhoud;
    }

    public function get_publicatiedatum() {
        return \$this->publicatiedatum;
    }

    public function get_korte_inhoud() {
        return \$this->korte_inhoud;
    }

    public function get_inhoudstafel() {
        return \$this->inhoudstafel;
    }

    public function get_pdf_url() {
        return \$this->pdf_url;
    }

    public function get_coverimage_urls() {
        return \$this->coverimage_urls;
    }

    public function get_flipboek_id() {
        return \$this->flipboek_id;
    }

    public function get_jaargang_id() {
        return \$this->jaargang_id;
    }

    public function get_tijdschrift_id() {
        return \$this->tijdschrift_id;
    }

    public function get_formaat() {
        return \$this->formaat;
    }

    public function get_weergave_opties() {
        return \$this->weergave_opties;
    }

    public function get_tekst() {
        return \$this->tekst;
    }

    public function get_tags() {
        return \$this->tags;
    }

    public function get_aantal_paginas() {
        return \$this->aantal_paginas;
    }

    public function get_offset() {
        return \$this->offset;
    }

    public function get_post_id() {
        return \$this->post_id;
    }

    public function get_created_at() {
        return \$this->created_at;
    }

    public function get_updated_at() {
        return \$this->updated_at;
    }

    // Setters indien nodig
}
