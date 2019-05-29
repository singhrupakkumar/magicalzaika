 <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Reset Password</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Reset Password</a></li>
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
                            <h4>Reset Password</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <div class="loginnow">
                                        <h5>Reset Password</h5>
                                       <?= $this->Form->create('', ['type' => 'file', 'class' => 'form-horizontal','id' => 'reset-form']) ?>
                    <div class="form-group zip_full">
                        <span class="form-group-addon brdr_trns"><i class="fa fa-password" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password1" id="password1" placeholder="New Password" required="required">
                    </div>
                    <div class="form-group zip_full">
                        <span class="form-group-addon brdr_trns"><i class="fa fa-password" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Confirm Password" required="required">
                    </div>

                 <?= $this->Form->button(__('Save'),['class'=>'btn btn-success cntr_grn','id'=>'resetbutton','type'=>'button']); ?>
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
	$("#reset-form").validate({ 
		rules: {
			password1: {
				required: true,
				minlength: 6
			},

			password: {
				equalTo: "#password1"
			}
		},
		messages: {
			password1: {
				required: "Please Enter New password",
				minlength: "Please enter atleast 6 characters"
			},

			password: {
				equalTo: "Both Passwords do not match"
			}		
		}
	});
        
         
 
        
});
</script>