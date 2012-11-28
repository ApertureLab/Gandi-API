<?php
/**
 * @package Narno_Service
 */

/**
 * @category   Narno
 * @package    Narno_Service
 * @subpackage Gandi
 */
class Narno_Service_Gandi
{
    /**
     * Gandi Hosting API key
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
        /**
         * @see Zend_XmlRpc_Client
         */
        require_once 'Zend/XmlRpc/Client.php';
        try {
            $this->_client = new Zend_XmlRpc_Client('https://rpc.gandi.net/xmlrpc/');
            $this->_client->setSkipSystemLookup(true);
        } catch (Zend_XmlRpc_Client_FaultException $e) {
            throw new Exception('Fault Exception: ' . $e->getCode() . "\n" . $e->getMessage());
        } catch (Zend_XmlRpc_Client_HttpException $e) {
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
        } catch (Zend_XmlRpc_Client_FaultException $e) {
            throw new Exception('Fault Exception: ' . $e->getCode() . "\n" . $e->getMessage());
        }
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
     * Get VM info by VM Id filter
     * 
     * @param integer $id
     * @return array
     */
    public function getVmInfo($id)
    {
        return $this->_call('vm.info', array($this->_apiKey, (int)$id));
    }
    
    /**
     * Return graph URL
     * 
     * @param integer $vmId
     * @param string $target vcpu, vdi or vif
     * @param integer $deviceNumber
     * @return string URL
     */
    public function getGraph($vmId, $target, $deviceNumber)
    {
        $vmInfo = $this->getVmInfo($vmId);
        try {
            return $vmInfo['graph_urls'][$target][$deviceNumber];
        } catch (Exception $e) {
            throw new Exception($e->getTraceAsString());
        }
    }
    
    /**
     * @todo PASS functions
     */
    public function getPassInfo($id)
    {
        return $this->_call('paas.info', array($this->_apiKey, (int)$id));
    }
}