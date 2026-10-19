(function ($, Drupal, drupalSettings, once) {
  'use strict';

  Drupal.behaviors.timeSlotPicker = {
    attach: function (context, settings) {
      // Перевіряємо, чи є на сторінці наші налаштування
      if (typeof settings.timeSlotPicker === 'undefined') {
        return;
      }

      // Проходимося по кожному віджету на сторінці
      $.each(settings.timeSlotPicker, function (wrapperId, config) {

        // Використовуємо сучасний once() для Drupal 10+
        var elements = once('timeSlotPickerInit', '#' + wrapperId, context);

        $(elements).each(function () {
          var $wrapper = $(this);

          // Знаходимо наші інпути поруч із сіткою
          var $fieldset = $wrapper.closest('fieldset');
          var $stInput = $fieldset.find('.js-st-time-input');
          var $endInput = $fieldset.find('.js-end-time-input');

          // Генеруємо HTML для кнопок
          var html = '<div class="time-slots-container">';

          for (var time = config.dayStart; time < config.dayEnd; time += config.slotStep) {
            var startHours = Math.floor(time / 60).toString().padStart(2, '0');
            var startMins = (time % 60).toString().padStart(2, '0');

            var endTime = time + config.slotStep;
            var endHours = Math.floor(endTime / 60).toString().padStart(2, '0');
            var endMins = (endTime % 60).toString().padStart(2, '0');

            var label = startHours + ':' + startMins + ' - ' + endHours + ':' + endMins;

            var isActive = ($stInput.val() == time && $endInput.val() == endTime) ? ' active' : '';

            html += '<button type="button" class="time-slot-btn' + isActive + '" data-start="' + time + '" data-end="' + endTime + '">' + label + '</button>';
          }
          html += '</div>';

          // Вставляємо згенеровані кнопки у DOM
          $wrapper.html(html);

          // Обробляємо кліки по кнопках
          $wrapper.find('.time-slot-btn').on('click', function(e) {
            e.preventDefault();

            $wrapper.find('.time-slot-btn').removeClass('active');
            $(this).addClass('active');

            // Записуємо значення у приховані інпути
            $stInput.val($(this).data('start'));
            $endInput.val($(this).data('end'));
          });
        });
      });
    }
  };
})(jQuery, Drupal, drupalSettings, once);
