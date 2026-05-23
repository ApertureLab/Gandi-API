<?php

// Composer autoloading
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    $loader = include __DIR__.'/vendor/autoload.php';
}

define('API_KEY', 'xxxxxxxxxxxxxxxxxxxxxxxx');

use ApertureLab\Gandi\Api as GandiApi;

try {
    $api = new GandiApi(true);

    // account info
    print_r($api->account->info([API_KEY]));

    // PASS vhost list
    print_r($api->paas->vhost->list([API_KEY]));

    // PASS vhost info
    print_r($api->paas->vhost->info([API_KEY, 'github.aperturelab.fr']));

    // PASS create (generic) vhost
    print_r($api->paas->vhost->create([
        API_KEY,
        [
            'paas_id'    => 00000,
            'vhost'      => time().'.aperturelab.fr',
            'override'   => false,
            'zone_alter' => true,
        ],
    ]));
} catch (Exception $e) {
    echo $e->getMessage();
}
