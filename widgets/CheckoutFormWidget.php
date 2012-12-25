<?php 
/**
 * GoogleCheckout CheckoutFormWidget file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */


namespace ext\tvr\googlecheckout\widgets;
use Yii;
/**
 * GoogleCheckout CheckoutFormWidget widget file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\widgets
 * @since 0.1
 */
class CheckoutFormWidget extends \CWidget
{
    /**
     * Cart hash for send to google checkout
     * @var string
     */
    private $_cartHash = '';

    /**
     * Signature hash for send to google checkout
     * @var string
     */
    private $_signature = '';

    /**
     * Google checkout url 
     * @var string
     */
    private $_action = '';

    /**
     * IOrder object
     * @var \ext\googlecheckout\interfaces\IOrder
     */
    public $order = null;

    /**
     * Initializes the widget
     */
    public function init()
    {
        $this->_cartHash = Yii::app()->getComponent('googlecheckout')->getHashCart($this->order);
        $this->_signature = Yii::app()->getComponent('googlecheckout')->getHashSignature($this->order);
        $this->_action = Yii::app()->getComponent('googlecheckout')->getConfigObj()->getGoogleCheckoutUrl();
    }

    /**
     * Executes the widget
     */
    public function run()
    {
        $this->render('google_checkout_form', array(
            'cart'      => $this->_cartHash,
            'signature' => $this->_signature,
            'action'    => $this->_action
        ));
    }

}