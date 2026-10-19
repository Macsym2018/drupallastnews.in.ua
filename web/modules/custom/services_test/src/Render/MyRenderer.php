<?php

namespace Drupal\services_test\Render;

use Drupal\Core\Render\Renderer;

final class MyRenderer extends Renderer {
  public function renderRoot(&$elements) {
    \Drupal::logger('services_test')->notice('Custom renderRoot called.');
    return parent::renderRoot($elements);
  }
}
