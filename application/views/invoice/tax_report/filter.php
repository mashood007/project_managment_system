
                        <tr>
                            <td><?php echo $sales['total_sales'];?> Invoices</td>
                            <td>Sales Invoices</td>
                            <td>₹<?php echo number_format($sales['total_tax'],2);?></td>
                            <td>CESS: ₹<?php echo number_format($sales['total_cess'],2);?></td>
                            <td>₹<?php echo number_format($sales['total_cess']+$sales['total_tax'],2);?></td>
                        </tr>

                         <tr>
                            <td><?php echo $sales_return['total_sales'];?> Credit Notes</td>
                            <td>Sales Returns/Credit Notes</td>
                            <td>₹<?php echo number_format($sales_return['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($sales_return['total_tax'],2);?></td>
                        </tr>

                        <tr>
                            <td><?php echo $purchase['total_purchase'];?>  Invoices</td>
                            <td>Purchase Invoices</td>
                            <td>₹<?php echo number_format($purchase['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($purchase['total_tax'],2);?></td>
                        </tr>

                        <tr>
                            <td><?php echo $purchase_return['total_purchase'];?>  Debit Notes</td>
                            <td>Purchase Returns/Debit Notes</td>
                            <td>₹<?php echo number_format($purchase_return['total_tax'],2);?></td>
                            <td>-</td>
                            <td>₹<?php echo number_format($purchase_return['total_tax'],2);?> </td>
                        </tr>

                        <tr>
                            <td>15 types</td>
                            <td>Item/Code wise sales report</td>
                            <td>₹0.00 (Net Value)</td>
                            <td>-</td>
                            <td>₹0(Net Value)</td>
                        </tr>