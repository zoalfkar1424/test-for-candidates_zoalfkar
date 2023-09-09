<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class getPriceTest extends WebTestCase
{
    public function testgetPrice()
    {
        $client = static::createClient();
        $testinput = $this->createInputRow();
        $client->request( 'POST','/Transaction/getPrice',$testinput);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertIsArray($responseData);
        $price = $responseData['data'];
        $this->assertEquals(107.1, $price);
    }

    private function createInputRow()
    {
        $inputRow = [
            'product' => '1',
            'taxNumber' => 'DE123456789',
            'couponCode' => 'D16',
            'paymentProcessor' => 'paypal'
        ];

        return $inputRow;
    }
}