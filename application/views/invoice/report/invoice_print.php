<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice: #001</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/print.css');?>">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div><font size="2">Address Line 1</font></div>
        <div><font size="2">Address Line 2</font></div>
        <div><font size="2">Phone Number</font></div>
        <div><font size="2">Phone&nbsp;&nbsp;|&nbsp;&nbsp;Email</font></div>
        <div><font size="2">GSTIN:&nbsp;xxx</font></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $invoice["full_name"];?></h2>
          <div class="address"><font size="2"><?php echo $invoice["designation"];?>,&nbsp;<?php echo $invoice["company"];?></font></div>
          <div class="address"><font size="2"><?php echo $invoice["address1"];?></font></div>
          <div class="email"><font size="2"><?php echo $invoice["mobile1"];?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $invoice["email"];?></font></div>
          <div><font size="2">GSTIN:&nbsp;xxx</font></div>
        </div>
        <div id="invoice">
          <h1>Invoice&nbsp;#<?php echo $id; ?></h1>
          <div class="date"><font size="2">Date of Invoice:&nbsp;<?php echo $invoice["created_at"];?></font></div>
          <div class="date"><font size="2">Due Date:&nbsp;30/06/2014</font></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc"><b>DESCRIPTION</b></th>
            <th class="unit"><b>UNIT PRICE</b></th>
            <th class="qty"><b>QTY</b></th>
            <th class="total"><b>TOTAL</b></th>
          </tr>
        </thead>
        <tbody>

                              <?php
                                if (sizeof($bill) > 0)
                                {
                              $slno = 1;
                              $subtotal = 0.0;
                              $discound = 0.0;
                              $gst = 0.0;
                              foreach($bill as $row)
                               {
                                $subtotal += $row['total']; 
                                $discound += $row['discound'];
                                $gst += $row['gst'];
                               ?>
                                <tr>
                    <td class="no"><?php echo $slno; ?></td>
                    <td class="desc"><?php echo $row['item'];?></font><font size="1"> - <?php echo $row['gst'];?></font></td>
                    <td class="unit"><font size="2">₹<?php echo $row['price'];?></font></td>
                    <td class="qty">
                    <font size="2"><?php echo $row['quantity']." ".$row['unit'];?></font></td>
                                  
                    <td class="total"><font size="2">₹<?php echo $row['price']*$row['quantity'];?></font></td>
                                </tr>
                              <?php
                              $slno = $slno + 1;
                               }
                             }
                             else
                             {
                              echo "<tr></tr>";
                             }
                             
                               ?>  



        </tbody>
        <tfoot>
          
          <tr>
            <td colspan="2"></td>
            <td colspan="2"><font size="2"><b>SUBTOTAL</b></font></td>
            <td><font size="2"><b>₹<?php echo $subtotal + $discound - $gst; ?></b></font></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2" class='td-title'><font size="2">DISCOUNT</font></td>
            <td class='td-title'><font size="2" >-₹<?php echo $discound;?></font></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2" class='td-title'><font size="2"><b>TAXABLE VALUE</b></font></td>
            <td class='td-title'><font size="2"><b>₹<?php echo $subtotal - $gst; ?></b></font></td>
          </tr>
          <?php if ($invoice["sale_type"] == 0){?>
          <tr>
            <td colspan="2"></td>
            <td colspan="2"><font size="2">CGST</font></td>
            <td><font size="2">₹<?php echo $gst/2;?></font></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2"><font size="2">SGST</font></td>
            <td><font size="2">₹<?php echo $gst/2;?></font></td>
          </tr>
          <?php }else{?>
          <tr>
            <td colspan="2"></td>
            <td colspan="2"><font size="2">IGST</font></td>
            <td><font size="2">₹<?php echo $gst;?></font></td>
          </tr>            
          <?php }
            $total_cess = 0;                     
          if (sizeof($cess) > 0)
          {
          foreach($cess as $row)
          { 
            $cess_rate =($subtotal + $discound - $gst)*$row['cess']/100;
            $total_cess += $cess_rate;
            ?>         
          <tr>
            <td colspan="2"></td>
            <td colspan="2"><font size="2"><?php echo $row['cess_name']?></font></td>
            <td><font size="2">₹<?php echo $cess_rate?></font></td>
          </tr>
        <?php 
            }
            }

          ?>
          <tr>
            <td colspan="2" ></td>
            <td colspan="2"><b>GRAND TOTAL</b></td>
            <td><b>₹<?php echo $subtotal + $total_cess;?></b></td>
          </tr>
        </tfoot>
      </table>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1">For&nbsp;Company Name</font><br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<img src="sign.png" alt="Authorized Signature" style="width:100px;height:66.66px;"><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorised Person
      <div id="thanks">Thank you!</div>
     <!-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div> -->
    </main>

    <footer>
      This Invoice was generated with care by <b>The Company Accounts Team</b>
    </footer>
  </body>
</html>
