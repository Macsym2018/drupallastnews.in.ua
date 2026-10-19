<?php
namespace Drupal\time_slot_picker\Plugin\Field\FieldType;

use Drupal\Core\Field\Attribute\FieldType;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a field type of time_slot_picker.
 */
#[FieldType(
  id: "time_slot_picker",
  label: new TranslatableMarkup("Time Slot Picker field"),
  description: new TranslatableMarkup("Field to store Time slot picker values."),
  default_widget: "time_slot_picker_widget",
  default_formatter: "time_slot_picker_formatter",
)]

class TimeSlotPickerItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'st_time' => [
          'type' => 'int',
          'size' => 'small',
          'unsigned' => TRUE,
          'not null' => FALSE,
        ],
        'end_time' => [
          'type' => 'int',
          'size' => 'small',
          'unsigned' => TRUE,
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = [];

    $properties['st_time'] = DataDefinition::create('integer')
      ->setLabel(t('Start Time (in minutes)'));

    $properties['end_time'] = DataDefinition::create('integer')
      ->setLabel(t('End Time (in minutes)'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $st = $this->get('st_time')->getValue();
    $end = $this->get('end_time')->getValue();
    return $st === NULL || $end === NULL;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
        'slot_step' => 30,
        'day_start' => 480,
        'day_end' => 1200,
      ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];

    // 1. Вибір кроку часового слоту
    $element['slot_step'] = [
      '#type' => 'select',
      '#title' => $this->t('Slot step (minutes)'),
      '#options' => [
        15 => $this->t('15 minutes'),
        30 => $this->t('30 minutes'),
        60 => $this->t('1 hour'),
      ],
      '#default_value' => $this->getSetting('slot_step'),
      '#required' => TRUE,
    ];

    // Функція-хелпер для генерації списку годин (00:00 - 23:00)
    $hours_options = [];
    for ($h = 0; $h < 24; $h++) {
      $minutes = $h * 60;
      $hours_options[$minutes] = sprintf('%02d:00', $h);
    }

    $element['day_start'] = [
      '#type' => 'select',
      '#title' => $this->t('Work day start'),
      '#options' => $hours_options,
      '#default_value' => $this->getSetting('day_start'),
      '#required' => TRUE,
    ];

    $element['day_end'] = [
      '#type' => 'select',
      '#title' => $this->t('Work day end'),
      '#options' => $hours_options,
      '#default_value' => $this->getSetting('day_end'),
      '#required' => TRUE,
    ];

    return $element;
  }

}
