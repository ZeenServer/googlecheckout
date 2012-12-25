<?php
/**
 * GoogleCheckout CallbackAction file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\tvr\googlecheckout\actions;
use \ext\tvr\googlecheckout\exceptions as exceptions;
use \ext\tvr\googlecheckout\components as components;
use \Yii;

/**
 * GoogleCheckout CallbackAction class. Is used as a xml generator
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\actions
 * @since 0.1
 */
class CallbackAction extends \CAction
{
    /**
     * Executes the action
     */
    public function run()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();

        if(!Yii::app()->getRequest()->getPost('serial-number'))
            throw new exceptions\RequestException("Error Processing Request");
        
        $request->serialNumber = Yii::app()->getRequest()->getPost('serial-number');
        $response = $request->doRequest();

        if($response)
            $this->onResponse($response);
            
    }

    /**
     * Work with infirmation from google checkout order
     * @param  components\Response $response
     * @return boolean                        
     */
    public function onResponse(components\Response $response)
    {
        Yii::log($response->getOrderId(), 'info', 'ext.googlecheckout.actions.CallbackAction');

        return true;
    }
}