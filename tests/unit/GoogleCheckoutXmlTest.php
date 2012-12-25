<?php

Yii::import('\ext\tvr\googlecheckout\components\interfaces\IGoogleCheckoutOrder');

use \ext\tvr\googlecheckout\components\interfaces as interfaces;

class GoogleCheckoutXmlTest extends CTestCase
{
    public $order = null;

    public function setUp()
    {
        $this->order = new Order();
        $this->order->setItems(
            array_map(
                function($item){
                    return new Product($item+1);
                }, 
                range(0, 5)
            )
        );
    }

    public function testInit()
    {
        $xmlGenObj = Yii::app()->getComponent('googlecheckout')->getXmlObj();
        $this->assertInstanceOf('\ext\tvr\googlecheckout\components\Xml', $xmlGenObj);
    }

    public function testGenerateCartXml()
    {
        $xml = Yii::app()->getComponent('googlecheckout')->getConfigObj()->continueShoppingUrl = '';
        $xml = Yii::app()->getComponent('googlecheckout')->getXmlObj()
                ->generateCartXml($this->order);

        $this->assertTrue(
                $xml == '<?xml version="1.0" encoding="UTF-8"?><checkout-shopping-cart xmlns="http://checkout.google.com/schema/2">   <shopping-cart>       <merchant-private-data>           <order_id>1</order_id>       </merchant-private-data>       <items><item>   <merchant-item-id>1</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item><item>   <merchant-item-id>2</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item><item>   <merchant-item-id>3</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item><item>   <merchant-item-id>4</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item><item>   <merchant-item-id>5</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item><item>   <merchant-item-id>6</merchant-item-id>   <item-name>Title</item-name>   <item-description>Description</item-description>   <unit-price currency="USD">35.00</unit-price>   <quantity>2</quantity></item>       </items>   </shopping-cart>   <checkout-flow-support>       <merchant-checkout-flow-support><continue-shopping-url>   http://www.yii.tvorzasp.com/googlecheckout/index.php</continue-shopping-url>       </merchant-checkout-flow-support>   </checkout-flow-support></checkout-shopping-cart>'
        );
    }
}

//--Mock Objects--//

class Order implements interfaces\IOrder
{
    public $items = array();

    public function getOrderId()
    {
        return 1;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}

class Product implements interfaces\IProduct
{
    private $_id;

    public function __construct($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getTitle()
    {
        return 'Title';
    }

    public function getDescription()
    {
        return 'Description';
    }

    public function getPrice()
    {
        return '35.00';
    }

    public function getQuantity()
    {
        return 2;
    }
}

