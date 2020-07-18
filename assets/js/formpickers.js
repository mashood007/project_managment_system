(function($) {
  'use strict';
  if ($("#timepicker-example").length) {
    $('#timepicker-example').datetimepicker({
      format: 'LT',
      format:'dd/mm/yy'
    });
  }
  if ($("#timepicker-example1").length) {
    $('#timepicker-example1').datetimepicker({
      format: 'LT',
      format:'dd/mm/yy'
    });
  }
  if ($("#timepicker-example2").length) {
    $('#timepicker-example2').datetimepicker({
      format: 'LT',
      format:'dd/mm/yy'
    });
  }  
  if ($(".color-picker").length) {
    $('.color-picker').asColorPicker();
  }
  if ($("#datepicker-popup").length) {
    $('#datepicker-popup').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yy'
    });
  }
  if ($(".datepicker-popup").length) {
    $('.datepicker-popup').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yy'
    });
  }

  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format:'dd/mm/yy'
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