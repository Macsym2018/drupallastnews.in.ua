<?php

namespace Drupal\services_test\Render;

use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Render\RenderContext;

final class RendererDecorator implements RendererInterface {

  public function __construct(private readonly RendererInterface $inner) {}

  public function renderRoot(&$elements) {
    \Drupal::logger('services_test')->notice('Custom renderRoot called (decorator).');
    return $this->inner->renderRoot($elements);
  }

  public function render(&$elements, $is_root_call = false) {
    return $this->inner->render($elements, $is_root_call);
  }

  public function renderPlain(&$elements) {
    return $this->inner->renderPlain($elements);
  }

  public function executeInRenderContext(RenderContext $context, callable $callable) {
    return $this->inner->executeInRenderContext($context, $callable);
  }

  public function setRenderContext(RenderContext $context) {
    $this->inner->setRenderContext($context);
  }

  public function hasRenderContext() {
    return $this->inner->hasRenderContext();
  }

  public function addCacheableDependency(array &$elements, $dependency) {
    $this->inner->addCacheableDependency($elements, $dependency);
  }

  public function mergeBubbleableMetadata(array $a, array $b) {
    return $this->inner->mergeBubbleableMetadata($a, $b);
  }

  public function renderPlaceholder($placeholder, array $elements) {
    return $this->inner->renderPlaceholder($placeholder, $elements);
  }
}
