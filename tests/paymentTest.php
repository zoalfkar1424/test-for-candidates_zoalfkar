<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class paymentTest extends WebTestCase
{
    public function testpaymentrequest()
    {
        $client = static::createClient();
        $testinput = $this->createInputRow();
        $client->request( 'POST','/Transaction/payment',$testinput);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($responseData);
        $message = $responseData['message'];
        $this->assertSame('Paypal Paid Successfully', $message);
    }

    private function createInputRow()
    {
        $inputRow = [
            'price' => 75,
            'paymentProcessor' => 'paypal'
        ];

        return $inputRow;
    }
}