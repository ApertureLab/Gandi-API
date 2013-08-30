Description
-----------

_Zend_Service_Gandi_ provides a simple PHP library for the Gandi API.

Gandi API documentation: http://doc.rpc.gandi.net


Dependencies
------------

* PHP 5.2.4+
* Zend Framework: http://www.framework.zend.com/downloads/latest#ZF1
* Gandi account: https://www.gandi.net


How to use
----------

```php
<?php
require_once 'Zend/Service/Gandi.php';

try {
    $gandi = new Zend_Service_Gandi('your_api_key');
    // Get VM infos
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

_Narno_Service_Gandi_ is released under the terms of the [MIT license](http://opensource.org/licenses/MIT).

Copyright (c) 2011-2012 Arnaud Ligny

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
