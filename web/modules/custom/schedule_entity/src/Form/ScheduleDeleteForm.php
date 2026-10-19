<?php

namespace Drupal\schedule_entity\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;

/**
 * Provides a form for deleting a node.
 *
 * @internal
 */
class ScheduleDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  protected function getDeletionMessage() {
    /** @var \Drupal\node\NodeInterface $entity */

    return $this->t('The %title has been deleted.', [
      '%title' => $this->getEntity()->label(),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  protected function logDeletionMessage() {
    /** @var \Drupal\node\NodeInterface $entity */
    $entity = $this->getEntity();
    $this->logger('content')->info('Deleted %title.', ['%title' => $entity->label()]);
  }

}
