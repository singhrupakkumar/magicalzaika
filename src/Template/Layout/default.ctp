<?php
$cakeDescription = 'Welcome To Magical Zaika';      
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?=  $this->Html->charset() ?>     
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#e54c2a">
<title><?= $cakeDescription ?></title>

<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->request->webroot; ?>images/favicon-16x16.png">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 <!-- Bootstrap stylesheet -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet" type="text/css">
        <link href="<?php echo $this->request->webroot; ?>assets/libs/bootstrap-4.0.0-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- icofont -->
        <link href="<?php echo $this->request->webroot ; ?>assets/libs/icofont/css/icofont.css" rel="stylesheet" type="text/css" />
        <!-- crousel css -->
        <link href="<?php echo $this->request->webroot ; ?>assets/libs/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <!-- mb.YTPlayer css -->
        <link href="<?php echo $this->request->webroot ; ?>assets/libs/mb.YTPlayer/css/jquery.mb.YTPlayer.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Select css -->
        <link href="<?php echo $this->request->webroot ; ?>assets/libs/bootstrap-select/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <!-- Switch Style css -->
        <link href="<?php echo $this->request->webroot ; ?>assets/switch-style/switch-style.css" rel="stylesheet" type="text/css"/>
        <!-- Theme Stylesheet -->
        <link href="<?php echo $this->request->webroot ; ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Switch Color Style css -->
        <link href="#" data-style="styles" rel="stylesheet">
		
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128186242-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-128186242-1');
</script>
		
		
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/assets/html5shiv.min.js"></script>
<script type="text/javascript" src="js/assets/respond.min.js"></script>
<![endif]-->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->

 
   <?php // echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>  
 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <style>

    </style>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" type="text/javascript"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 
    <?php echo $this->Html->script(array('addtocart.js'), array('inline' => false)); ?>
    </head>
    <body class="">
        <div class="wrapper">
           

            <!-- Loader Start -->
           <?php  if($this->request->params['action'] == 'index' ) { ?> 
           <!-- <div class="loader">  
                <div class="loader-inner"> 
                    <h4>Cooking in progress..</h4>
                    <div id="cooking">
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div id="area">
                            <div id="sides">
                                <div id="pan"></div>
                                <div id="handle"></div>
                            </div>
                            <div id="pancake">
                                <div id="pastry"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
           <?php } ?> 
            <!-- Loader End -->

            <!--  Header Start  -->
            <header>
                <!--Top Header Start -->
                <div class="top">
                    <div class="container">
                        <div class="row">
						  <div class="col-md-4">
						 <ul class="list-inline float-left icon">
                                    <li class="list-inline-item"><a href="#"><i class="icofont icofont-phone"></i> Call Now : <?php if(isset($globalsettings[0]['value'])){ echo $globalsettings[0]['value']; } ?></a></li>
                                </ul>
								</div>
								
							<div class="col-sm- col-xs-3 col-md-4 srch">
								<div class="search">
                                    <!-- Search Filter Start -->
                                    <form class="form-horizontal" action="<?php echo $this->request->webroot; ?>products/search" method="get">
                                            <div class="form-group"> 
                                                <input name="search" id="foodsearch" class="form-control input-sm s" autocomplete="off" placeholder="Search Food" type="text">
                                          
                                            </div> 
									 <button type="submit" value="submit" class="btn7"><i class="icofont icofont-search"></i></button>
                                   </form>
								</div>
								 
						</div>
								
                            <div class="col-sm-9 col-xs-9 col-md-4">
                                <!-- Header Social Start -->
                                <ul class="list-inline float-right icon">
                                    <li class="list-inline-item">
                                           <div class="cart-icn">
                                            <img src="<?php echo $this->request->webroot; ?>images/website/cart-icon.png" alt="" >  
                                            <div class="cart-no" id="cartcount"><?php $shop = $this->request->session()->read('cart_count'); if(!empty($shop)){  echo count($shop);}else{ echo 0; } ?></div>   
                                        </div>
                                        <a href="<?php echo $this->request->webroot ?>restaurants/cart"><i class="icofont icofont-cart-alt"></i> Cart</a>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-ui-user"></i> My Account</a>
                                        <ul class="dropdown-menu dropdown-menu-right drophover" aria-labelledby="dropdownMenuLink">
                                         <?php if(!$loggeduser){ ?>    
                                            <li class="dropdown-item"><a href="<?php echo $this->request->webroot ?>users/login">Login</a></li>
                                            <li class="dropdown-item"><a href="<?php echo $this->request->webroot ?>users/add">Register</a></li>
                                          <?php }else{ ?>   
                                          <li class="dropdown-item"><a href="<?php echo $this->request->webroot ?>users/myaccount">Profile</a>
                                           </li>
                                        <li class="dropdown-item"><a href="<?php echo $this->request->webroot; ?>users/edit">Edit Profile</a>
                                           </li>
                                             <li class="dropdown-item"><a href="<?php echo $this->request->webroot; ?>users/changepassword">Change Password</a>
                                           </li>
                                             <li class="dropdown-item"><a href="<?php echo $this->request->webroot ?>users/myorder">My Order</a>
                                           </li>
                                           <li class="dropdown-item"><a href="<?php echo $this->request->webroot ?>users/logout">Logout</a>
                                           </li>

                                           <?php } ?>
                                            
                                        </ul>
                                    </li>
                                   
                                </ul>
                                <!-- Header Social End -->
                            </div>
							
                        </div>
                    </div>
                </div>
                <!--Top Header End -->
<div class="menu77">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <!-- Logo Start  -->
                            <div id="logo">
                                <a href="<?php echo $this->request->webroot; ?>"><img class="img-fluid" src="<?php echo $this->request->webroot; ?>assets/images/logo/logo.png" alt="logo" title="logo" />
                                </a> 
                            </div>
                            <!-- Logo End  -->
                        </div>

                        <div class="col-md-9 col-sm-6 col-xs-12 paddleft">
                            <!-- Main Menu Start  -->
                            <div id="menu">	
                                <nav class="navbar navbar-expand-md">
                                    <div class="navbar-header">
                                        <span class="menutext d-block d-md-none">Menu</span>
                                        <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="btn btn-navbar navbar-toggler" type="button"><i class="icofont icofont-navigation-menu"></i></button>
                                    </div>
                                    <div class="collapse navbar-collapse navbar-ex1-collapse padd0">
                                        <ul class="nav navbar-nav">
                                            <li class="nav-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a>
                                            </li>
                                            <li class="nav-item"><a href="<?php echo $this->request->webroot; ?>staticpages/aboutus">about us</a></li>
<div id="nav">
<ul>
        <li class="prduct"><a class="nav-item" href="#">product</a>
            <ul>
			<?php if(!empty($categories)):
				
				foreach($categories as $k => $val):
				
			  ?>
                <li class="veg"><a href="<?php echo $this->request->webroot; ?>categories/view/<?php echo $val['slug']; ?>"><?php echo $val['name']; ?></a>
                    <ul class="veg">
					<?php if(!empty($val['subcategories'])):
	
						foreach($val['subcategories'] as $k => $valn):
						
					  ?>
                        <li><a href="<?php echo $this->request->webroot; ?>categories/subcatview/<?php echo $valn['slug']; ?>"><?php echo $valn['name']; ?></a></li>
					<?php
					endforeach;
					endif; 
					?> 
                     
                    </ul>
                </li>
             
			<?php 
		 endforeach; 
		 endif; 
		 ?>		
            </ul>
        </li>

</ul>
</div>
                                    
                                            <li class="nav-item"><a href="<?php echo $this->request->webroot; ?>staticpages/term">Terms & Conditions</a>
                                            </li>
											
				

                                             <li class="nav-item"><a href="<?php echo $this->request->webroot; ?>staticpages/privacy">Privacy & Policy</a>
                                            </li>
                                          
                                          
                                             <li class="nav-item"><a href="<?php echo $this->request->webroot; ?>staticpages/contact">Contact Us</a>
                                            
                                            </li>
                                        </ul>

                                    </div>
                                </nav>
                            </div>
                            <!-- Main Menu End -->
                        </div>
                   
                    </div>
                </div>
				</div>
            </header>
            <!-- Header End   -->
 	<?= $this->fetch('content') ?>   

            <!-- Newsletter Start -->
            <div id="newsletter">
                <div class="container">
                    <div id="subscribe">
                        <!-- Subscribe Form -->
                        <form class="form-horizontal" name="subscribe">
                            <div class="row">
                                <div class="col-sm-6 col-md-7"> 
                                    <div class="input-group">
                                        <span class="news">newsletter</span>
                                        <p>Receive FREE updates on the latest announcements & franchise opportunities! .</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-5 form-group">
                                    <div class="input-group">
                                     <form  method="post" id="subscribe">
                                        <input   type="email" name="email"" id="email" placeholder="Your email address" type="text">
                                        <button class="btn btn-news" type="button" id="nwsltr" name="nwsltr">send</button>
                                    </form>
                                     <div class="message fotermessg" ></div>     
                                    </div>
                                </div>
                            </div> 
                        </form>
                        <!-- Subscribe Form -->
                    </div>
                </div>
            </div>
            <!-- Newsletter End -->

            <!-- Footer Start -->
            <footer>
                <div class="container">
                    <div class="row inner">
					 <div class="col-sm-6 col-md-6 col-lg-3">
                            <!-- Footer Widget Start --> 
                            <h5>About Us</h5>
                       <p style="text-align: justify;">Food is linked to everything in life, health, well being and happiness, we provide you food of the best quality, cooked by traditional authentic and unique recipes followed through many generations, with secret ingredients, like a mother, your satisfaction is our only motto. 
</p>
                            <!-- Footer Widget End --> 
                        </div>
					
					
                        
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <!-- Footer Widget Start --> 
                            <h5>Information</h5>
                            <ul class="list-unstyled">
                                <li><a href="<?php echo $this->request->webroot; ?>staticpages/aboutus">About us</a>
                                <li><a href="<?php echo $this->request->webroot; ?>staticpages/contact">Contact us</a></li>
                                <li><a href="<?php echo $this->request->webroot; ?>staticpages/term">Terms & Conditions</a></li>

                                 <li><a href="<?php echo $this->request->webroot; ?>staticpages/privacy">Privacy & policy</a></li>

                                <li><a href="<?php echo $this->request->webroot; ?>staticpages/faq">FAQ</a></li>
                                
                            </ul>
                            <!-- Footer Widget End --> 
                        </div>
                        <div class="w-100 d-none d-xs-block"></div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <!-- Footer Widget Start --> 
                            <h5>Open Hours</h5>
                            <ul class="list-unstyled">
                                <li>Monday - Friday : 9 am to 12 am.</li>
                                <li>Saturday - Sunday : 9 am to 12 am.</li>
                                <li>Breakfast : 7 am to 12 pm</li>
                                <li>Lunch : 12 pm to 6 pm</li>
                                <li>Dinner : 6 pm to 12 am</li>
                            </ul>
                            <!-- Footer Widget End --> 
                        </div>
                      <div class="col-sm-6 col-md-6 col-lg-3">
                            <!-- Footer Widget Start --> 
                            <h5>Contact Us</h5>
                            <ul class="list-unstyled contact">
                                <li><i class="icofont icofont-social-google-map"></i><?php if(isset($globalsettings[2]['value'])){ echo $globalsettings[2]['value']; } ?></li>
                                <li><i class="icofont icofont-phone"></i> <?php if(isset($globalsettings[0]['value'])){ echo $globalsettings[0]['value']; } ?></li>
                                <li><a href="#"><i class="icofont icofont-ui-message"></i><?php if(isset($globalsettings[1]['value'])){ echo $globalsettings[1]['value']; } ?></a></li>
                            </ul>
                            <!-- Footer Widget End --> 
                        </div>
                    </div>

                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row powered">
                            <!--  Copyright Start -->
							
							 
							
                            <div class="col-md-3 col-sm-6 order-md-1">
                                <a href="<?php echo $this->request->webroot; ?>"><img src="<?php echo $this->request->webroot ?>assets/images/logo/logo-white.png" class="img-fluid" title="logo" alt="logo"></a>
                            </div>
                            <div class="col-md-3 col-sm-6 text-right order-md-3">
                                <!--  Footer Social Start -->
                                <ul class="list-inline social">
                                    <li class="list-inline-item"><a href="https://www.facebook.com/Magical-Zaika-1200672826748228/?modal=admin_todo_tour" target="_blank"><i class="icofont icofont-social-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="https://twitter.com/magicalzaika" target="_blank"><i class="icofont icofont-social-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="https://plus.google.com/u/0/112377196992132325977" target="_blank"><i class="icofont icofont-social-google-plus"></i></a></li>
                                    <li class="list-inline-item"><a href="https://in.pinterest.com/magicalzaika878/" target="_blank"><i class="icofont icofont-social-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="https://www.instagram.com/magicalzaika/" target="_blank"><i class="icofont icofont-social-instagram"></i></a></li>
                                    
                                </ul>
                                <!--  Footer Social End -->
                            </div>
                            <div class="col-md-6 col-sm-12 text-center order-md-2">
                                <p>Copyright © <span>Magical Zaika</span> 2018. All Rights Reserved.</p>
                            </div>
                            <!--  Copyright End -->
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer End  -->

           

        </div>

 <!-- jquery -->
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<!-- jquery Validate -->
        <script src="<?php echo $this->request->webroot ?>assets/libs/jquery-validation/jquery.validate.min.js"></script>
        <!-- popper js -->
        <script src="<?php echo $this->request->webroot ?>assets/libs/popper/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="<?php echo $this->request->webroot ?>assets/libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
        <!-- owlcarousel js -->
        <script src="<?php echo $this->request->webroot ?>assets/libs/owlcarousel2/owl.carousel.min.js"></script>
        <!--inview js code-->
        <script src="<?php echo $this->request->webroot ?>assets/libs/jquery.inview/jquery.inview.min.js"></script>
        <!--CountTo js code-->
        <script src="<?php echo $this->request->webroot ?>assets/libs/jquery.countTo/jquery.countTo.js"></script>
        <!-- mb.YTPlayer js code-->
        <script src="<?php echo $this->request->webroot ?>assets/libs/mb.YTPlayer/jquery.mb.YTPlayer.min.js"></script>
        <!-- Bootstrap Select js -->
        <script src="<?php echo $this->request->webroot ?>assets/libs/bootstrap-select/bootstrap-select.js"></script>
        <!-- Switch Style js -->
        <script src="<?php echo $this->request->webroot ?>assets/switch-style/switch-style.js"></script> 
        <!--internal js-->
        <script src="<?php echo $this->request->webroot ?>assets/js/internal.js"></script> 
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>   
  <script type="text/javascript">

        function valid_email_address(email)
        {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            return pattern.test(email);
        }

        jQuery('#nwsltr').on("click", function ($) {     
            if (!valid_email_address(jQuery("#email").val()))
            {
                jQuery(".message").html('<span style="color:black;">Please make sure you enter a valid email address.</span>');
            }
            else
            {

                jQuery(".message").html("<span style='color:green;'>Almost done, please check your email address to confirmation.</span>");
                jQuery.ajax({
                    url: '<?php echo $this->request->webroot ;?>users/newsletter', 
                    data: {'email':jQuery("#email").val()},
                    type: 'POST',
                    success: function (msg) {  
                        if (msg == "success")
                        {
                            jQuery("#subscribe_email").val("");
                            jQuery(".message").html('<span style="color:green;">You have successfully subscribed to our mailing list.</span>');

                        }
                        else
                        {
                            jQuery(".message").html('<span style="color:green;">Please make sure you enter a valid email address.</span>');
                        }
                    }
                });
            }
            return false;
        });
        
        $(document).ready(function(){ 
                $('.flash-msg').delay(5000).fadeOut('slow');
        });
        
    </script> 
	
   <script type="text/javascript">
       $('.alert ').click(function() {
           $(this).hide();
        })
		
		
	$(function() {
	
	   jQuery("#foodsearch").autocomplete({
		minLength: 2,
		select: function(event, ui) {
			jQuery("#foodsearch").val(ui.item.label);
			jQuery("#searchform").submit();
		},
		source: function (request, response) {
			jQuery.ajax({
				url: '<?php echo $this->request->webroot ;?>products/searchjson',
				data: {
					term: request.term
				},
				dataType: "json",
				success: function(data) {
					response(jQuery.map(data, function(el, index) {
						return {
							value: el.name,
							name: el.name,
							image: el.image
						};
					}));
				}
			});
		}
	}).data("ui-autocomplete")._renderItem = function (ul, item) {
		return jQuery("<li></li>")
			.data("item.autocomplete", item) 
			.append("<a><img width='40' src='<?php echo $this->request->webroot ;?>images/products/" + item.image + "' /> " + item.name + "</a>")
			.appendTo(ul)
	};
	
	});	
   </script>

    </body>
</html>
