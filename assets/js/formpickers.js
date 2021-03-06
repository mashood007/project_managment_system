(function($) {
  'use strict';
  if ($("#timepicker-example").length) {
    $('#timepicker-example').datetimepicker({
      format: 'LT'
    });
  }
  if ($("#timepicker-example1").length) {
    $('#timepicker-example1').datetimepicker({
      format: 'LT'
    });
  }
  if ($("#timepicker-example2").length) {
    $('#timepicker-example2').datetimepicker({
      format: 'LT'
    });
  }  
  if ($(".color-picker").length) {
    $('.color-picker').asColorPicker();
  }
  if ($("#datepicker-popup").length) {
    $('#datepicker-popup').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yyyy'
    });
  }
  if ($(".datepicker-popup").length) {
    $('.datepicker-popup').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yyyy'
    });
  }

  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yyyy'
    });
  }
  if ($(".datepicker-autoclose").length) {
    $('.datepicker-autoclose').datepicker({
      autoclose: true
    });
  }
  if ($('input[name="date-range"]').length) {
    $('input[name="date-range"]').daterangepicker();
  }
  if($('.input-daterange').length) {
    $('.input-daterange input').each(function() {
      $(this).datepicker('clearDates');
    });
    $('.input-daterange').datepicker({});
  }
})(jQuery);