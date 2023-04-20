<?php declare(strict_types=1);

namespace App;

class Currency
{
  private string $name;
  private float $amount;

  public function __construct(string $name, float $amount)
  {
    $this->name = $name;
    $this->amount = $amount;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getAmount(): float
  {
    return $this->amount;
  }
}