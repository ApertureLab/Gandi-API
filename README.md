Description
-----------

*ZendService_Gandi* provides a simple PHP library for the [Gandi API](http://doc.rpc.gandi.net).


Dependencies
------------

* PHP 5.3+
* Zend\Xmlrpc
* Zend\Xml
* [Gandi](https://www.gandi.net) account


Installation
------------

You can install this component using Composer with following commands:

    curl -s https://getcomposer.org/installer | php
    php composer.phar install


Usage
-----

```php
<?php
// Composer autoloading
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    $loader = include __DIR__ . '/vendor/autoload.php';
}

use ZendService\Gandi\Gandi as Gandi;

try {
    $gandi = new Gandi('your_api_key');
    // Fetches VM infos and print
    print_r($gandi->getVmInfo('your_vm_id'));
} catch (Exception $e) {
    echo $e->getMessage();
}
```


License
-----------

*ZendService_Gandi* is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2014 Arnaud Ligny
