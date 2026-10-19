<?php

namespace Drupal\time_slot_picker\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Attribute\FieldFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the 'time_slot_picker_formatter' field formatter.
 */
#[FieldFormatter(
  id: "time_slot_picker_formatter",
  label: new TranslatableMarkup("Time Slot Formatter"),
  field_types: ["time_slot_picker"]
)]
class TimeSlotPickerFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    foreach ($items as $delta => $item) {
      if ($item->st_time !== NULL && $item->end_time !== NULL) {

        $start_formatted = sprintf('%02d:%02d', floor($item->st_time / 60), $item->st_time % 60);
        $end_formatted = sprintf('%02d:%02d', floor($item->end_time / 60), $item->end_time % 60);

        $elements[$delta] = [
          '#markup' => '<div class="time-slot-display">' . $start_formatted . ' - ' . $end_formatted . '</div>',
        ];
      }
    }

    return $elements;
  }
}
