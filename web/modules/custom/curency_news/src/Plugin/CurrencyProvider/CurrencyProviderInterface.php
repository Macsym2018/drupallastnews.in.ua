<?php

namespace Drupal\curency_news\Plugin\CurrencyProvider;

interface CurrencyProviderInterface {
  public function getExchangeRate(string $currencyCode): float;
}
