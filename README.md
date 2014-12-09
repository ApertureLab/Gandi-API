Description
-----------

*ZendService_Gandi* provides a simple PHP library for the [Gandi API](http://doc.rpc.gandi.net).


Dependencies
------------

* PHP 5.3+
* [Zend\Xmlrpc](https://github.com/zendframework/Component_ZendXmlRpc)
* [Zend\Xml](https://github.com/zendframework/ZendXml)
* [Gandi](https://www.gandi.net) account


Installation
------------

The recommended way is through [Composer](https://getcomposer.org).

    {
        "require": {
            "narno/zendservice-gandi": "dev-master"
        }
    }


Usage
-----

```php
<?php
// Composer autoloading
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    $loader = include __DIR__ . '/vendor/autoload.php';
}

use ZendService\Gandi\Gandi;

try {
    $gandi = new Gandi();
    // set API key
    $params = array('your_api_key');
    // fetches account informations...
    $account = $gandi->account->info($params);
    // and print
    print_r($account);
} catch (Exception $e) {
    echo $e->getMessage();
}
```


License
-----------

*ZendService_Gandi* is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2014 Arnaud Ligny
