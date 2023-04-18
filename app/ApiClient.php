<?php

namespace App;

use GuzzleHttp\Client;

class ApiClient
{
  private Client $client;

  public function __construct()
  {
    $this->client = new Client(['verify' => false]);
  }

  public function getConversionRates(): object
  {
    $url = "https://www.latvijasbanka.lv/vk/ecb.xml";
    $response = $this->client->request('GET', $url);
    $xml = simplexml_load_string($response->getBody()->getContents());
    $json = json_encode($xml);
    return json_decode($json);
  }
}