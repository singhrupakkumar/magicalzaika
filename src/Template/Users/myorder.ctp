<link rel="stylesheet" href="//img1a.flixcart.com/www/linchpin/fk-cp-zion/css/bundle.d75c3f.css" />
<!-- Breadcrumb Start -->
<div class="bread-crumb">
    <div class="container">
        <div class="matter">
            <h2>My Order</h2>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="<?php echo $this->request->webroot ; ?>users/myaccount">My Account</a></li>
                <li class="list-inline-item"><a href="javascript:void(0)">My Order</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="login">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-10 col-md-12">





                 <div class="_1eq_ut">
                   <div class="_1GRhLX _2wHLZw">
                   
                     



                                    <?php if(!empty($myorder)):
                                    foreach ($myorder as $key => $value) :
                                    ?>

                                      <div class="row _3l2sfs" style="    border: 1px solid #2874f0;"> 
                                        <div class="F4CVC3">
                                            <div class="row _1LTGeE"><div class="col-8-12">
                                        <div class="_1-SHG3"><a rel="noopener noreferrer" href="<?php echo $this->request->webroot ; ?>users/orderdetails/<?php echo $value->id; ?>"><div class="DgI5Zd"><?php echo $value->id; ?></div>
                                        </a>
                                        </div>
                                    </div>
                                        <div class="col-4-12 _1CwnjI">
                                            <div class="JfvmoN">
                                                <a rel="noopener noreferrer" href="<?php echo $this->request->webroot ; ?>users/orderdetails/<?php echo $value->id; ?>">
                                                <div class="_3svin8">
                                                    <span>Track</span> 
                                                </div>
                                               </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row haP8Uf"><div class="_3xiuDJ"><div class="row _23QCqI"><div class="col-6-12 _22pgKz"><div class="row" style="position: relative;"><div class="col-3-12 _2eFO7I">
                                        <div class="_3BTv9X" style="height: 75px; width: 75px;">


                                    <?php if($value['order_items'][0]['image']){ ?>
                                        <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['order_items'][0]['image']; ?>" alt="image" title="image" class="_1Nyybr  _30XEf0"/>
                                        <?php }else{ ?>
                                         <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="_1Nyybr  _30XEf0"/>
                                        <?php }?>

                                        </div>
                                    </div>
                                    <div class="col-8-12">
                                        <?php echo $value['order_items'][0]['name']; ?>
                                    </div>
                                </div></div><div class="col-1-12 _52MoHd">Rs<?php echo $value['order_items'][0]['price']; ?></div>
                                <?php if($value['order_status'] ==3){
                                 ?>
                                <div class="col-3-12 _3fG4KG">
                                    Delivered on <?php echo date('d-M-Y H:i:s', strtotime($value['delivered_date'])); ?>
                                    <div class="_3HDMnP">
                                    Your item has been delivered
                                    </div>
                               </div>
                               <?php } ?>
                               <div class="col-2-12 _3SALIb"><div class="_3jWsOG"></div></div></div></div><div class="row cVUw-4"><div class="col-6-12 _1S28mS"><span class="_38bdEf">Ordered On </span><?php echo date('d-M-Y H:i:s', strtotime($value['created'])); ?></div><div class="col-6-12 Gp5Tnb"><span class="_38bdEf">Order Total </span><span style="font-weight: 500;">Rs <?php echo $value['total']; ?></span></div></div>
                                </div>
                                </div>

                                </div>
                                <br/>

                            <?php 
                            endforeach;
                             endif;
                            
                             ?>







                               
                        <div>
                           
                        </div>
                        </div>
                    </div>















             



                </div>
            </div>
        </div>
    </div>
            <!-- Login End -->