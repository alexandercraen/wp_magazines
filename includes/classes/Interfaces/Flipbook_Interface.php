<?php
namespace WPPlugin\Interfaces;

use WPPlugin\Models\Publicatie;

interface Flipbook_Interface {
    public function create_flipbook(Publicatie $publicatie);
    public function update_flipbook(Publicatie $publicatie);
    public function delete_flipbook(Publicatie $publicatie);
    public function get_flipbook_shortcode(Publicatie $publicatie);
}
