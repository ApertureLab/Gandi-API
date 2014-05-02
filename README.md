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
