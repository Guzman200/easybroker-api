<?php

require_once('../vendor/autoload.php');

class EasyBrokerAPI {

    private $client;
    private $uri;
    private $apiKey;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->uri    = "https://api.stagingeb.com/v1/properties";
        $this->apiKey = "l7u502p8v46ba3ppgvj5y2aad50lb9";
    }

    public function listAllProperties($page)
    {
        $params = '?page=' . $page . '&limit=20';

        $response = $this->client->request('GET', $this->uri . $params, [
            'headers' => [
              'X-Authorization' => $this->apiKey,
              'accept' => 'application/json',
            ],
        ]);
          
        return json_decode($response->getBody(), true);
    }



}


if(isset($_GET['listAllProperties'])){

    $easyBrokerApi = new EasyBrokerAPI();
 
    $properties = $easyBrokerApi->listAllProperties($_GET['page']);
 
    echo json_encode(['data' => $properties]);
 
    return 0;
}
