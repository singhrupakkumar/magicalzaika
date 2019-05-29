 <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Change Password</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Change Password</a></li>
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
                            <h4>Change Password</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 chngpsd">
                                    <div class="loginnow">
                    
                  <?= $this->Form->create('', ['type' => 'file', 'id' => 'change-from']) ?>
                    <div class="form-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span>
                         <input type="password" placeholder="Enter Your Old Password" name="opassword" class="form-control ctrl_smn" id="opassword">
                    </div>

                    <div class="form-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span> 
                        <input type="password" class="form-control ctrl_smn" placeholder="Enter Your New Password" name="password1" id="password1">
                    </div>

                    <div class="form-group">
                        <span class="input-group-addon brdr_trns"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control ctrl_smn" placeholder="Confirm Password" name="password">
                    </div>

                <?= $this->Form->button(__('Change Password'),['class'=>'btn btn-success cntr_grn']); ?>
                 <?= $this->Form->end() ?>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<script>
 $(document).ready(function() {
         $("#change-from").validate({
                 rules: { 
                         opassword: "required",
                         password1: {
				required: true,
				minlength: 6
			},
                         password: {
                                 equalTo: "#password1"
                         }
                 },
                 messages: {
                         opassword: "Please enter your old password",
                         password1: "Password is required", 
                         password: {
                                 equalTo: "Password and confirm password should be same"
                         }		
                 }
         });
 });
 </script>
