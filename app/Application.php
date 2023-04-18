<?php

namespace App;

use App\ApiClient;

class Application
{
  private ApiClient $apiClient;
  public function __construct()
  {
    $this->apiClient = new ApiClient();
  }
  public function convert(float $eurAmount, string $pickedCurrency): ?float
  {
    $result = null;
    foreach ($this->apiClient->getConversionRates()->Currencies as $currency){
      var_dump($currency);
      if($currency->ID == $pickedCurrency){
        $result = $eurAmount * $currency->Rate;
      }
    }
    $this->notFound();
    return $result;
  }
  public function run(): void
  {
    $amount = $this->inquireAmount();
    $currency = $this->inquireCurrency();
    echo $this->convert($amount, $currency);
  }
  private function notFound(): void
  {
    echo 'Invalid input.';
  }

  private function inquireAmount(): string
  {
    return readline('Input amount: ');
  }
  private function inquireCurrency(): string
  {
    return readline('Input currency: ');
  }
}