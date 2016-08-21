<?php
/**
 * ZendService\Gandi.
 *
 * @link      https://github.com/Narno/ZendService_Gandi
 *
 * @copyright Copyright (c) 2011-2016 Arnaud Ligny
 * @license   http://opensource.org/licenses/MIT MIT license
 */
namespace ZendService\Gandi;

use Zend\Http\Client as HttpClient;
use Zend\XmlRpc;
use Zend\XmlRpc\Client\Exception\FaultException;
use Zend\XmlRpc\Client\Exception\HttpException;
use ZendService\Gandi\Exception\RuntimeException;

/**
 * @category Zend
 */
class Gandi
{
    /**
     * XML-RPC client.
     *
     * @var XmlRpc\Client
     */
    protected $xmlRpcClient;

    /**
     * Current method category (for method proxying).
     *
     * @var string|array
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
        'changeowner',
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
     *
     * @param bool $ote Set to true to use Operational Test and Evaluation
     */
    public function __construct($ote = false)
    {
        try {
            $this->xmlRpcClient = new XmlRpc\Client(null);
            $httpClient = new HttpClient($ote ? 'https://rpc.ote.gandi.net/xmlrpc/' : 'https://rpc.gandi.net/xmlrpc/', [
                'adapter'       => 'Zend\Http\Client\Adapter\Socket',
                'sslverifypeer' => false,
            ]);
            $this->xmlRpcClient->setHttpClient($httpClient);
            $this->xmlRpcClient->setSkipSystemLookup(true);
        } catch (FaultException $e) {
            throw new RuntimeException('Fault Exception: '.$e->getCode()."\n".$e->getMessage());
        } catch (HttpException $e) {
            throw new RuntimeException('HTTP Exception: '.$e->getCode()."\n".$e->getMessage());
        }
    }

    /**
     * Proxy service methods category.
     *
     * @param string $category
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
     * @param array  $args
     *
     * @throws RuntimeException if unable to find method
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
                throw new RuntimeException(
                    '$params should be an array'
                );
            }
        }

        /*
         * If method category is not set
         */
        if (empty($this->methodCategory)) {
            throw new RuntimeException(
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
        } catch (FaultException $e) {
            throw new RuntimeException('Fault Exception: '.$e->getCode()."\n".$e->getMessage());
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
