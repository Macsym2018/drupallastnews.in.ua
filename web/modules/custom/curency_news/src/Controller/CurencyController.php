<?php
namespace Drupal\curency_news\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class CurencyController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function displayCurency() {

    $plugin_manager = \Drupal::service('plugin.manager.curency_provider');
    $plugin = $plugin_manager->createInstance('nbu');
    $rate = $plugin->getExchangeRate('USD');
    $build = ['#markup' => '<h1>Test</h1>'];
    //$build = '<h1>Test</h1>';
    \Drupal::logger('services_test')->notice('Controller hit');
//    $html = \Drupal::service('services_test.renderer')->renderRoot($build);

    return $build;
  }

}
