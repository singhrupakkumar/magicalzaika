
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2><?php echo $rest['name']; ?></h2>

    </div>
  </div>
</div>
<!-- Breadcrumb End -->



 <!-- Shop Start -->
            <div class="shop">
                <div class="container">
                  
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Left Filter Start -->
                            <div class="left-side">
                                <h4>SEARCH FILTERS</h4>
                                <div class="search">
                                    <!-- Search Filter Start -->

    
                                    <form  class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group">
                                                <input  name="pname" class="form-control"  placeholder="Search Food" type="text">
                                            <button type="submit" value="submit" class="btn"><i class="icofont icofont-search"></i></button>
                                            </div> 

                                           <div class="form-group">
                                                <select class="form-control" name="category">
                                               <option value="">Select Category</option> 
                                              <?php if(!empty($catlist)) {
                                                foreach ($catlist as $key => $value) {
                                               ?>
                                             
                                              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                              <?php
                                                } }
                                               ?> 
                                              
                                            </select>
                                           
                                            </div>
                                            
                                        </fieldset>
                                    
                                    <!-- Search Filter End -->
                                </div>
                            
                            
                                <div class="rating">
                                    <!-- Rating Filter Start -->
                                    <h3>Rating</h3>
                                    <ul class="list-unstyled">
                                        <li>
                                            <label class="check">
                                                <input type="radio" name="rating" value="5" class="checkclass"/>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="check">
                                                <input type="radio" name="rating" value="4" class="checkclass"/>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="check">
                                                <input type="radio" name="rating" value="3" class="checkclass"/>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="check">
                                                <input type="radio" name="rating" value="2" class="checkclass"/>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="check">
                                                <input type="radio" name="rating" value="1" class="checkclass"/>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </label>
                                        </li>
                                    </ul>
                                     <button type="submit" value="submit" class="btn"><i class="icofont icofont-search"></i></button>
                                    <!-- Rating Filter End -->
                                    </form>
                                </div>
                            </div>
                            <!-- Left Filter End -->
                        </div>
                        <div class="col-md-9 mainpage">
                            <?= $this->Flash->render() ?> 
                            <!-- Product View Start -->
                            <div class="row sort">
                                <!-- Product Short Start -->
                          
                             
                                <div class="col-md-4 list d-sm-none d-md-block text-right">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" id="grid-view" class="btn btn-theme-alt btn-md btngrid" data-toggle="tooltip" title="Grid"><i class="icofont icofont-brand-microsoft"></i></button>
                                        <button  type="button" id="list-view" class="btn btn-theme-alt btn-md btngrid" data-toggle="tooltip" title="List"><i class="icofont icofont-listine-dots"></i></button>
                                    </div>
                                </div>
                                <!-- Product Short End -->
                            </div>

                            <div class="row">
                                <!-- Product List Start -->
                                <!-- Single Product Start -->
                                <?php if(!empty($product)){
                                 foreach ($product as $key => $value) {
                                 
                                ?>
                                <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="product-thumb">
                                        <div class="image">
                                            <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
                                    <?php if($value['image']){ ?>
                                    <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" class="img-fluid" width="220" height="130" />
                                    <?php }else{ ?>
                                     <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="img-fluid" width="220" height="130" />
                                    <?php }?>


                                            </a>
                                            <div class="hoverbox">
                                               <?php echo $this->Form->create(NULL, array('url' => array('action' => 'addtocart'))); ?> 
                                            <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
                                                     
                                            <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
                                            <?php echo $this->Form->end(); ?>
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
                                            <p><?php echo $value['description']; ?></p>
                                            <p><?php echo $this->Form->create(NULL, array('url' => array('action' => 'addtocart'))); ?> 
                                            <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
                                                     
                                            <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
                                            <?php echo $this->Form->end(); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                                <?php } } ?>
                                <!-- Single Product Start -->
                               
                                <!-- Product List End -->
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 text-center">

                                    <!-- Pagination Start -->
                                    <ul class="pagination justify-content-center">
                                        <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
                                       
                                    </ul>
                                    <!-- Pagination End -->
                                </div>
                            </div>
                            <!-- Product View End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop End -->


















