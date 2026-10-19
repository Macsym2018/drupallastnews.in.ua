<?php

namespace Drupal\schedule_entity\Controller;

use Drupal\Core\Controller\ControllerBase;

class ScheduleController extends ControllerBase {
  /**
   * The _title_callback for the schedule.add route.
   *
   * @return string
   *   The page title.
   */
  public function addPageTitle() {
    return $this->t('Create a schedule');
  }
}
