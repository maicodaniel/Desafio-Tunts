<?php
namespace Control;

class Client{

    private $client;
    private $http;

    protected function getClient()
    {
        $this->http = new \GuzzleHttp\Client(["verify" => false]);
        $this->client = new \Google_Client();
        $this->client->setHttpClient($this->http);
        $this->client->setAuthConfig('../lib/credentials.json');
        $this->client->addScope(\Google\Service\Sheets::SPREADSHEETS);
        $this->client->setAccessType('offline');

        return $this->client;
    }
}