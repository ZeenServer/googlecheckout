<?php
/**
 * GoogleCheckout Request class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\tvr\googlecheckout\components;

use \ext\tvr\googlecheckout\exceptions as exceptions;
use \Yii;

require_once dirname(__FILE__)."/../vendors/google/library/googlenotificationhistory.php";

/**
 * GoogleCheckout Response class.
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components
 * @since 0.1
 */
class Request extends AbstractComponent
{
    /**
     * Config object
     * @var \ext\googlecheckout\components\Config
     */
    public $config = null;

    /**
     * Response object
     * @var \ext\googlecheckout\components\Response
     */
    public $response = null;

    /**
     * Number returned by google in POST
     * @var string
     */
    public $serialNumber = '';

    /**
     * This method create GoogleNotificationHistoryRequest to merchant account
     * by 'serial-number' and return xml response. Used on callback action
     * @return \ext\googlecheckout\components\Response Response object
     */
    public function doRequest()
    {
        $googleNotificationHistoryRequest = new \GoogleNotificationHistoryRequest(
            $this->config->getMerchantId(),
            $this->config->getMerchantKey()
        );

        if(!$this->serialNumber)
            throw new exceptions\RequestException("Error Processing Request");

        Yii::log($this->serialNumber, 'info', 'ext.*');

        $googleResponce = $googleNotificationHistoryRequest->SendNotificationHistoryRequest($this->serialNumber, null, array('risk-information', 'charge-amount', 'order-state-change'));

        return $this->buildResponce($googleResponce);
    }

    /**
     * This method build responce from GoogleNotificationHistoryRequest results
     * @param  array $googleResponce                    Data from merchant account
     * @return \ext\googlecheckout\components\Response  Response object
     */
    public function buildResponce(array $googleResponce)
    {
        return $this->response->build($googleResponce);
    }
}