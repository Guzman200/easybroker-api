<?php

use PHPUnit\Framework\TestCase;


class EasyBrokerAPITest extends TestCase {

    private $easyBrokerApi;

    public function setUp(): void {

        $this->easyBrokerApi = new EasyBrokerAPI();
    }

    public function testListAllProperties()
    {

        $response = $this->easyBrokerApi->listAllProperties(1);

        $this->assertEquals(200, $response['statusCode']);


    }

    public function testError500ListAllProperties()
    {
        $apiKeyWithError = 'l7u502p8v46ba3ppgvj5y2aad50lb9000';

        $this->easyBrokerApi->setApiKey($apiKeyWithError);

        $response = $this->easyBrokerApi->listAllProperties(1);

        $this->assertEquals(500, $response['statusCode']);
    }


}