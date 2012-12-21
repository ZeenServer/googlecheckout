<?php
/**
 * GoogleCheckout Xml class file
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @link http://www.zfort.com/
 * @copyright Copyright &copy; horechek
 * @license http://doc.tvorzasp.com/COPYING.txt
 */

namespace ext\googlecheckout\components;
use \Yii;

/**
 * GoogleCheckout Xml class. Is used as a xml generator
 * 
 * @author horechek <[horechek@gmail.](mailto:horechek@gmail)com\>
 * @version 0.1
 * @package ext\googlecheckout\components
 * @since 0.1
 */
class Xml extends AbstractComponent
{
    /**
     * Config object
     * @var \ext\googlecheckout\components\Config
     */
    public $config = null;

    /**
     * This method generate cart signature as string
     * @param  interfaces\IOrder $order Order object
     * @return string                   Google Checkout cart signature
     */
    public function generateCartSignature(interfaces\IOrder $order)
    {
        $cart = $this->generateCartXml($order);

        $key = $this->config->getMerchantKey();

        $blocksize = 64;
        $hash = 'sha1';

        if (strlen($key) > $blocksize) {
            $key = pack('H*', $hash($key));
        }

        $key = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack('H*', $hash(($key ^ $opad) . pack('H*', $hash(($key ^ $ipad) . $cart))));

        return $hmac;
    }

    /**
     * This method generate full cart xml 
     * @param  interfaces\IOrder $order Order object
     * @return string                   Cart xml 
     */
    public function generateCartXml(interfaces\IOrder $order)
    {
        $xml  = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<checkout-shopping-cart xmlns="http://checkout.google.com/schema/2">';
        $xml .= '   <shopping-cart>';
        $xml .= '       <merchant-private-data>';
        $xml .= '           <order_id>' . $order->getOrderId() . '</order_id>';
        $xml .= '       </merchant-private-data>'; 
        $xml .= '       <items>';
        $xml .= $this->generateProductsXml($order);
        $xml .= '       </items>';
        $xml .= '   </shopping-cart>';

        $xml .= '   <checkout-flow-support>';  
        $xml .= '       <merchant-checkout-flow-support>';
        $xml .= $this->generateReturnUrlXml();
        $xml .= '       </merchant-checkout-flow-support>';
        $xml .= '   </checkout-flow-support>';
        $xml .= '</checkout-shopping-cart>';

        return $xml;
    }

    /**
     * This method generate products section of cart xml
     * @param  interfaces\IOrder $order order object
     * @return sting                    cart xml 
     */
    protected function generateProductsXml(interfaces\IOrder $order)
    {
        $xml = '';

        $products = $order->getItems();

        foreach ($products as $product) { 
            
            if(!($product instanceof interfaces\IProduct))
                continue;

            $xml .= '<item>';
            $xml .= '   <merchant-item-id>' . $product->getId() . '</merchant-item-id>';

            $xml .= '   <item-name>' . $product->getTitle()  . '</item-name>'; 
            $xml .= '   <item-description>' . $product->getDescription() . '</item-description>';  
            $xml .= '   <unit-price currency="USD">' . $product->getPrice() . '</unit-price>';
            $xml .= '   <quantity>' . $product->getQuantity() . '</quantity>';

            $xml .= '</item>'; 
        }

        return $xml;
    }

    /**
     * This method generate continue-shopping-url section
     * @return string continue-shopping-url xml
     */
    protected function generateReturnUrlXml()
    {
        $xml = '';
        if($this->config->continueShoppingUrl){
            $xml .= '<continue-shopping-url>';
            $xml .= '   '.$this->config->continueShoppingUrl;
            $xml .= '</continue-shopping-url>';
        }

        return $xml;
    }
}