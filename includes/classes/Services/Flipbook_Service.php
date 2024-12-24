<?php
namespace WPPlugin\Services;

use WPPlugin\Interfaces\Flipbook_Interface;
use WPPlugin\Models\Publicatie;

class Flipbook_Service implements Flipbook_Interface {
    public function create_flipbook(Publicatie $publicatie) {
        // Implementatie voor dFlip
    }

    public function update_flipbook(Publicatie $publicatie) {
        // Implementatie voor dFlip
    }

    public function delete_flipbook(Publicatie $publicatie) {
        // Implementatie voor dFlip
    }

    public function get_flipbook_shortcode(Publicatie $publicatie) {
        return '[dflip id="' . esc_attr($publicatie->get_flipboek_id()) . '"]';
    }
}
