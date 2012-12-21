<?php
/**
 * GoogleCheckout Response class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\googlecheckout\components;
use \ext\googlecheckout\exceptions as exceptions;
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
class Response extends AbstractComponent
{
    /**
     * \GoogleNotificationHistoryRequest::SendNotificationHistoryRequest results
     * @var array
     */
    private $_googleResponce = array();

    /**
     * SimpleXMLElement object
     * @var [type]
     */
    private $_xml = null;

    /**
     * This method set xml and other response info in to response object
     * @param   array  $googleResponce                   \GoogleNotificationHistoryRequest::SendNotificationHistoryRequest results
     * @return  \ext\googlecheckout\components\Response   
     */
    public function build(array $googleResponce)
    {
        $this->_googleResponce = $googleResponce;

        libxml_use_internal_errors(true); 
        $this->_xml = simplexml_load_string($googleResponce[1]);    

        if(!$this->_xml)
            throw new exceptions\ResponseException("Error Response Request");
      
        return $this;
    }

    /**
     * This method return order id from response xml
     * @return string Order id in our store
     */
    public function getOrderId()
    {
        return $this->_xml->{'shopping-cart'}->{'merchant-private-data'}->order_id;
    }

    /**
     * This method return full response xml as \SimpleXMLElemen 
     * @return \SimpleXMLElemen 
     */
    public function getXml()
    {
        return $this->_xml;
    }
}