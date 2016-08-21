# ZendService_Gandi

*ZendService_Gandi* provides a simple PHP library for the [Gandi API](http://doc.rpc.gandi.net/overview.html).

## Dependencies

* PHP 5.4+
* [zend-xmlrpc](https://github.com/zendframework/zend-xmlrpc)
* [Gandi API key](https://www.gandi.net/admin/api_key)

## Installation

The recommended way is through [Composer](https://getcomposer.org).
```
$ composer require narno/zendservice-gandi
```

## Usage

```php
<?php
use ZendService\Gandi\Gandi;

try {
    $gandi = new Gandi();
    // set API key
    $params = ['your_api_key'];
    // fetches account informations...
    $account = $gandi->account->info($params);
    // and print
    print_r($account);
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## License

*ZendService_Gandi* is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2016 Arnaud Ligny
