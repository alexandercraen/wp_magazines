<?php
namespace WPPlugin\Database;

use WPPlugin\Models\Publicatie;
use WPPlugin\Models\Formaat;
use WPPlugin\Models\Tijdschrift;
use WPPlugin\Models\Jaargang;

class DB {
    private $wpdb;

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->create_tables();
    }

    public function create_tables() {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $charset_collate = $this->wpdb->get_charset_collate();

        $tables = [
            'publicaties' => "
                CREATE TABLE {$this->wpdb->prefix}publicaties (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    titel text NOT NULL,
                    auteur text NOT NULL,
                    inhoud longtext NOT NULL,
                    publicatiedatum date NOT NULL,
                    korte_inhoud text NOT NULL,
                    inhoudstafel longtext NOT NULL,
                    pdf_url text NOT NULL,
                    coverimage_urls text NOT NULL,
                    flipboek_id mediumint(9) NOT NULL,
                    jaargang_id mediumint(9) NOT NULL,
                    tijdschrift_id mediumint(9) NOT NULL,
                    formaat text NOT NULL,
                    weergave_opties text NOT NULL,
                    tekst text NOT NULL,
                    tags text NOT NULL,
                    aantal_paginas mediumint(9) NOT NULL,
                    offset mediumint(9) NOT NULL,
                    post_id mediumint(9) NOT NULL,
                    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;",
            'formaten' => "
                CREATE TABLE {$this->wpdb->prefix}formaten (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    naam text NOT NULL,
                    beschrijving text NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;",
            'tijdschriften' => "
                CREATE TABLE {$this->wpdb->prefix}tijdschriften (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    naam text NOT NULL,
                    beschrijving text NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;",
            'jaargangen' => "
                CREATE TABLE {$this->wpdb->prefix}jaargangen (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    jaar int NOT NULL,
                    tijdschrift_id mediumint(9) NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;"
        ];

        foreach ($tables as $table_name => $sql) {
            dbDelta($sql);
        }
    }

    // CRUD operaties voor Publicatie
    public function insert_publicatie(Publicatie $publicatie) {
        return $this->wpdb->insert(
            "{$this->wpdb->prefix}publicaties",
            [
                'titel' => $publicatie->get_titel(),
                'auteur' => $publicatie->get_auteur(),
                'inhoud' => $publicatie->get_inhoud(),
                'publicatiedatum' => $publicatie->get_publicatiedatum(),
                'korte_inhoud' => $publicatie->get_korte_inhoud(),
                'inhoudstafel' => $publicatie->get_inhoudstafel(),
                'pdf_url' => $publicatie->get_pdf_url(),
                'coverimage_urls' => $publicatie->get_coverimage_urls(),
                'flipboek_id' => $publicatie->get_flipboek_id(),
                'jaargang_id' => $publicatie->get_jaargang_id(),
                'tijdschrift_id' => $publicatie->get_tijdschrift_id(),
                'formaat' => $publicatie->get_formaat(),
                'weergave_opties' => $publicatie->get_weergave_opties(),
                'tekst' => $publicatie->get_tekst(),
                'tags' => $publicatie->get_tags(),
                'aantal_paginas' => $publicatie->get_aantal_paginas(),
                'offset' => $publicatie->get_offset(),
                'post_id' => $publicatie->get_post_id(),
            ]
        );
    }

    public function get_publicatie($id) {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->wpdb->prefix}publicaties WHERE id = %d", $id));
    }

    public function get_all_publicaties() {
        return $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}publicaties");
    }

    public function update_publicatie(Publicatie $publicatie) {
        return $this->wpdb->update(
            "{$this->wpdb->prefix}publicaties",
            [
                'titel' => $publicatie->get_titel(),
                'auteur' => $publicatie->get_auteur(),
                'inhoud' => $publicatie->get_inhoud(),
                'publicatiedatum' => $publicatie->get_publicatiedatum(),
                'korte_inhoud' => $publicatie->get_korte_inhoud(),
                'inhoudstafel' => $publicatie->get_inhoudstafel(),
                'pdf_url' => $publicatie->get_pdf_url(),
                'coverimage_urls' => $publicatie->get_coverimage_urls(),
                'flipboek_id' => $publicatie->get_flipboek_id(),
                'jaargang_id' => $publicatie->get_jaargang_id(),
                'tijdschrift_id' => $publicatie->get_tijdschrift_id(),
                'formaat' => $publicatie->get_formaat(),
                'weergave_opties' => $publicatie->get_weergave_opties(),
                'tekst' => $publicatie->get_tekst(),
                'tags' => $publicatie->get_tags(),
                'aantal_paginas' => $publicatie->get_aantal_paginas(),
                'offset' => $publicatie->get_offset(),
                'post_id' => $publicatie->get_post_id(),
            ],
            ['id' => $publicatie->get_id()]
        );
    }

    public function delete_publicatie($id) {
        return $this->wpdb->delete(
            "{$this->wpdb->prefix}publicaties",
            ['id' => $id]
        );
    }

    // CRUD operaties voor Formaat
    public function insert_formaat(Formaat $formaat) {
        return $this->wpdb->insert(
            "{$this->wpdb->prefix}formaten",
            [
                'naam' => $formaat->get_naam(),
                'beschrijving' => $formaat->get_beschrijving(),
            ]
        );
    }

    public function get_formaat($id) {
        return $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->wpdb->prefix}formaten WHERE id = %d", $id));
    }

    public function get_all_formaten() {
        return $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}formaten");
    }

    public function update_formaat(Formaat $formaat) {
        return $this->wpdb->update(
            "{$this->wpdb->prefix}formaten",
            [
                'naam' => $formaat->get_naam(),
                'beschrijving' => $formaat->get_beschrijving(),
            ],
            ['id' => $formaat->get_id()]
        );
    }

    public function delete_formaat($id) {
        return $this->wpdb->delete(
            "{$this->wpdb->prefix}formaten",
            ['id' => $id]
        );
    }

    // Voeg CRUD operaties toe voor Tijdschrift en Jaargang indien nodig...
}
