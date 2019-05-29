<style>
    .error-message,.error{
        color: red;
    }  
</style>

 <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Register</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Register</a></li>
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
                            <h4>Create an Account</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more. It help for fast login and checkout process,So create your account now and login with us. </p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 add78">
                                    <div class="loginnow">
                                        <h5>Register</h5>
                                        <p>Do You have an account? So <a href="<?php echo $this->request->webroot ?>users/login">login</a> And starts less than a minute</p>
                                       <?= $this->Form->create($user, ['type' => 'file','id' => 'user-form']) ?>
                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="text" name="name" placeholder="NAME" id="input-name" class="form-control" />
                                            </div>
                                            <div class="form-group <?= ($this->Form->isFieldError('email'))? 'has-error': '' ; ?>">
                                                <i class="icofont icofont-ui-message"></i><input type="email" name="email" value="" placeholder="EMAIL" id="email" class="form-control" />
                                                <?php echo $this->Form->error('email', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
                                            </div>
                                            <div class="form-group <?= ($this->Form->isFieldError('password1'))? 'has-error': '' ; ?>">
                                                <i class="icofont icofont-lock"></i><input type="password" name="password1" value="" placeholder="PASSWORD" id="password1" class="form-control" />
                                                 <?php echo $this->Form->error('password1', null, array('class' => 'label label-block label-danger text-left', 'wrap' => 'label')); ?>
                                            </div>
                                            <div class="form-group <?= ($this->Form->isFieldError('password'))? 'has-error': '' ; ?>">
                                                <i class="icofont icofont-lock"></i><input type="password" name="password" placeholder="REPEAT PASSWORD" id="password2" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <div class="links">
                                                    <label><input type="checkbox" class="checkbox-inline"/> By signing up I agree with <a href="#">terms & conditions.</a> </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <?= $this->Form->button(__('SIGN UP'),['class'=>'btn btn-theme btn-md btn-wide']); ?>   
                                               
                                            </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->




<script> 
    
$().ready(function() {
	var form = $("#user-form").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true
			},
			password1: { 
				required: true,
				minlength: 6
			},
			password: {
				equalTo: "#password1"
			},
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			password1: "Password is required",
			password: {
				equalTo: "Password and confirm password should be same"
			}
		}
	});
        

 
});
</script>
