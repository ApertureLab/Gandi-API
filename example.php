<?php

// Composer autoloading
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    $loader = include __DIR__.'/vendor/autoload.php';
}

use ZendService\Gandi\Gandi;

try {
    $gandi = new Gandi(true);

    $apiKey = 'xxxxxxxxxx';

    // account info
    print_r($gandi->account->info([$apiKey]));

    // PASS vhost list
    print_r($gandi->paas->vhost->list([$apiKey]));

    // PASS vhost info
    print_r($gandi->paas->vhost->info([$apiKey, 'github.narno.org']));

    // PASS create (generic) vhost
    print_r($gandi->paas->vhost->create([
        $apiKey,
        [
            'paas_id'    => 00000,
            'vhost'      => time().'.narno.org',
            'override'   => false,
            'zone_alter' => true,
        ],
    ]));
} catch (Exception $e) {
    echo $e->getMessage();
}
