<?php

require __DIR__ . '/../vendor/autoload.php';

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
        try{

        
            $params = '?page=' . $page . '&limit=20';

            $response = $this->client->request('GET', $this->uri . $params, [
                'headers' => [
                'X-Authorization' => $this->apiKey,
                'accept' => 'application/json',
                ],
            ]);

            $statusCode = $response->getStatusCode();
            
            $data = json_decode($response->getBody(), true);

            return ['data' => $data, 'statusCode' => $statusCode];

        }catch(Throwable $e){

        }

        return ['data' => [], 'statusCode' => 500];
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }


}


if(isset($_GET['listAllProperties'])){

    $easyBrokerApi = new EasyBrokerAPI();
 
    $properties = $easyBrokerApi->listAllProperties($_GET['page']);
 
    echo json_encode($properties);
 
    return 0;
}
