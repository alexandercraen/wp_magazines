<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

global \$wpdb;

// Verwijder aangepaste tabellen
\$tables = ['tijdschriften', 'jaargangen', 'publicaties', 'formaten'];

foreach (\$tables as \$table) {
    \$wpdb->query( "DROP TABLE IF EXISTS {\$wpdb->prefix}\$table" );
}

// Verwijder opties of andere data indien nodig
