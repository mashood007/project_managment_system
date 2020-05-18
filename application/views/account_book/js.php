<script>

$(document).ready(function(){
  $("#customers_ddlb").change(function(){
    var url = "<?php echo base_url("account_book/customer_balance/");?>"
    $('#type').val($("#customers_ddlb option:selected").data('type'))
    balance($(this).val(),url, $("#customers_ddlb option:selected").data('type'))
  });

  $("#user_ddlb").change(function(){
    var url = "<?php echo base_url("account_book/employee_balance/");?>"
    balance($(this).val(),url)
  });
  $("#from_date, #to_date , #trans_type, #account_type").change(function(){
  	var url = "<?php echo base_url("account_book/filter_cash_flow/");?>"
  	var from_date = $("#from_date").val()
  	var to_date = $("#to_date").val()
  	var trans_type = $("#trans_type").val()
  	var account_type  = $("#account_type").val()
  	//alert(from_date+to_date+trans_type+account_type)
  	filter_cash_flow(from_date, to_date, trans_type, account_type, url)
  });  
  
});

</script>