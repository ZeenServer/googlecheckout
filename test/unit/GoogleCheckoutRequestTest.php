<?php 

use \ext\googlecheckout\exceptions as exceptions;
class GoogleCheckoutRequestTest extends CTestCase
{
    public $serialNumber = false; 

    public $request = null;

    public function setUp()
    {
        $_POST['serial-number'] = $this->serialNumber = 'xxxxxxxxxx-xxxx';
        $this->request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
    }

    public function testRequest()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
        $this->assertInstanceOf('\ext\googlecheckout\components\Request', $request);
    }

    public function testResponse()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
        $request->serialNumber = $this->serialNumber;
        $response = $request->doRequest(); 
        $this->assertsInstanceOf('\ext\googlecheckout\components\Response', $response);
        
        $this->assertTrue($response->getOrderId() == 1 );

    }

    /**
     * @expectedException ext\googlecheckout\exceptions\RequestException
     */
    public function testRequestException()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
        $request->serialNumber = false;
        $response = $request->doRequest();     
    }
}
