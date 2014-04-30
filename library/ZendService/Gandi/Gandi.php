<?php
/**
 * ZendService\Gandi
 *
 * @link      https://github.com/Narno/Zend_Service_Gandi
 * @copyright Copyright (c) 2011-2014 Arnaud Ligny
 * @license   http://opensource.org/licenses/MIT MIT license
 * @package   Zend_Service
 */

namespace ZendService\Gandi;

use Zend\XmlRpc;
use Zend\Http\Client as HttpClient;

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Gandi
 */
class Gandi
{
    /**
     * Gandi API key
     *
     * @var string
     */
    protected $_apiKey;

    /**
     * Reference to the XML-RPC client
     * 
     * @var Zend_XmlRpc_Client
     */
    protected $_client;

    /**
     * Sets the API key and instantiates the XML-RPC client
     * 
     * @param  string $apiKey
     * @return void
     */
    public function __construct($apiKey)
    {
        $this->_apiKey = (string) $apiKey;

        try {
            $httpClient = new HttpClient('https://rpc.gandi.net/xmlrpc/', array(
                'adapter' => 'Zend\Http\Client\Adapter\Socket',
                'sslverifypeer' => false
            ));
            $this->_client = new XmlRpc\Client(null);
            $this->_client->setHttpClient($httpClient);
            $this->_client->setSkipSystemLookup(true);
        } catch (XmlRpc\Client\FaultException $e) {
            throw new Exception('Fault Exception: ' . $e->getCode() . "\n" . $e->getMessage());
        } catch (XmlRpc\Client\HttpException $e) {
            throw new Exception('HTTP Exception: ' . $e->getCode() . "\n" . $e->getMessage());
        }
    }

    /**
     * Gandi API call
     * 
     * @param string $method
     * @param array $params
     * @return array
     */
    private function _call($method, $params = NULL) {
        try {
            return $this->_client->call($method, $params);
        } catch (XmlRpc\Client\FaultException $e) {
            throw new Exception('Fault Exception: ' . $e->getCode() . "\n" . $e->getMessage());
        }
    }

    /**
     * Introspection
     * 
     * @return array
     */
    public function listMethods()
    {
        return $this->_call('system.listMethods');
    }

    /**
     * Available methods
     * 
     * @param  string $method Method name
     * @return array
     */
    public function methodHelp($method)
    {
        return $this->_call('system.methodHelp', array($method));
    }

    /**
     * methodSignature description
     * 
     * @param  string $method Method name
     * @return array
     */
    public function methodSignature($method)
    {
        return $this->_call('system.methodSignature', array($method));
    }

    /**
     * Get Gandi Hosting account info
     * 
     * @return array
     */
    public function getAccountInfo()
    {
        return $this->_call('account.info', array($this->_apiKey));
    }
    
    /**
     * Get VM list
     * 
     * @return array 
     */
    public function getVmList()
    {
        return $this->_call('vm.list', array($this->_apiKey));
    }
    
    /**
     * Get VM info
     * 
     * @param integer PASS id
     * @return array
     */
    public function getVmInfo($id)
    {
        return $this->_call('vm.info', array($this->_apiKey, (int)$id));
    }
    
    /**
     * Get PASS info
     * 
     * @param  integer $id PASS id
     * @return array
     */
    public function getPassInfo($id)
    {
        return $this->_call('paas.info', array($this->_apiKey, (int)$id));
    }

    /**
     * Get PASS list
     * 
     * @return array
     */
    public function getPassList()
    {
        return $this->_call('paas.list', array($this->_apiKey));
    }
}