<?php
/**
 * ZendService\Gandi.
 *
 * @link      https://github.com/Narno/ZendService_Gandi
 *
 * @copyright Copyright (c) 2011-2014 Arnaud Ligny
 * @license   http://opensource.org/licenses/MIT MIT license
 */
namespace ZendService\Gandi;

use Zend\Http\Client as HttpClient;
use Zend\XmlRpc;

/**
 * @category   Zend
 */
class Gandi
{
    /**
     * XML-RPC client.
     *
     * @var Zend\XmlRpc\Client
     */
    protected $xmlRpcClient;

    /**
     * Current method category (for method proxying).
     *
     * @var string
     */
    protected $methodCategory;

    /**
     * Categories of API methods.
     *
     * @var array
     */
    protected $methodCategories = [
        'account',
        'catalog',
        'cert',
        'chnageowner',
        'contact',
        'datacenter',
        'disk',
        'domain',
        'hosting',
        'iface',
        'image',
        'ip',
        'operation',
        'paas',
        'product',
        'site',
        'system',
        'version',
        'vm',
    ];

    /**
     * Instantiates the XML-RPC client.
     */
    public function __construct()
    {
        try {
            $this->xmlRpcClient = new XmlRpc\Client(null);
            $httpClient = new HttpClient('https://rpc.gandi.net/xmlrpc/', [
                'adapter'       => 'Zend\Http\Client\Adapter\Socket',
                'sslverifypeer' => false,
            ]);
            $this->xmlRpcClient->setHttpClient($httpClient);
            $this->xmlRpcClient->setSkipSystemLookup(true);
        } catch (XmlRpc\Client\FaultException $e) {
            throw new Exception('Fault Exception: '.$e->getCode()."\n".$e->getMessage());
        } catch (XmlRpc\Client\HttpException $e) {
            throw new Exception('HTTP Exception: '.$e->getCode()."\n".$e->getMessage());
        }
    }

    /**
     * Proxy service methods category.
     *
     * @param string $category
     *
     * @throws Exception If method not in method categories list
     *
     * @return self
     */
    public function __get($category)
    {
        $category = strtolower($category);
        $this->methodCategory[] = $category;

        return $this;
    }

    /**
     * Method overloading.
     *
     * @param string $method
     * @param array  $params
     *
     * @throws Exception\RuntimeException if unable to find method
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $params = [];
        $apiMethod = '';

        $method = strtolower($method);
        if (!empty($args)) {
            $params = $args[0];
            if (!is_array($params)) {
                throw new Exception\RuntimeException(
                    '$params should be an array'
                );
            }
        }

        /*
         * If method category is not setted
         */
        if (empty($this->methodCategory)) {
            throw new Exception\RuntimeException(
                'Invalid method "'.$method.'"'
            );
        }

        /*
         * Build method name: category1 + category2 + categoryX + method
         */
        foreach ($this->methodCategory as $methodCategory) {
            $apiMethod .= $methodCategory.'.';
        }
        $this->methodCategory = [];
        $method = $apiMethod.$method;

        /*
         * Request API directly
         */
        return $this->request($method, $params);
    }

    /**
     * Gandi API call.
     *
     * @param string $method
     * @param array  $params
     *
     * @return array
     */
    private function request($method, $params = [])
    {
        try {
            return $this->xmlRpcClient->call($method, $params);
        } catch (XmlRpc\Client\FaultException $e) {
            throw new Exception('Fault Exception: '.$e->getCode()."\n".$e->getMessage());
        }
    }

    /**
     * Introspection.
     *
     * @todo useful or not?
     */

    /**
     * Available methods.
     *
     * @return array
     */
    public function listMethods()
    {
        return $this->request('system.listMethods');
    }

    /**
     * Method help.
     *
     * @param string $method Method name
     *
     * @return array
     */
    public function methodHelp($method)
    {
        return $this->request('system.methodHelp', [$method]);
    }

    /**
     * Method signature.
     *
     * @param string $method Method name
     *
     * @return array
     */
    public function methodSignature($method)
    {
        return $this->request('system.methodSignature', [$method]);
    }
}
