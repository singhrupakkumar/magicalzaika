<section class="content-header">
  <?= $this->Flash->render() ?>
  <h1>
   <?= __('Order') ?>
   <small></small>
 </h1>
 <ol class="breadcrumb">
  <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active"><?= __('Order') ?></li>
</ol>
</section>

<section class="content">
	<div class="row">
    <div class="col-xs-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Edit Order') ?></h3> 
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->Form->create($order, ['id' => 'order-form', 'enctype' => 'multipart/form-data']) ?>
        <div class="box-body">
          <div class="form-group"> 
            <div class="form-group">
              <label for="exampleInputEmail1">Change status</label>
              <select id="order_status" name="order_status" class="form-control" required="required">
               <option value="1" <?php if($order['order_status'] ==1){ echo "selected";}   ?>> Pending</option>
               <option value="2" <?php if($order['order_status'] ==2){ echo "selected";}   ?>> Processing</option>
               <option value="3" <?php if($order['order_status'] ==3){ echo "selected";}   ?>> Complete</option>
               <option value="4" <?php if($order['order_status'] ==4){ echo "selected";}   ?>> Cancel</option>
             </select>
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

