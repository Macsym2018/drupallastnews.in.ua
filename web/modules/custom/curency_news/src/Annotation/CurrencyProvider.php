<?php

namespace Drupal\curency_news\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * @Annotation
 */
class CurrencyProvider extends Plugin {
  public $id;
  public $label;
}
