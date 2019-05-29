<section class="content-header">
    <h1>
   <?= __('Store Location') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Add Location') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-6">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Location') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($restaurentlocations, ['id' => 'location-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                <?php echo $this->Form->control('location_name', ['class' => 'form-control', 'label' => 'Address']); ?>
                 <?php echo $this->Form->control('lat', ['class' => 'form-control', 'id' => 'lat']); ?>

                 <?php echo $this->Form->control('long', ['class' => 'form-control', 'id' => 'long']); ?>
                  
                </div>
                  
                
            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
        <div class="col-xs-6">
         <div class="map_outer">
        <div id="mapaddress" style="position: absolute; right:0px;top:0; width:400px;height:400px"></div>
      </div>
     </div>
</section> 

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQrWZPh0mrrL54_UKhBI2_y8cnegeex1o&libraries=places"></script>  

<script>

/****************Lat Long***********************/


  
    $("#location-name").on('change',function(){ 

        $.post("<?php echo $this->request->webroot; ?>admin/restaurants/LatLongFromAddress",
        {
            address: $(this).val()
        },
        function(data, status){

            if(status=='success'){
             $("#locat").prop('disabled', false);
                var res = JSON.parse(data);
               //console.log(res)
                $('#lat').val(res.latitude);
            $('#long').val(res.longitude);
                 displayMap(res.latitude,res.longitude)
            }
            
        });
    });
    
     function displayMap(latitude,longitude){
        console.log('display mapaddress')
       // $('#RestaurantLatitude').val(latitude)
       // $('#RestaurantLongitude').val(longitude)
        var myCenter = new google.maps.LatLng(latitude,longitude);
        var mapCanvas = document.getElementById("mapaddress");
        var mapOptions = {center: myCenter, zoom: 15};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter,draggable: true});
        marker.setMap(map);
        
        google.maps.event.addListener(marker, 'dragend', function(evt){
            //console.log('dragged')
      //console.log(evt)
      //console.log(marker)
            $('#lat').val(evt.latLng.lat())
            $('#long').val(evt.latLng.lng())
      GetAddress(evt.latLng.lat(),evt.latLng.lng());
            //document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
        });
    }
  
  
   function GetAddress(lat,lng) {
            //var lat = parseFloat(document.getElementById("aalat").value);
           // var lng = parseFloat(document.getElementById("aalong").value);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                       // alert("Location: " + results[1].formatted_address);
          jQuery("#location-name").val(results[1].formatted_address);
            //console.log(results[1].formatted_address)
                    }
                }
            });
        }
</script>    