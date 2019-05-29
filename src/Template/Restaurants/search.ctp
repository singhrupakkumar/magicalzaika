
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Restaurants</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="/">HOME</a></li>
        <li class="list-inline-item"><a href="#">Restaurants</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<div class="dishes no-border">
  <div class="container">
    <div class="row">
      <!-- Title Content Start -->
      <div class="col-sm-12 commontop text-center">
         <?= $this->Flash->render() ?> 
        <h4>Restaurant List</h4>
        <div class="divider style-1 center">
          <span class="hr-simple left"></span>
          <i class="icofont icofont-ui-press hr-icon"></i>
          <span class="hr-simple right"></span>
        </div>
       
      </div>
      <!-- Title Content End -->
      <div class="col-sm-12">
        <div class="dish owl-carousel">
            <?php 
              if(!empty($storedata[0]['products'])){ 
              foreach ($storedata[0]['products'] as $key => $value) {
              ?>
          <div class="item">
            <!-- Box Start -->
            <div class="box">
              <a href="#">
                <?php if($value['image']){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" class="img-responsive" />
                <?php }else{ ?>
                 <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="img-responsive" />
                <?php }?>
              </a>
              <div class="caption">
                <h4><?php echo $value['name']; ?></h4>
                <span>Category.</span>
                <p>Rs <?php echo $value['price']; ?></p>
                       <button class="btn btn-theme btn-md btn-wide">Book Now</button>
              </div>
            </div>
            <!-- Box End -->
          </div>
          <?php } } ?>
      
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Popular Dishes End -->





