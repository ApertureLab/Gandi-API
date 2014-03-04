Description
-----------

*Zend_Service_Gandi* provides a simple PHP library for the [Gandi API](http://doc.rpc.gandi.net).


Dependencies
------------

* PHP 5.2.4+
* [Zend Framework 1](http://www.framework.zend.com/downloads/latest#ZF1)
* [Gandi](https://www.gandi.net) account


Usage
-----

```php
<?php
require_once 'Zend/Service/Gandi.php';

try {
    $gandi = new Zend_Service_Gandi('your_api_key');
    // Fetches VM infos and print
    print_r($gandi->getVmInfo('your_vm_id'));
} catch (Exception $e) {
    echo $e->getMessage();
}
```


Available Methods
-----------------

* Hosting
  * _getAccountInfo()_: Get Gandi Hosting account info
  * _getVmList()_: Get VM list
  * _getVmInfo($id)_: Get VM info by VM Id filter
  * _getGraph($vmId, $target, $deviceNumber)_: Return graph URL
* PASS
  * _getPassInfo($id)_: Get Gandi PASS info


License
-----------

*Narno_Service_Gandi* is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2012 Arnaud Ligny
