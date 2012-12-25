<?php
/**
 * GoogleCheckout Config class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\tvr\googlecheckout\components;
use \Yii;

/**
 * GoogleCheckout Config class. Is used as a wrapper over the configuration settings
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components
 * @since 0.1
 */
class Config extends AbstractComponent
{
    /**
     * Test or live mode used
     * @var boolean
     */
    public $testMode = true;

    /**
     * Test merchant id from GoogleCheckout merchant account
     * @var string
     */
    public $testMerchantId = '';

    /**
     * Test merchant key from GoogleCheckout merchant account
     * @var string
     */
    public $testMerchantKey = '';

    /**
     * Test url for send data to sandbox
     * @var string
     */
    public $testUrl = 'https://sandbox.google.com/checkout/api/checkout/v2/checkout/Merchant/';

    /**
     * Live url fo send data on live merchant account
     * @var string
     */
    public $livetUrl = 'https://checkout.google.com/api/checkout/v2/checkout/Merchant/';

    /**
     * Live merchant id from GoogleCheckout merchant account
     * @var string
     */
    public $liveMerchantId = '';

    /**
     * Live merchantKey from GoogleCheckout merchant account
     * @var string
     */
    public $liveMerchantKey = '';

    /**
     * Continue Shopping Url
     * @var string
     */
    public $continueShoppingUrl = false;

    /**
     * This method return merchant key
     * @return string Merchant key
     */
    public function getMerchantKey()
    {
        if($this->testMode)
            return $this->testMerchantKey;
        return $this->liveMerchantKey;
    }

    /**
     * This method return merchant id
     * @return string Merchant id
     */
    public function getMerchantId()
    {
        if($this->testMode)
            return $this->testMerchantId;
        return $this->liveMerchantId;
    }
   
    /**
     * This method return checkout url
     * @return [type] [description]
     */
    public function getGoogleCheckoutUrl()
    {
        if($this->testMode)
            return $this->testUrl.$this->getMerchantId();
        return $this->livetUrl.$this->getMerchantId();
    }
}