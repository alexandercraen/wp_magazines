<?php
namespace WPPlugin\Database;

use WPPlugin\Models\Tijdschrift;
use WPPlugin\Models\Jaargang;
use WPPlugin\Models\Publicatie;
use WPPlugin\Models\Formaat;

class DB {
    public function create_tables() {
        global \$wpdb;
        \$charset_collate = \$wpdb->get_charset_collate();

        \$tables = [
            'tijdschriften' => "CREATE TABLE {\$wpdb->prefix}tijdschriften (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                naam VARCHAR(255) NOT NULL,
                prefix VARCHAR(10) NOT NULL,
                beschrijving TEXT,
                logo_url VARCHAR(255),
                uitgeef_frequentie VARCHAR(50),
                startdatum DATE,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) \$charset_collate;",
            
            'jaargangen' => "CREATE TABLE {\$wpdb->prefix}jaargangen (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                jaar YEAR NOT NULL,
                tijdschrift_id BIGINT(20) UNSIGNED NOT NULL,
                publicatiedatum DATETIME NOT NULL,
                afbeelding_url VARCHAR(255),
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                FOREIGN KEY (tijdschrift_id) REFERENCES {\$wpdb->prefix}tijdschriften(id) ON DELETE CASCADE
            ) \$charset_collate;",
            
            'publicaties' => "CREATE TABLE {\$wpdb->prefix}publicaties (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                titel VARCHAR(255) NOT NULL,
                auteur VARCHAR(255),
                inhoud TEXT,
                publicatiedatum DATETIME NOT NULL,
                korte_inhoud VARCHAR(100),
                inhoudstafel TEXT,
                pdf_url VARCHAR(255),
                coverimage_urls JSON,
                flipboek_id VARCHAR(100),
                jaargang_id BIGINT(20) UNSIGNED NOT NULL,
                tijdschrift_id BIGINT(20) UNSIGNED NOT NULL,
                formaat VARCHAR(50) DEFAULT 'PDF',
                weergave_opties JSON,
                tekst TEXT,
                tags VARCHAR(255),
                aantal_paginas INT,
                offset INT,
                post_id BIGINT(20) UNSIGNED,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                FOREIGN KEY (jaargang_id) REFERENCES {\$wpdb->prefix}jaargangen(id) ON DELETE CASCADE,
                FOREIGN KEY (tijdschrift_id) REFERENCES {\$wpdb->prefix}tijdschriften(id) ON DELETE CASCADE
            ) \$charset_collate;",
            
            'formaten' => "CREATE TABLE {\$wpdb->prefix}formaten (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                publicatie_id BIGINT(20) UNSIGNED NOT NULL,
                type VARCHAR(50) NOT NULL,
                bestand_url VARCHAR(255) NOT NULL,
                beschrijving TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                FOREIGN KEY (publicatie_id) REFERENCES {\$wpdb->prefix}publicaties(id) ON DELETE CASCADE
            ) \$charset_collate;"
        ];

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        foreach (\$tables as \$table_name => \$sql) {
            dbDelta(\$sql);
        }
    }

    // CRUD operaties voor Tijdschrift
    public function insert_tijdschrift(Tijdschrift \$tijdschrift) {
        global \$wpdb;
        \$wpdb->insert("{\$wpdb->prefix}tijdschriften", [
            'naam' => \$tijdschrift->get_naam(),
            'prefix' => \$tijdschrift->get_prefix(),
            'beschrijving' => \$tijdschrift->get_beschrijving(),
            'logo_url' => \$tijdschrift->get_logo_url(),
            'uitgeef_frequentie' => \$tijdschrift->get_uitgeef_frequentie(),
            'startdatum' => \$tijdschrift->get_startdatum(),
        ]);
        return \$wpdb->insert_id;
    }

    public function update_tijdschrift(Tijdschrift \$tijdschrift) {
        global \$wpdb;
        \$wpdb->update("{\$wpdb->prefix}tijdschriften", [
            'naam' => \$tijdschrift->get_naam(),
            'prefix' => \$tijdschrift->get_prefix(),
            'beschrijving' => \$tijdschrift->get_beschrijving(),
            'logo_url' => \$tijdschrift->get_logo_url(),
            'uitgeef_frequentie' => \$tijdschrift->get_uitgeef_frequentie(),
            'startdatum' => \$tijdschrift->get_startdatum(),
        ], ['id' => \$tijdschrift->get_id()]);
    }

    public function delete_tijdschrift(\$id) {
        global \$wpdb;
        \$wpdb->delete("{\$wpdb->prefix}tijdschriften", ['id' => \$id]);
    }

    public function get_tijdschrift(\$id) {
        global \$wpdb;
        \$result = \$wpdb->get_row(\$wpdb->prepare("SELECT * FROM {\$wpdb->prefix}tijdschriften WHERE id = %d", \$id), ARRAY_A);
        if (\$result) {
            return new Tijdschrift(\$result);
        }
        return null;
    }

    public function get_all_tijdschriften() {
        global \$wpdb;
        \$results = \$wpdb->get_results("SELECT * FROM {\$wpdb->prefix}tijdschriften", ARRAY_A);
        \$tijdschriften = [];
        foreach (\$results as \$row) {
            \$tijdschriften[] = new Tijdschrift(\$row);
        }
        return \$tijdschriften;
    }

    // Vergelijkbare methoden voor Jaargang, Publicatie en Formaat
}
