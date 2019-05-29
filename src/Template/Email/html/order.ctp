<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet"> 
<meta name="viewport" content="width">
    <title>MagicalZaika</title>
</head>
<body>
<div style="background: grey;margin:0 auto;    padding: 30px 0 60px 20px;">
    <table cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <div style="width:77%;margin:auto;padding:5px 0 10px 0;text-align:center">
                
                </div>
                <div style="background-color: #fff; padding: 40px 0px 120px 17px; border-bottom: 1px solid #ccc;color: #fff; font-size: 13px;border-radius: 10px 10px 0px 0px;">
                   <div style="font-size: 15px;color: #555;font-weight: 700;text-align: justify;margin: 11px 11px 0 0;float: right;padding: 9px 12px; text-align: right;">Invoice #<?php if(isset($order['id'])){ echo $order['id']; } ?> <br> <br><span style="font-size:14px; color: #6c757d; font-weight: normal;"> Due to: <?php if(isset($order['created'])){ date('d M, Y',strtotime($order['created'])); } ?></span></div>
				       <img style="background: #ccc; width: 20%;" src="https://magicalzaika.com/assets/images/logo/logo.png" alt="Perfect Coin" width="30%">
				</div> 
			
			  <div style="background-color: #fff;color: #Fff;font-size: 13px; width: 700px;     padding: 60px 0px 0px 0px;">
                   <div style="font-size: 15px;color: #555;font-weight: 700;text-align: justify;margin: 11px 11px 0 0;float: right;padding: 9px 12px; text-align: right;">Payment Details <br>
				   <?php if(isset($order['transaction_id'])){ ?>
				   <p style="font-size:16px; color:#ccc;   font-weight: normal"> Transaction Id: <span style="color:#6c757d;     font-weight: normal;"> <?php echo $order['transaction_id']; ?></span></p>	
					<?php } ?>
					<?php if(isset($order['payment_method'])){ ?>
				<p style="font-size:16px; color:#ccc;   font-weight: normal">Payment Type: <span style="color: #6c757d;     font-weight: normal;"><?php echo $order['payment_method']; ?></span></p>	  
					<?php } ?>

				   </div>
		  
				      <div style="font-size: 15px;color: #000;font-weight: 700;text-align: justify;width: 30%;padding: 9px 12px;">Client Information <br><br><span style="font-size:15px; color:#6c757d;; font-weight: normal;"><?php if(isset($order['name'])){ echo $order['name']; } ?></span></div>
					   <div style="font-size: 20px;color: #000;font-weight: 600;text-align: justify;width: 30%;padding: 9px 12px;"><span style="font-size:15px; color:#6c757d;; font-weight: normal;"><?php if(isset($order['email'])){ echo $order['email']; } ?></span></div>
					    <div style="font-size: 20px;color: #000;font-weight: 600;text-align: justify;width: 30%;padding: 9px 12px;"><span style="font-size:15px; color:#6c757d;; font-weight: normal;"><?php if(isset($order['address'])){ echo $order['address']; } ?></span></div>
						 
               
			   <table style="width: 100%;    padding: 60px 0 60px 0; color: #000;">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Item</th>
     
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
								
                                <tbody>
								<?php if(!empty($order['order_items'])){
										$k = 1 ;
									   foreach($order['order_items'] as $item) {    
									   ?> 
                                    <tr>
                                        <td style="    text-align: center;"><?php  echo $k; ?></td>
                                        <td style="    text-align: center;"><?php if(isset($item['name'])){ echo $item['name']; } ?></td>
                                      
                                        <td style="    text-align: center;"><?php if(isset($item['quantity'])){ echo $item['quantity']; } ?></td>
                                        <td style="    text-align: center;">Rs <?php if(isset($item['price'])){ echo $item['price']; } ?></td>
                                        <td style="    text-align: center;">Rs <?php if(isset($item['price'])){ echo $item['price']*$item['quantity']; } ?></td>
                                    </tr>
								<?php
								$k++ ;			
								}
									
								} ?> 
                                </tbody>
                            </table>
							<div style="font-size: 15px;color: #ccc;font-weight: 400;text-align: justify;float: right;     margin: 60px -60px 0 0;   padding: 50px 28px 50px 1px; text-align: right; width: 96%;background: #000;">Grand Total <br>
											   <p style="font-size:14px; color:#ccc;"><span style="font-size:32px; color:#ccc;">Rs <?php if(isset($order['total'])){ echo $order['total']; } ?></span></p>	
				</div> 

                </div>
               </td>
        </tr>
        </tbody>
    </table>
</div>
</body></html>
