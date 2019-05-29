<section class="content-header">
    <h1>
   <?= __('Restaurant') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li class="active"><?= __('Add Restaurant') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-8">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?= __('Add Restaurant') ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= $this->Form->create($restaurants, ['id' => 'store-form', 'enctype' => 'multipart/form-data']) ?>
              <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false]); ?>
                </div>      
                  <?php echo $this->Form->control('description',['class' => 'form-control']);?>
                  <?php echo $this->Form->control('open_time',['class' => 'form-control']);?> 
                  <?php echo $this->Form->control('close_time',['class' => 'form-control']);?>    

                   <?php echo $this->Form->control('weekend_opening_time',['class' => 'form-control']);?> 
                  <?php echo $this->Form->control('weekend_closing_time',['class' => 'form-control']);?>  
                  <?php 
                   echo $this->Form->control('image',['type'=>'file']);
                  ?>   
                <div class="form-group">
                 <label for="exampleInputEmail1">Status</label>
              <?php echo $this->Form->select('status', [
                     '1' => 'Active',
                    '0' => 'Deactive'
                ],['label' => 'Status','class' => 'form-control']);
                ?>  
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
})
</script>      
  