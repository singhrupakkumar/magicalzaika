
<!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2><?php if($contact->title){ echo $contact->title; }?></h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#"><?php if($contact->title){ echo $contact->title; }?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->
<div class="contactus">
    <div class="container">
        <div class="row">





<!-- Title Content Start -->
                        <div class="col-sm-12 commontop text-center">
                          <?= $this->Flash->render() ?> 
                            <h4>Get In Touch</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <?php if(isset($contact['content'])) { echo $contact['content']; }?>
                        </div>
                        <!-- Title Content End -->

                        <div class="col-md-5 col-12">
                            <!--  Contact form Start  -->
                             <?= $this->Form->create(null, ['type' => 'file','id' => 'contact-form','class'=>'form-horizontal']) ?>  
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="icofont icofont-ui-user"></i>
                                        <?php echo $this->Form->control('name', ['label' => false,'class' => 'form-control','placeholder'=>'Name']); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="icofont icofont-ui-message"></i>
                                        <?php echo $this->Form->control('email', ['label' => false,'class' => 'form-control','type'=>'email','placeholder'=>'Your Email']); ?> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <i class="icofont icofont-ui-subject"></i> 
                                        <?php echo $this->Form->control('subject', ['label' => false,'class' => 'form-control','type'=>'text','placeholder'=>'Subject']); ?> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <i class="icofont icofont-pencil-alt-5"></i>
                                       <?php echo $this->Form->control('message', ['label' => false,'class' => 'form-control','type'=>'textarea','rows'=>3,'placeholder'=>'Message']); ?>
                                    </div>
                                </div>
                                <div class="buttons">
                                  <?= $this->Form->button(__('Send Message'),['class'=>'btn btn-theme btn-block','id'=>'send']); ?>
                                 
                                </div>
                            <?= $this->Form->end() ?>
                            <!--  Contact form End  -->
                        </div>
						
						 <div class="col-md-7 col-12">
                            <!--  Map Start  -->
                            <div class="map">
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3432.4737057711427!2d76.82161371512952!3d30.64878668166644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390feb3303544309%3A0x582b7b9b34b21975!2sRoyale+Estate%2C+Zirakpur%2C+Punjab+140603!5e0!3m2!1sen!2sin!4v1540214091343" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                            <!--  Map End  -->
                        </div>




        </div>
    </div>  
</div>

<script>
$().ready(function() {
	var cform = $("#contact-form").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			},
			subject: {required: true},
			message: {
				required: true
			}
		
		},
		messages: {
			name: "Please enter your name",
			email: "Please enter a valid email address",
			message: "Message is required",
			subject: "Please enter your subject"
		}
	});
        

   
   

 
 
});
</script>

