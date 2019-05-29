 <!-- Slider Start -->
            <div class="slide"> 
                <div class="slideshow owl-carousel">
                    <!-- Slider Backround Image Start -->
                    <div class="item">
                        <img src="<?php echo $this->request->webroot; ?>assets/banner47.jpg" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <div class="item">
                        <img src="<?php echo $this->request->webroot; ?>assets/images/background/banner-2.jpg" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <div class="item">
                        <img src="<?php echo $this->request->webroot; ?>assets/images/background/banner-3.jpg" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <div class="item">
                        <img src="<?php echo $this->request->webroot; ?>assets/images/background/banner-4.jpg" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <!-- Slider Backround Image End -->
                </div>

                <!-- Slide Detail Start  -->
                <div class="slide-detail">
                    <div class="container">
                        <img src="assets/images/logo/logo-icon.png" alt="logo1" title="logo1" class="img-responsive" />
                        <div class="cd-headline clip">
                            <h4>LOVES <span class="cd-words-wrapper">
                                    <b class="is-visible">HEALTHY</b>
                                    <b>QUALITY</b>
                                    <b>TASTY</b>
                                </span>FOOD</h4>
                        </div>
                        
                        
                    </div>
                </div>	
                <!-- Slide Detail End  -->
            </div>
            <!-- Slider End  -->
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="shop">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
       </div> 
     <div class="col-sm-6 commontop text-center">
       <?= $this->Flash->render() ?> 


         <!--form method="post" accept-charset="utf-8" id="login-form" action="<?php echo $this->request->webroot; ?>restaurants/search">
          <div class="input-group mb-3">
            <input type="text" name="location" onFocus="geolocate()" id="autocomplete" class="form-control" placeholder="Enter your location" aria-label="Enter your location" aria-describedby="basic-addon2" required="required">
            <div class="input-group-append">
            <input type="hidden" name="lat" id="lat" value=""> 
            <input type="hidden" name="long" id="long" value="">
              <button class="btn btn-theme btn-md btn-wide" type="submit">Go</button>
            </div>
          </div>

        </form--> 


    </div>
      <div class="col-sm-3">
       </div> 
  </div>
</div>
</div>

<!-- Shop End -->





<!-- Latest Dishes Start -->
<div class="dishes no-border">
  <div class="container">
    <div class="row">
      <!-- Title Content Start -->
      <div class="col-sm-12 commontop text-center">
        <h4>Latest Dishes</h4>
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
              if(!empty($latestdish)){
              foreach ($latestdish as $key => $value) {
              ?>
          <div class="item">
            <!-- Box Start -->
            <div class="box">
              <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
                <?php if($value['image']){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" class="img-responsive" width="250" height="200"/>
                <?php }else{ ?>
                 <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="img-responsive" width="250" height="200"/>
                <?php }?>
              </a>
              <div class="caption">
                <h4><a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>"><?php echo $value['name']; ?></a></h4>
                <span><?php echo $value['category']['name']; ?></span>
                <p>Rs <?php echo $value['price']; ?></p>
                         <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'restaurants', 'action' => 'addtocart'))); ?> 
				                                    <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
				                                             
				                                    <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md btn-wide','id' => $value['id']));?>
				                                    <?php echo $this->Form->end(); ?>
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
<!-- Latest Dishes End -->






<!-- Popular Dishes Start -->
<div class="dishes no-border">
  <div class="container">
    <div class="row">
      <!-- Title Content Start -->
      <div class="col-sm-12 commontop text-center">
        <h4>Popular Dishes</h4>
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
              if(!empty($random)){
              foreach ($random as $key => $value) {
              ?>
          <div class="item">
            <!-- Box Start -->
            <div class="box">
              <a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
                <?php if($value['image']){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" class="img-responsive" width="250" height="200"/>
                <?php }else{ ?>
                 <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" class="img-responsive" width="250" height="200"/>
                <?php }?>
              </a>
              <div class="caption">
                <h4><a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>"><?php echo $value['name']; ?></a></h4>
                <span><?php echo $value['category']['name']; ?></span>
                <p>Rs <?php echo $value['price']; ?></p>
                         <?php echo $this->Form->create(NULL, array('url' => array('controller' => 'restaurants', 'action' => 'addtocart'))); ?> 
				                                    <?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
				                                             
				                                    <?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md btn-wide','id' => $value['id']));?>
				                                    <?php echo $this->Form->end(); ?>
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




<!-- Top Dish cat Start -->
<div class="dishes no-border">
  <div class="container">
    <div class="row">
      <!-- Title Content Start -->
      <div class="col-sm-12 commontop text-center">
        <h4>Top Dish Category</h4>
        <div class="divider style-1 center">
          <span class="hr-simple left"></span>
          <i class="icofont icofont-ui-press hr-icon"></i>
          <span class="hr-simple right"></span>
        </div>
       
      </div>
   </div>   
  <div class="row">    

      <!-- Title Content End -->
      <?php 
      if(!empty($topcat)){
      foreach ($topcat as $key => $value) {
      ?>
          <div class="col-sm-3">   
            <!-- Box Start -->
            <div class="box">    
              <a href="<?php echo $this->request->webroot."categories/view/".$value['slug']; ?>">  <?php if($value['image']){ ?>
                <img src="<?php echo $this->request->webroot; ?>images/categories/<?php echo $value['image']; ?>" alt="image" title="image" class="img-responsive" width="250" height="250"/>
                <?php }else{ ?>     
                 <img src="<?php echo $this->request->webroot; ?>images/categories/no-image.jpg" alt="image" title="image" class="img-responsive" width="250" height="250"/>
                <?php } ?>
              </a>
              <div class="caption7">
                <h4><a href="<?php echo $this->request->webroot."categories/view/".$value['slug']; ?>"><?php echo $value['name']; ?></a></h4>

              </div>
            </div> 
            <!-- Box End -->
          </div>

      <?php 
      }
    }
      ?>  
  
    </div>
  </div>
</div>
<!-- Top Dish cat End -->
<!-- Testimonials Start  -->
            <div class="testimonials">
                <div class="container">
                    <div class="testimonials-inner">
                        <div class="row ">
                            <!-- Title Content Start -->
                            <div class="col-sm-12 col-xs-12 commontop white text-center">
                                <h4>What Our Customers Say</h4>
                                <div class="divider style-1 center">
                                    <span class="hr-simple left"></span>
                                    <i class="icofont icofont-ui-press hr-icon"></i>
                                    <span class="hr-simple right"></span>
                                </div>
                            </div>
                            <!-- Title Content End -->
                            <div class="col-sm-12 col-xs-12">
                                <div class="owl-carousel owl-theme owl-testi">
                                    <?php if(!empty($testimonials)) 
                                    {
                                        
                                    foreach($testimonials as $c){
                                    
                                    ?>
                                    <div class="item">
                                       <?php echo $c->content; ?>
                                        <span>- <?php echo $c->client_name; ?></span>
                                    </div>
                                    <?php } } ?>
                      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

<script>
     // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };
      function initAutocomplete() {
          var options = {
                types: ['(cities)'],
                componentRestrictions: {country: "IN"}
               };
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
           options);
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }
      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        
        
        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('long').value = place.geometry.location.lng();
        
        
        for (var component in componentForm) {
   
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }
      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
             document.getElementById('lat').value = position.coords.latitude;
             document.getElementById('long').value = position.coords.longitude;
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQrWZPh0mrrL54_UKhBI2_y8cnegeex1o&libraries=places&callback=initAutocomplete"
      ></script> 

