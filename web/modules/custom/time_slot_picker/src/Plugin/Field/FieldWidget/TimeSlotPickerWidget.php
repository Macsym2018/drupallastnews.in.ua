<?php

namespace Drupal\time_slot_picker\Plugin\Field\FieldWidget;

use Drupal\Core\Field\Attribute\FieldWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the 'time_slot_picker_widget' field widget.
 */
#[FieldWidget(
  id: "time_slot_picker_widget",
  label: new TranslatableMarkup("Time Slot Picker Grid"),
  field_types: ["time_slot_picker"],
)]
class TimeSlotPickerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    // Отримуємо поточні значення з бази даних (якщо нода редагується)
    $st_time = $items[$delta]->st_time ?? '';
    $end_time = $items[$delta]->end_time ?? '';

    // Отримуємо налаштування поля, які ми створили в минулому кроці
    $field_settings = $this->getFieldSetting('slot_step') ? $this->getFieldSettings() : [
      'slot_step' => 30,
      'day_start' => 480,
      'day_end' => 1200,
    ];

    // Створюємо загальну обгортку (контейнер) для нашого поля
    $element['#type'] = 'fieldset';
    $element['#title'] = $element['#title'] ?? $this->t('Select Time Slot');

    // Створюємо унікальний ID для контейнера, щоб JS знав, куди рендерити сітку
    $wrapper_id = 'time-slot-picker-' . $delta;

    // Додаємо HTML-контейнер для майбутньої JS-сітки слотів
    $element['grid_placeholder'] = [
      '#markup' => '<div id="' . $wrapper_id . '" class="time-slot-picker-grid"></div>',
    ];

    // Поле для Часу Старту
    $element['st_time'] = [
      '#type' => 'hidden', // Було 'number'
      '#default_value' => $st_time,
      '#attributes' => ['class' => ['js-st-time-input']],
    ];

    // Поле для Часу Кінця
    $element['end_time'] = [
      '#type' => 'hidden', // Було 'number'
      '#default_value' => $end_time,
      '#attributes' => ['class' => ['js-end-time-input']],
    ];

    // Передаємо налаштування поля та ID обгортки в JavaScript через drupalSettings
    $element['#attached']['library'][] = 'time_slot_picker/time_slot_picker_widget';
    $element['#attached']['drupalSettings']['timeSlotPicker'][$wrapper_id] = [
      'slotStep' => (int) $field_settings['slot_step'],
      'dayStart' => (int) $field_settings['day_start'],
      'dayEnd' => (int) $field_settings['day_end'],
    ];

    return $element;
  }

}
