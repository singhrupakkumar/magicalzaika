
<!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2><?php if ($faq->title) {
    echo $faq->title;
} ?></h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo $this->request->webroot; ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#"><?php if ($faq->title) {
    echo $faq->title;
} ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->
<div class="faq">
    <div class="container">

        <div class="row">

            <div class="col-sm-12">
<?php if ($faq->content) {
    echo $faq->content;
} ?>
            </div>
        </div>

    </div>
</div>
