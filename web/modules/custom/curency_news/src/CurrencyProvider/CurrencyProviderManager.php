<?php

namespace Drupal\curency_news\CurrencyProvider;

use Drupal\Core\Plugin\DefaultPluginManager;

class CurrencyProviderManager extends DefaultPluginManager {
  public function __construct(\Traversable $namespaces, \Drupal\Core\Cache\CacheBackendInterface $cache_backend, \Drupal\Core\Extension\ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/CurrencyProvider',
      $namespaces,
      $module_handler,
      'Drupal\curency_news\Plugin\CurrencyProvider\CurrencyProviderInterface',
      'Drupal\curency_news\Annotation\CurrencyProvider'
    );

    $this->alterInfo('curency_provider_info');
    $this->setCacheBackend($cache_backend, 'curency_provider_plugins');
  }
}
