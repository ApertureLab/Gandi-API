Description
-----------

Zend Framework Gandi API Service extension.

Installation
-----------
1. Place the folder 'Narno' in your library path (next to the Zend folder)
2. Register the namespace 'Narno' or include le library via `require_once 'Narno/Service/gandi.php';`

Usage
-----------

```php
<?php
try {
    $gandi = new Narno_Service_Gandi('your_api_key');
    
    Zend_Debug::dump($gandi->getVmInfo('your_vm_id'));

} catch (Exception $e) {
    echo $e->getMessage();
}
```

Available Methods
-----------

* _getAccountInfo()_: Get Gandi Hosting account info
* _getVmList()_: Get VM list
* _getVmInfo($id)_: Get VM info by VM Id filter
* _getGraph($vmId, $target, $deviceNumber)_: Return graph URL

License
-----------

_Narno_Service_Gandi_ is released under the terms of the [Open Software License 3.0](http://opensource.org/licenses/OSL-3.0).

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.