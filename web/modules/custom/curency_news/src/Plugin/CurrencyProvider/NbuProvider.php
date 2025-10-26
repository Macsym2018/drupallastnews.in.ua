<?php

namespace Drupal\curency_news\Plugin\CurrencyProvider;

use Drupal\curency_news\Annotation\CurrencyProvider;

/**
 * @CurrencyProvider(
 *   id = "nbu",
 *   label = @Translation("NBU Currency Provider")
 * )
 */
class NbuProvider extends CurrencyProviderBase {
  public function getExchangeRate(string $currencyCode): float {
    return 39.5;
  }
}
