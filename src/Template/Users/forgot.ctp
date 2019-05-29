 <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Forgot</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Forgot Password</a></li>
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
                            <h4>Forgot Password</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Please Fill Your Existing Email.</p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 forgt78">
                                    <div class="loginnow">
                                        <h5>Forgot Password</h5>
                                        <p>Enter Email Address to Reset Password</p>
                                         <?= $this->Form->create('', ['type' => 'file','id' => 'forgot-form']) ?>
                    <div class="form-group zip_full">
                        
                        <input id="email" type="email" class="form-control ctrl_smn" name="email" placeholder="Email Address" required="required">
                    </div>
             
                 <?= $this->Form->button(__('Send'),['class'=>'btn btn-success cntr_grn','id'=>'forgotbutton']); ?>
                 <?= $this->Form->end() ?>
                                           
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->





  