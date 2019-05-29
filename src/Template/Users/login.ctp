 <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Login</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="/">HOME</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">Login</a></li>
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
                            <h4>Login to Your Account</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>If you have shopped with us before, please login to your account and enter your login details in the boxes below for login to account. If you are a new customer then please register your account for login. </p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-8 login78">
                                    <div class="loginnow">
                                        <h5>Login</h5>
                                        <p>Don't have an account? So <a href="<?php echo $this->request->webroot ?>users/add">Register</a> And starts less than a minute</p>
                                         <?= $this->Form->create('Users', ['id' => 'login-form']) ?> 
                                            <div class="form-group">
                                                <i class="icofont icofont-ui-message"></i><input type="email" name="username" placeholder="EMAIL" id="email" class="form-control" required="required"/>
                                            </div>
                                            <div class="form-group">
                                                <i class="icofont icofont-lock"></i><input type="password" name="password" value="" placeholder="PASSWORD" id="input-password" class="form-control" required="required"/>
                                            </div>
                                        
                                            <div class="form-group">
                                              <?= $this->Form->button(__('SIGN IN'),['class'=>'btn btn-theme btn-md btn-wide','id'=>'loginbutton']); ?> 
                                               
                                            </div>
											<div class="form-group"> 
                                                <div class="creat">
                                                    <a class="creat7" href="<?php echo $this->request->webroot ?>users/add">Create an Account</a>
                                                </div>
                                            </div>   
                                       <?= $this->Form->end() ?> 
                                           <div class="form-group"> 
                                                <div class="links">
                                                    <a class="float-right sign" href="<?php echo $this->request->webroot ?>users/forgot">Forgot Password?</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->


