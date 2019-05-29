<!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2><?php if($aboutus->title){ echo $aboutus->title; }?></h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#"><?php if($aboutus->title){ echo $aboutus->title; }?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->


				

                        <?php if($aboutus->content){ echo $aboutus->content; }?>

