<style type="text/css">span.fa.fa-star-o.checked {
    color: #e54c2a;
}</style>
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Product Details</h2>

  </div>
</div>
</div>
<!-- Breadcrumb End -->



<!-- Shop Start -->
<div class="shop">
    <div class="container">

        <div class="row">

            <div class="col-md-12">
              <?= $this->Flash->render() ?> 
              <div class="row shopdetail">
                <div class="col-sm-5 col-xs-12">
                    <div class="image">
                      <?php if($product['image']){ ?>
                      <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" title="image" class="img-fluid"/>
                      <?php }else{ ?>
                      <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="<?php echo $product['name']; ?>" title="image" class="img-fluid"  />
                      <?php }?>
                  </div>
              </div>
              <div class="col-sm-7 col-xs-12">
                <h2><?php echo $product['name']; ?></h2>
                <div class="rating">
                   <?php
                   $i= round($product['avg_rating']);

                   for($j=0;$j<$i;$j++){
                    ?>
                    <i class="fa fa-star" aria-hidden="true"></i>


                    <?php } for($h=0;$h<5-$i;$h++){?>  
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <?php 

                }   
                ?> 

            </div>
            <div class="price">Rs <?php echo $product['price']; ?></div>
            <p class="des"><?php echo $product['category']['name']; ?></p>
            <p class="shortdes"><?php echo substr($product['description'],25); ?></p>

            <div class="common">
                <?php echo $this->Form->create(NULL, array('url' => array('controller'=>'restaurants','action' => 'addtocart'))); ?> 
                <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $product['id'])); ?>
                <p class="qtypara float-left">
                   
                    <input type="number" min="1" max="<?php echo $product['quantity']; ?>" name="quantity" value="1" size="2" id="input-quantity1" class="form-control qty">
                   

                </p>
                <div class="buttons">
                    <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme-alt btn-md','id' => $product['id']));?>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>

        <div class="col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#tab-description" data-toggle="tab">description</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab-review" data-toggle="tab">Reviews (<?php if(!empty($product['reviews'])) { echo count($product['reviews']); }else{ echo "0"; }  ?>)</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab-add" data-toggle="tab">add Review</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-description">
                    <?php echo $product['description']; ?>
                </div>
                <div class="tab-pane" id="tab-review">

                     <?php 
                        if(!empty($product['reviews'])){   
                            $reviewcount = count($product['reviews']); foreach($product['reviews'] as $rt){  
                    ?> 
                    <div class="box">
                         <?php if(isset($rt['user']['image'])){  ?>    
                                    <img src="<?php echo $this->request->webroot."images/users/".$rt['user']['image']; ?>" class="img-fluid">
                                    <?php }else{  ?>
                                    <img src="<?php echo $this->request->webroot."images/users/noimage.png"?>" class="img-fluid" width="100" height="100">
                                    <?php } ?>
                       
                        <div class="detail">
                            <h2><?php if(isset($rt['user']['name'])){ echo $rt['user']['name']; } ?></h2>
                          
                            <div class="rating">
                                    <?php
                                       $i= round($rt['rating']);

                                       for($j=0;$j<$i;$j++){
                                        ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>


                                        <?php } for($h=0;$h<5-$i;$h++){?>  
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <?php 

                                    }    
                                    ?> 
                            </div>
                            <p><?php if(isset($rt['text'])){ echo $rt['text']; } ?></p>
                        </div>
                    </div>
                    <?php } } ?> 
                    
                </div>
                <div class="tab-pane" id="tab-add">
                    <form action="<?php echo $this->request->webroot;?>products/savereview" method="post" id="form-review" class="form-horizontal"> 
                    
                        
                        <div class="form-group row required">
                            <div class="col-sm-12">
                                <textarea name="text" rows="5" id="input-review" placeholder="Your Reviews*" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                        <div class="stars rating" id="rating">
                         <p>Your Rating*</p> 
                          <span class="fa fa-star-o"></span> 
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>
                          <span class="fa fa-star-o"></span>        
                          <input type="hidden" name="avg_rating" value="<?php echo $product['avg_rating']; ?>">  
                          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">  
                          <input type="hidden" name="server" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                          <input type="hidden" name="punctuality" id="ratings1" value="" required>  
                       </div> 
                                
                            </div>
                        </div>
                        <div class="buttons clearfix">
                            <button type="submit" id="button-review" class="btn btn-theme btn-wide">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Title Content Start -->
        <div class="col-sm-12 commontop text-center">
            <h4>Related Food</h4>
            <div class="divider style-1 center">
                <span class="hr-simple left"></span>
                <i class="icofont icofont-ui-press hr-icon"></i>
                <span class="hr-simple right"></span>
            </div>
            
        </div>
        <!-- Title Content End -->

        <?php if(!empty($related)){
           foreach ($related as $key => $value) {

            ?>
            <!-- Single Product Start -->
            <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-thumb">
                    <div class="image">
                        <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
                            <?php if($value['image']){ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" title="image" class="img-fluid" width="220" height="130" />
                            <?php }else{ ?>
                            <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="<?php echo $value['name']; ?>" title="image" class="img-fluid" width="220" height="130" />
                            <?php }?>


                        </a>
                    </div>
                </div>
                <div class="caption">
                    <h4><?php echo $value['name']; ?></h4>
                    <div class="rating">
                       <?php
                       $i= round($value['avg_rating']);

                       for($j=0;$j<$i;$j++){
                        ?>
                        <i class="fa fa-star" aria-hidden="true"></i>


                        <?php } for($h=0;$h<5-$i;$h++){?>  
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <?php 

                    }   
                    ?> 

                </div>
                <div class="price">Rs <?php echo $value['price']; ?></div>
                <p class="des"><?php echo $value['category']['name']; ?></p>
                <p>
				
				    <?php  
                                        $string = strip_tags($value['description']);
                                        if (strlen($string) > 108) {     
                                            $stringCut = substr($string, 0, 108);
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.$this->request->webroot.'products/view/'.$value['slug'].'" class="read_lst">Read More</a>'; 
                                        }
                                        ?>
                  <?php if(isset($string)){ echo $string; } ?> 
				
				
				
				</p>
                <p><?php echo $this->Form->create(NULL, array('url' => array('controller'=>'restaurants','action' => 'addtocart'))); ?> 
                    <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  

                    <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
                    <?php echo $this->Form->end(); ?></p>
                </div>
            </div>
            <?php } } ?>
        </div>
        <!-- Single Product End -->


    </div>
</div>
</div>
</div>
</div>
<!-- Shop End -->

  <script>
      jQuery('.rating span').each(function(){

    jQuery(this).click(function(){
        if(!jQuery(this).hasClass('checked')){
            jQuery(this).addClass('checked');
            jQuery(this).prevAll().addClass('checked');
            var rate = jQuery('#rating .checked').length;
        }else{
            jQuery(this).nextAll().removeClass('checked');
            var rate = jQuery('#rating .checked').length;
        }
       
        jQuery('#ratings1').val(rate);  
    });  
});
  </script> 
















