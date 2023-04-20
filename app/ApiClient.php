<?php

namespace App;

use App\Currency;
use GuzzleHttp\Client;

class ApiClient
{
  private Client $client;
  private array $currencies;

  public function __construct()
  {
    $this->client = new Client(['verify' => false]);
  }

  public function convert(float $amount, string $convertTo): float
  {
    $this->getConversionRates();
    /** @var Currency $currency */
    $currency = $this->currencies[$convertTo];
    if($currency == null){
      return 0;
    }
    return $amount * $currency->getAmount();
  }
  private function getConversionRates(): void
  {
    $url = "https://www.latvijasbanka.lv/vk/ecb.xml";
    $response = $this->client->request('GET', $url);
    $records = simplexml_load_string($response->getBody()->getContents());
    foreach ($records->Currencies->Currency as $record){
      $this->currencies[(string)$record->ID] = new Currency((string)$record->ID, (float)$record->Rate);
    }
  }
}