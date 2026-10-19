<?php

namespace Drupal\schedule_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\schedule_entity\ScheduleInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the Schedule entity.
 *
 * @ContentEntityType(
 *   id = "schedule",
 *   label = @Translation("Schedule"),
 *   label_collection = @Translation("Schedules"),
 *   label_singular = @Translation("schedule"),
 *   label_plural = @Translation("schedules"),
 *   label_count = @PluralTranslation(
 *     singular = "@count schedule",
 *     plural = "@count schedules"
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\schedule_entity\ScheduleListBuilder",
 *     "form" = {
 *       "default" = "Drupal\schedule_entity\Form\ScheduleForm",
 *       "add" = "Drupal\schedule_entity\Form\ScheduleForm",
 *       "edit" = "Drupal\schedule_entity\Form\ScheduleForm",
 *       "delete" = "Drupal\schedule_entity\Form\ScheduleDeleteForm",
 *     },
 *   "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "schedule",
 *   data_table = "node_field_data",
 *   admin_permission = "administer schedule entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid",
 *     "uid" = "uid",
 *     "owner" = "uid",
 *   },
 *
 *   links = {
 *     "canonical" = "/schedule/{schedule}",
 *     "add-form" = "/schedule/add",
 *     "edit-form" = "/schedule/{schedule}/edit",
 *     "delete-form" = "/schedule/{schedule}/delete",
 *     "collection" = "/admin/content/schedule",
 *   }
 *  ),
 */

class Schedule extends ContentEntityBase implements ScheduleInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;
  use EntityOwnerTrait;

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {
    $fields = parent::baseFieldDefinitions($entity_type);
//    $fields += static::ownerBaseFieldDefinitions($entity_type);
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE);

    // Add the changed field definition
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  public function getPreviewMode() {
    return $this->preview_mode;
  }

  public function setPreviewMode($preview_mode) {
    $this->preview_mode = $preview_mode;
  }

}
