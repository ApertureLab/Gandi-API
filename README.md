# Gandi API

A simple PHP library for the [Gandi API](http://doc.rpc.gandi.net/overview.html).

[![Latest Stable Version](https://poser.pugx.org/aperturelab/gandi-api/v/stable)](https://packagist.org/packages/aperturelab/gandi-api) [![Total Downloads](https://poser.pugx.org/aperturelab/gandi-api/downloads)](https://packagist.org/packages/aperturelab/gandi-api) [![License](https://poser.pugx.org/aperturelab/gandi-api/license)](https://github.com/ApertureLab/Gandi-API/blob/master/LICENSE) 

## Dependencies

* PHP 5.4+
* [zend-xmlrpc](https://github.com/zendframework/zend-xmlrpc)
* [Gandi API key](https://www.gandi.net/admin/api_key)

## Installation

The recommended way is through [Composer](https://getcomposer.org).

```bash
composer require aperturelab/gandi-api
```

## Usage

```php
<?php
use ApertureLab\Gandi\Api as GandiApi;

try {
    $api = new GandiApi();
    // set API key
    $params = ['your_api_key'];
    // fetches account informations...
    $account = $api->account->info($params);
    // and print
    print_r($account);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## License

Free software distributed under the terms of the [MIT license](http://opensource.org/licenses/MIT).

© [Arnaud Ligny](https://arnaudligny.fr)
