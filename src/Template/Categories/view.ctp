   <!-- Breadcrumb Start -->
   <div class="bread-crumb">
    <div class="container">
        <div class="matter">
            <h2><?php echo $category['name']; ?></h2>
           
        </div>
    </div>
</div>
<!-- Breadcrumb End -->



<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                    <ul class="list-inline">
                <!--<li class="list-inline-item"><a href="#"><?php// echo $category['name'];
                 ?></a>
                </li>-->
                <?php if(!empty($category['subcategories'])){

                      foreach ($category['subcategories'] as $key => $value) {

                       ?>
                   <li class="list-inline-item"><a href="<?php echo $this->request->webroot."categories/subcatview/".$value['slug']; ?>"><?php echo $value['name'];
                 ?></a>
                </li>
                <?php } } ?>      

            </ul>
             </div>   
            <!-- Title Content Start -->
            <div class="col-sm-12 commontop text-center">
                 <?= $this->Flash->render() ?>    
                <h4 class="mt-0"><?php echo $category['name']; ?></h4>
                <div class="divider style-1 center">
                    <span class="hr-simple left"></span>
                    <i class="icofont icofont-ui-press hr-icon"></i>
                    <span class="hr-simple right"></span>
                </div>
                <p><?php echo $category['description']; ?></p>
            </div>
            <!-- Title Content End -->

            <div class="col-sm-12 mainpage">
                <!-- Product View Start -->
                <div class="row sort">


                    <div class="col-md-12 list d-sm-none d-md-block text-right">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" id="grid-view" class="btn btn-theme-alt btn-md btngrid" data-toggle="tooltip" title="Grid"><i class="icofont icofont-brand-microsoft"></i></button>
                            <button  type="button" id="list-view" class="btn btn-theme-alt btn-md btngrid" data-toggle="tooltip" title="List"><i class="icofont icofont-listine-dots"></i></button>
                        </div>
                    </div>
                    <!-- Product Short End -->
                </div>

                <div class="row">
                    <!-- Product List Start -->
                    <?php if(!empty($category['products'])){
$int=1;
                      foreach ($category['products'] as $key => $value) {
						  

                       ?>
                       <!-- Single Product Start -->
                       <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="product-thumb">
                          <div class="image">
                            <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
                                <?php if($value['image']){ ?>
                                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="<?php echo $value['name']; ?>" title="image" class="img-fluid" width="220" height="130" />
                                <?php }else{ ?>
                                <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="<?php echo $value['name']; ?>" title="image" class="img-fluid" width="220" height="130" />
                                <?php }?>


                            </a>
                            <div class="hoverbox">
                                <?php //echo $this->Form->create(NULL, array('url' => array('controller'=>'restaurants','action' => 'addtocart'))); ?> 
                             <?php //echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  

                             <?php// echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
                             <?php //echo $this->Form->end(); ?>
                         </div>
                     </div>
                     <div class="caption">
                       <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">   <h4><?php echo $value['name']; ?></h4></a>
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
                        <p class="des"><?php echo $category['name']; ?></p>
                        <p><?php echo $this->Form->create(NULL, array('url' => array('controller'=>'restaurants','action' => 'addtocart'))); ?> 
                                            <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
                                                     
                                            <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
                                            <?php echo $this->Form->end(); ?></p>
                    </div>
                </div>
            </div>
			
			<?php
			
			if($int==3){
				
				echo '<div style="width: 100%;float: left;height: 35px;"></div>';
				$int=0;
			}?>
			
            <!-- Single Product End -->
            <?php $int++;} 
			
			}
		
			else{
				echo "<h2 style='text-align: center;'>Record Not Found</h2>";
			} ?>

        </div>
<div style="width: 100%;float: left;height: 55px;"></div>

    </div>
</div>
</div>
</div>