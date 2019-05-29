
<!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2><?php if($privacy->title){ echo $privacy->title; }?></h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#"><?php if($privacy->title){ echo $privacy->title; }?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

   <div class="about">
                <div class="container">
                    <div class="row">


                     <?php if($privacy->content){ echo $privacy->content; }?>
                     
                    </div>
                </div>
            </div>
	