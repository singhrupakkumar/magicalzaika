
<!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2><?php if ($term->title) {
    echo $term->title;
} ?></h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#"><?php if ($term->title) {
    echo $term->title;
} ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

   <div class="about7">
                <div class="container">
                    <div class="row">

                      <?php if ($term->content) {
    echo $term->content;
} ?>

                    </div>
                </div>
            </div>