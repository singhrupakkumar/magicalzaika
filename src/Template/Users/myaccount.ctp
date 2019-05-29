 <!-- Breadcrumb Start -->
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
                            <h4>My Profile</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <div class="col-lg-10 col-md-12 myacut">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 accut">
                                   
                                       <?php if(isset($userdata->image)){  ?>    
                                    <img src="<?php echo $this->request->webroot."images/users/".$userdata->image; ?>" with="300" height="300">
                                    <?php }else{  ?>
                                    <img src="<?php echo $this->request->webroot."images/users/noimage.png"?>" with="300" height="300">
                                    <?php } ?>
                                  
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="loginnow">
                                        <div class="prfle_text">
                <h3><?php if(isset($userdata->name)){ echo $userdata->name; } ?></h3>
            </div>
        
            <?php if(!empty($userdata->email)) { ?>
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Email:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">
                <div class="dtl_prf"><?php if(isset($userdata->email)){ echo $userdata->email; } ?></div>
            </div>
            </div>
            </div>
            <?php } ?>
          
              <?php if(!empty($userdata->dob)) { ?>
             <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Date of Birth:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">  
                <div class="dtl_prf"><?php if(isset($userdata->dob)){ echo $userdata->dob; } ?></div>    
            </div>
            </div>
            </div>
            <?php } ?>
            <?php if(!empty($userdata->city)) { ?>
            <div class="col-sm-12" style="padding: 0;"> 
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">City:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">  
                <div class="dtl_prf"><?php if(isset($userdata->city)){ echo $userdata->city; } ?></div>    
            </div>
            </div>
            </div>
             <?php } ?>
            <?php if(!empty($userdata->state)) { ?>
            <div class="col-sm-12" style="padding: 0;"> 
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">State:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">  
                <div class="dtl_prf"><?php if(isset($userdata->state)){ echo $userdata->state; } ?></div>    
            </div>
            </div>
            </div>
             <?php } ?>
            <?php if(!empty($userdata->zip)) { ?>
            <div class="col-sm-12" style="padding: 0;"> 
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Zip:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">  
                <div class="dtl_prf"><?php if(isset($userdata->zip)){ echo $userdata->zip; } ?></div>    
            </div>
            </div>
            </div>
            <?php } ?>
            <?php if(!empty($userdata->country)) { ?>
            <div class="col-sm-12" style="padding: 0;"> 
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Country:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">  
                <div class="dtl_prf"><?php if(isset($userdata->country)){ echo $userdata->country; } ?></div>       
            </div>
            </div>
            </div>
        
            <?php } ?>
            <?php if(!empty($userdata->phone)) { ?>
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Phone:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">
                <div class="dtl_prf"><?php if(isset($userdata->phone)){ echo $userdata->phone; } ?></div>
                </div>
                </div>
            </div>
             <?php } ?>
            <?php if(!empty($userdata->address)) { ?>
            <div class="col-sm-12" style="padding: 0;">
            <div class="prfl_dtle">
            <div class="col-sm-4 col-sm-offset-2" style="padding: 0;">
                <div class="labl_prf">Address:</div>
                </div>
                <div class="col-sm-4" style="padding: 0;">
                <div class="dtl_prf"><?php if(isset($userdata->address)){ echo $userdata->address; } ?></div>
                </div>
                </div>
            </div>
              <?php } ?>  
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->


