<?php 

use \ext\tvr\googlecheckout\exceptions as exceptions;
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
        $this->assertInstanceOf('\ext\tvr\googlecheckout\components\Request', $request);
    }

    public function testResponse()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
        $request->serialNumber = $this->serialNumber;
        $response = $request->doRequest(); 
        $this->assertsInstanceOf('\ext\tvr\googlecheckout\components\Response', $response);
        
        $this->assertTrue($response->getOrderId() == 1 );

    }

    /**
     * @expectedException ext\tvr\googlecheckout\exceptions\RequestException
     */
    public function testRequestException()
    {
        $request = Yii::app()->getComponent('googlecheckout')->getRequestObj();
        $request->serialNumber = false;
        $response = $request->doRequest();     
    }
}
