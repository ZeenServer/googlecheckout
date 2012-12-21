<?php
/**
 * GoogleCheckout main component class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\googlecheckout\components;
use \Yii;

/**
 * Main GoogleCheckout component class. Work as service locator for extension
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components
 * @since 0.1
 */
class Component extends AbstractComponent
{   
    /**
     * Class name Api for XML generation
     * @var string
     */
    public $xmlClass = '\ext\googlecheckout\components\Xml';

    /**
     * Class name for config access
     * @var string
     */
    public $configClass = '\ext\googlecheckout\components\Config';

    /**
     * Wrapper class name over standard Google Checkout api class
     * @var string
     */
    public $requestClass = '\ext\googlecheckout\components\Request';

    /**
     * Wrapper class name over standard Google Checkout api class
     * @var string
     */
    public $responseClass = '\ext\googlecheckout\components\Response';

    /**
     * GoogleCheckout merchant options
     * example:
     * array(
     *   'testMode' => true,
     *   'testMerchantId' => '',
     *   'testMerchantKey' => '',
     *   'testUrl' => 'https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/',
     *   'livetUrl' => 'https://checkout.google.com/api/checkout/v2/checkout/Merchant/',
     *   'liveMerchantId' => '',
     *   'liveMerchantKey' => '',
     *   'continueShoppingUrl' => '',   
     * );
     * @var array
     */
    public $options = array();

    /**
     * Xml object builder
     * @return \ext\googlecheckout\components\Xml  Xml generation object
     */
    public function getXmlObj()
    {
        return Yii::createComponent(array(
            'class' => $this->xmlClass,
            'config' => $this->getConfigObj()
        ));
    }

    /**
     * Request obj builder
     * @return \ext\googlecheckout\components\Request  Request object for request manipulation
     */
    public function getRequestObj()
    {
        return Yii::createComponent(array(
            'class' => $this->requestClass,
            'config' => $this->getConfigObj(),
            'response' => $this->getResponseObj()
        ));
    }

    /**
     * Response object builder
     * @return \ext\googlecheckout\components\Response  Response object for response manipulation
     */
    public function getResponseObj()
    {
        return Yii::createComponent(array(
            'class' => $this->responseClass
        ));
    }

    /**
     * Config object builder
     * @return \ext\googlecheckout\components\Config  Config object for work with config params from options array
     */
    public function getConfigObj()
    {
        $config = array_merge(
            array('class' => $this->configClass),
            $this->options
        );
        return Yii::createComponent($config);
    }

    /**
     * Return base64 hash for cart xml 
     * @param  \ext\googlecheckout\components\interfaces\IOrder $order  IOrder object
     * @return string                                                   base64 hash
     */
    public function getHashCart(interfaces\IOrder $order)
    {
        return base64_encode($this->getXmlObj()->generateCartXml($order));
    }

    /**
     * Return base64 hash for cart signature 
     * @param  \ext\googlecheckout\components\interfaces\IOrder $order  IOrder object
     * @return string                                                   base64 hash
     */
    public function getHashSignature(interfaces\IOrder $order)
    {
        return base64_encode($this->getXmlObj()->generateCartSignature($order));
    }
}