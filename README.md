# Gandi-API

*Gandi-API* provides a simple PHP library for the [Gandi API](http://doc.rpc.gandi.net/overview.html).

## Dependencies

* PHP 5.4+
* [zend-xmlrpc](https://github.com/zendframework/zend-xmlrpc)
* [Gandi API key](https://www.gandi.net/admin/api_key)

## Installation

The recommended way is through [Composer](https://getcomposer.org).
```
$ composer require narno/gandi-api
```

## Usage

```php
<?php
use Narno\Gandi\Api as GandiAPI;

try {
    $api = new GandiAPI();
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

*Gandi-API* is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2016 Arnaud Ligny
