       <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Login</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Login Start -->
            <div class="login">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 commontop text-center">
                           <?= $this->Flash->render() ?>   
                            <h4>Edit Profile</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                   
                                <div class="prfle_pic">
                                    <?php if($user['image']){ ?>
                                    <img class="currentimg" src="<?php echo $this->request->webroot."images/users/".$user['image']; ?>" width="250" height="250">
                                    <?php }else{ ?>
                             <img class="currentimg" src="<?php echo $this->request->webroot."images/users/noimage.png"; ?>" width="250" height="250">
                                    <?php } ?>
                             
                                </div>
                                  
                                </div>






                                 <div class="col-sm-12 col-md-8">
                                    <div class="loginnow">

                                       <?= $this->Form->create($user, ['id' => 'edit-form', 'enctype' => 'multipart/form-data']) ?>
                            <?php echo $this->Form->control('image', ['class' => 'form-control ctrl_smn smm_alg','type'=>'file','id'=>'img' ,'label' => false]); ?>
                            <div class="input-group gp_slct slct_fln">
              <div class="col-sm-2">
                           <span class="brdr_trns"><label>Name</label></span>
               </div>
                <div class="col-sm-10">
                                <?php echo $this->Form->control('name', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'Full Name']); ?>
                            </div> 
              </div>
                        
                             <div class="input-group slct_fln">
               <div class="col-sm-2">
                                <span class="brdr_trns"><label>Email</label></span>
                </div>
                 <div class="col-sm-10">
                                <?php echo $this->Form->control('email', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Email Address','readonly']); ?>
                            </div>
              </div>
                        

                        
                            <div class="input-group slct_fln">
              <div class="col-sm-2">
                              <span class="brdr_trns lbl_sgnl"><label>Phone Number</label></span> 
                </div>
                 <div class="col-sm-10"> 
                              <?php echo $this->Form->control('phone', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'123-456-1234','maxlength'=>12]); ?>
                           </div>
               </div>
                 
            
                 
                           <div class="input-group slct_fln">
                 <div class="col-sm-2">
                            <span class="brdr_trns"><label>Address</label></span>  
               </div>
                 <div class="col-sm-10">   
                              <?php echo $this->Form->control('address', ['class' => 'form-control ctrl_smn', 'label' => false,'placeholder'=>'Address']); ?>
                           </div> 
                            </div>
              
                           <div class="input-group grp_adjst">
                 <div class="col-sm-4 col-md-2">
                            <span class="brdr_trns lgh_snt"><label>State</label></span> 
               </div>
                 <div class="col-sm-8 col-md-10">  
                              <?php echo $this->Form->control('state', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'State']); ?>
                           </div> 
               </div>
               
                           <div class="input-group grp_adjst">
                 <div class="col-sm-4 col-md-2">
                             <span class="brdr_trns"><label>Zip Code</label></span> 
                </div>
                 <div class="col-sm-8 col-md-10">  
                              <?php echo $this->Form->control('zip', ['class' => 'form-control ctrl_smn lft_hldr', 'label' => false,'placeholder'=>'Zip']); ?>
                           </div>
               </div>
               
                           <div class="input-group cntr_ctl slct_fln">
                              <!--<label for="exampleInputPassword1">Country</label> -->
                <div class="col-sm-2">
                              <span class="brdr_trns"><label>Country</label></span>
                 </div>
                 <div class="col-sm-10">  
                              <select class="form-control form-select ajax-processed sel-country" id="edit-node-type" name="country" required="required">
                               <option value="United States">United States</option>
                               <?php if(!empty($countries)){ ?>
                               <?php foreach($countries as $country){ ?>
                               <?php   
                               if($user['country'] == $country['name']){ ?>
                               <option value="<?php echo $country['name']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                               <?php }else{ ?>
                               <option value="<?php echo $country['name']; ?>"><?php echo $country['name']; ?></option>
                               <?php } ?>
                               <?php } ?>
                               <?php } ?>
                               </select>
                           </div> 
               </div>
<div class="save7">
                        <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-warning']) ?>
                           <?= $this->Form->end() ?>
                                       </div>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<script>

$(document).ready(function() {
	$("#edit-form").validate({  
		ignore: "",
		rules: {
			email: {
				required: true,
				email: true
			},
			name: {required:true},
			dob: {required:true},
      phone: { 
          required:true,  
      },
      zip: {
          required:true,
          number:true,
      },
			country: {
				required: true
			},
			state: "required"
			
		},
		messages: {
                          name: {     
                                  required: "Please enter your Full Name", 
                                },      
			dob: "Please select date of Birth",
			country: "Please select country",
			gender: "Please select gender",
                        email: "Please enter a valid email address",
			state: "Please enter state",
			zip: "Please enter zipcode"
		}
	});
}); 

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.currentimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#img").change(function(){
    readURL(this);
});
</script>    