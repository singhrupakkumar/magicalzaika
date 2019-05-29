<link rel="stylesheet" href="//img1a.flixcart.com/www/linchpin/fk-cp-zion/css/bundle.d75c3f.css" />
<style type="text/css">
background-color: #f1f3f6 !important;
</style>
<!-- Breadcrumb Start -->
<div class="bread-crumb">
    <div class="container">
        <div class="matter">
            <h2>Order Details</h2>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="<?php echo $this->request->webroot ; ?>users/myorder">My Order</a></li>
                <li class="list-inline-item"><a href="javascript:void(0)">Order Details</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="login">
    <div class="container">
        <div class="row justify-content-center">
           <?= $this->Flash->render() ?>   

           <div class="col-md-12">  



            <div class="_2kIypH"><div class="_1VV5Cf _1QHAXj"><div class="_1SFos- " style="transform: scaleX(1);"></div></div><div class="_2QEGRr"><div class="_2rhtPx"><span><div class="_1joEet"><div class="_1HEvv0"><a class="_1KHd47" href="<?php echo $this->request->webroot ; ?>">Home</a><svg width="16" height="27" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg" class="_2XP0B_"><path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#fff" class="_24NaUy"></path></svg></div><div class="_1HEvv0"><a class="_1KHd47" href="<?php echo $this->request->webroot ; ?>users/myaccount">My Account</a><svg width="16" height="27" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg" class="_2XP0B_"><path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#fff" class="_24NaUy"></path></svg></div><div class="_1HEvv0"><a class="_1KHd47" href="<?php echo $this->request->webroot ; ?>users/myorder">My Orders</a><svg width="16" height="27" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg" class="_2XP0B_"><path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#fff" class="_24NaUy"></path></svg></div><div class="_1HEvv0"><div class="_3Lv0nZ _1KHd47 Bomkwu _1PKeD1"><div class="_3aS5mM"><p><?php echo $myorder['id'] ; ?></p>
            </div></div><svg width="16" height="27" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg" class="_2XP0B_"><path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#fff" class="_24NaUy"></path></svg></div></div><div class="_1GRhLX _17XScb _3qesVJ row order7
			">




 <div class="col-md-12 _3ncsB7"><div class="_3BVwT"><div class="_1i5nEe" style="width: 33.3333%;"><div class="_17G29n RSqBek" style="transition-delay: 0s;"><span class="_3Qv1YL">Ordered</span></div><div class="_3HKlvX _31uEzM" style="transition-delay: 0s;"></div><div class="_2QynGw"><div class="_1tBjl7" style="transition-delay: 0s; transform: scaleX(1);"></div></div></div><div class="_1i5nEe" style="width: 33.3333%;"><div class="_17G29n RSqBek" style="transition-delay: 1s;"><span class="_3Qv1YL">Packed</span></div><div class="_3HKlvX _31uEzM" style="transition-delay: 1s;"></div><div class="_2QynGw"><div class="_1tBjl7" style="transition-delay: 1s; transform: scaleX(1);"></div></div></div><div class="_1i5nEe" style="width: 33.3333%;"><div class="_17G29n RSqBek" style="transition-delay: 2s;"><span class="_3Qv1YL">Shipped</span></div><div class="_3HKlvX _31uEzM" style="transition-delay: 2s;"></div><div class="_2QynGw"><div class="_1tBjl7" style="transition-delay: 2s; transform: scaleX(1);"></div></div></div><div class="_1i5nEe"><div class="_17G29n RSqBek qnIvIS" style="transition-delay: 3s;"><span class="_3Qv1YL">Delivered</span></div><div class="_3HKlvX _31uEzM" style="transition-delay: 3s;"></div></div><div class="_34rk9f grmEyz" style="left: 0%;"></div><div class="_3MjVpW"><div class="_1ctEzo"><div></div></div></div></div></div>













                <div class="col-8-12 _1MoCT-"><div class="_15sywe"><div class="S19oOu"><span>Delivery Address</span></div><div class="_33IUH-"><div class="_28vuId"><?php echo $myorder['name'] ; ?></div><div class="VEmSfP"><?php echo $myorder['email'] ; ?></div><div class="_1oqxSg"><?php echo $myorder['address'] ; ?></div><div class="_2EfNSn"><span class="_28vuId">Phone</span><span class="_2KwVbu"><?php echo $myorder['phone'] ; ?></span></div></div></div></div></div><div class="_1GRhLX _1YeuTr">


                 <h4>Order Items</h4>       

                 <?php foreach ($myorder['order_items'] as $key => $value): ?>

                    <div class="row x77_9t"><div class="col-3-12 _22pgKz"><div class="row" style="position: relative;"><div class="col-3-12 _2eFO7I"><a href="<?php echo $this->request->webroot ; ?>products/view/<?php echo $value['product']['slug'] ; ?>" target="_blank" rel="noopener noreferrer"><div class="_3BTv9X" style="height: 75px; width: 75px;">
                     

                        <?php if($value['image']){ ?>
                                        <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" class="_1Nyybr  _30XEf0"/>
                                        <?php }else{ ?>
                                         <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="_1Nyybr  _30XEf0"/>
                                        <?php }?>

                    </div></a></div><div class="col-8-12"><a class="_2AkmmA row NPoy5u" href="<?php echo $this->request->webroot ; ?>products/view/<?php echo $value['product']['slug'] ; ?>" target="_blank"><?php echo $value['name'] ; ?></a><div class="row _3Vj7el"></div></div></div></div>


           


            <div class="_2HvExN col-4-12"><div class="f3C4Tt">Rs <?php echo $value['price'] ; ?> * <?php echo $value['quantity'] ; ?><div class="_20yN1P"><span class="question">?</span></div></div><div class="_3JuTif"><a href="<?php echo $this->request->webroot ; ?>products/view/<?php echo $value['product']['slug'] ; ?>" class="_1S3Y5S row"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMTYnIGhlaWdodD0nMTknIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMTggMTgiPgoJPGcgZmlsbD0nbm9uZSc+CgkJPHBvbHlnb24gaWQ9IlNoYXBlIiBmaWxsPSIjMjg3NEYxIiBwb2ludHM9IjkgMTIuMDYyNSAxMy42Mzc1IDE1LjQzNzUgMTEuODYyNSA5Ljk4NzUgMTYuNSA2LjY4NzUgMTAuODEyNSA2LjY4NzUgOSAxLjA2MjUgNy4xODc1IDYuNjg3NSAxLjUgNi42ODc1IDYuMTM3NSA5Ljk4NzUgNC4zNjI1IDE1LjQzNzUiIC8+CgkJPHBvbHlnb24gaWQ9IlNoYXBlIiBwb2ludHM9IjAgMCAxOCAwIDE4IDE4IDAgMTgiIC8+Cgk8L2c+Cjwvc3ZnPg==" class="_3Q4GqT col-1-5"><span class="_3zvrLw col-3-5">Rate &amp; Review Product</span></a></div></div>
        </div>

    <?php endforeach;?>










            




            <div class="row"><span class="col-3-12 _2BU9FV"><img src="data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjMjg3NEYxIiBoZWlnaHQ9IjI0IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHdpZHRoPSIyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0wIDBoMjR2MjRIMHoiIGZpbGw9Im5vbmUiLz4KICAgIDxwYXRoIGQ9Ik0yMCA4aC0zVjRIM2MtMS4xIDAtMiAuOS0yIDJ2MTFoMmMwIDEuNjYgMS4zNCAzIDMgM3MzLTEuMzQgMy0zaDZjMCAxLjY2IDEuMzQgMyAzIDNzMy0xLjM0IDMtM2gydi01bC0zLTR6TTYgMTguNWMtLjgzIDAtMS41LS42Ny0xLjUtMS41cy42Ny0xLjUgMS41LTEuNSAxLjUuNjcgMS41IDEuNS0uNjcgMS41LTEuNSAxLjV6bTEzLjUtOWwxLjk2IDIuNUgxN1Y5LjVoMi41em0tMS41IDljLS44MyAwLTEuNS0uNjctMS41LTEuNXMuNjctMS41IDEuNS0xLjUgMS41LjY3IDEuNSAxLjUtLjY3IDEuNS0xLjUgMS41eiIvPgo8L3N2Zz4=" class="_333iJH"></span><span class="col-9-12 _1XR3uz"><span class=""><?php if(!empty($myorder['delivered_date'])){ echo date('d-M-Y H:i:s', strtotime($myorder['delivered_date'])) ;} ?></span></span></div>

            <div class="_1OJGFU"><div class="_11dQu7"><span class="_27lDDD">Total</span><span class="_1B26g2">Rs <?php echo $myorder['total'] ; ?></span><div class="_20yN1P"><span class="question">?</span></div></div></div></div></span></div></div></div>









        </div> 
    </div>
</div>
</div>
            <!-- Login End -->