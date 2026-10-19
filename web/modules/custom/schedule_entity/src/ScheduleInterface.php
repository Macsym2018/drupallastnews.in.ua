<?php

namespace Drupal\schedule_entity;

use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a schedule entity.
 */
interface ScheduleInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface, EntityPublishedInterface {

//  /**
//   * Denotes that the node is not published.
//   */
//  const NOT_PUBLISHED = 0;
//
//  /**
//   * Denotes that the node is published.
//   */
//  const PUBLISHED = 1;

  /**
   * Gets the node title.
   *
   * @return string|null
   *   Title of the node, or NULL if the node doesn't yet have a title (for
   *   example, if a new node is being previewed).
   */
  public function getTitle();

  /**
   * Sets the node title.
   *
   * @param string $title
   *   The node title.
   *
   * @return $this
   *   The called node entity.
   */
  public function setTitle($title);

  /**
   * Gets the node creation timestamp.
   *
   * @return int
   *   Creation timestamp of the node.
   */
  public function getCreatedTime();

  /**
   * Sets the node creation timestamp.
   *
   * @param int $timestamp
   *   The node creation timestamp.
   *
   * @return $this
   *   The called node entity.
   */
  public function setCreatedTime($timestamp);

}
