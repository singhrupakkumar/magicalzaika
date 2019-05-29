<section class="content-header">
    <h1>
    <?= __('Restaurant') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Edit Restaurant') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Edit Restaurant') ?> <strong>(ID: <?php echo $restaurants->id; ?>)</strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($restaurants, ['id' => 'store-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
              	<div class="form-group">

                <div class="form-group">
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => 'Name']); ?>
                </div>
                <div class="form-group">
                  <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => 'Description']); ?>
                </div>
                
                  <?php echo $this->Form->control('open_time',['class' => 'form-control']);?> 
                  <?php echo $this->Form->control('close_time',['class' => 'form-control']);?>    

                   <?php echo $this->Form->control('weekend_opening_time',['class' => 'form-control']);?> 
                  <?php echo $this->Form->control('weekend_closing_time',['class' => 'form-control']);?> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php if($restaurants->status==1){ echo "selected"; }?>>Active</option>
                    <option value="0" <?php if($restaurants->status==0){ echo "selected"; }?>>Deactive</option>
        
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <?php echo $this->Form->control('image', ['id' => 'productPic', 'type' => 'file', 'class' => 'form-control', 'label' => false]); ?>
                </div>   
                           
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
              </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
    </div>
</section> 

<script>
  
$('#datepicker').datepicker({
  autoclose: true
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.previewHolder').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#productPic").change(function() {
  readURL(this);
});
</script>      