<?php

namespace Drupal\schedule_entity\Entity;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\EntityRouteProviderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Provides routes for schedule.
 */

class ScheduleRouteProvider implements EntityRouteProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $route_collection = new RouteCollection();
    $route = (new Route('/schedule/{schedule}'))
      ->addDefaults([
        '_entity_view' => 'schedule.full',
        '_title_callback' => '\Drupal\schedule_entity\Controller\ScheduleViewController::title',
      ])
      ->setRequirement('schedule', '\d+')
      ->setRequirement('_entity_access', 'schedule.view');
    $route_collection->add('entity.schedule.canonical', $route);

    $route = (new Route('/schedule/{schedule}/delete'))
      ->addDefaults([
        '_entity_form' => 'schedule.delete',
        '_title' => 'Delete',
      ])
      ->setRequirement('schedule', '\d+')
      ->setRequirement('_entity_access', 'schedule.delete')
      ->setOption('_schedule_operation_route', TRUE);
    $route_collection->add('entity.schedule.delete_form', $route);

    $route = (new Route('/schedule/{schedule}/edit'))
      ->setDefault('_entity_form', 'schedule.edit')
      ->setRequirement('_entity_access', 'schedule.update')
      ->setRequirement('schedule', '\d+')
      ->setOption('_schedule_operation_route', TRUE);
    $route_collection->add('entity.schedule.edit_form', $route);

    return $route_collection;
  }

}
