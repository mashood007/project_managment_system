function balance(customer_id, url, type)
{
        $.ajax({
           url: url,
           type: 'POST',
           data: {customer_id: customer_id, type: type},

           error: function(data) {

              alert('Something is wrong');
              console.log(data)

           },

           success: function(data) {
           		if (data < 0)
           		{   data = data*-1        			
 					$('#account_balance').html("Account Balance: <font color='red' size='5' class='display-4'> ₹"+data+"</font> <font color='grey' size='1'>is pending</font>");
           		}
           		else if(data == 0)
           		{
 					$('#account_balance').html("Account Balance: <font color='green' size='5' class='display-4'> ₹"+data);
           		}	
           		else
           		{
 					$('#account_balance').html("Account Balance: <font color='green' size='5' class='display-4'> ₹"+data+"</font> <font color='grey' size='1'>is advanced</font>");
            	}
           }


        });
}

function filter_cash_flow(from_date, to_date, trans_type, account_type, url)
{

        $.ajax({
           url: url,
           type: 'POST',
           data: {from_date: from_date, to_date: to_date, trans_type: trans_type, account_type: account_type},

           error: function(data) {

           	$('#cash_flow_statement').html("Something is wrong!! Try again")

           },

           success: function(data) {
           	$('#cash_flow_statement').html(data)
           	
           }


        });

}