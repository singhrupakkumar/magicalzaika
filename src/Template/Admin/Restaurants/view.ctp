<section class="content-header">
    <h1>
    <?= __('Restaurant') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> <?= __('Home') ?> </a></li>
        <li class="active"><?= __('View') ?> </li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($restaurants->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($restaurants->name) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?=  $this->Number->format($restaurants->id) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Description') ?></th> 
           <td><?= h(strip_tags($restaurants->description)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($restaurants->status) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Open Time') ?></th>
            <td><?php echo date('H:i', strtotime($restaurants->open_time)); ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Close Time') ?></th>
            <td><?php echo date('H:i', strtotime($restaurants->close_name)); ?></td>
        </tr>



       <tr>
            <th scope="row"><?= __('Weekend Opening Time') ?></th>
            <td><?php echo date('H:i', strtotime($restaurants->weekend_opening_time)); ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Weekend Closing Time') ?></th>
            <td><?php echo date('H:i', strtotime($restaurants->weekend_closing_time)); ?></td>
        </tr>


        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($restaurants->created) ?></td>
        </tr>
    
        <tr>
          <th><?= __('Image') ?></th>
          <td>
            <?php if($restaurants->image != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/restaurants/<?php echo $restaurants->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/restaurants/no-image.jpg" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td>
          <?= $this->Html->link(__('Edit Restaurants'), ['action' => 'edit', $restaurants->id], ['class' => 'btn btn-info']) ?>     
          <?= $this->Form->postLink(__('Delete Restaurants'), ['action' => 'delete', $restaurants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurants->id),'class' => 'btn btn-danger']) ?>    
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>


         <div class="col-xs-12">
        
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products</h3>
            </div>
         
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
             <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Sub Category') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
                <tbody>
                  <?php foreach ($restaurants['products'] as $product): ?>
                    
                    
            <tr>
                <td><?= $this->Number->format($product->id) ?></td>  
                <td><?= h($product->name) ?></td>
                <td>$<?= h($product->price) ?></td>  
                <td><?= h($product->category->name) ?></td>
                <td><?= h($product->subcategory->name) ?></td>
                <td><?php echo $this->Html->Image('/images/products/'.$product->image, array('width' => 100, 'height' => 100, 'alt' =>$product->name, 'class' => 'image')); ?></td>
                <td><?php if($product->status==1){ echo "Active"; }else{ echo "Deactive"; } ?></td>
                <td><?= h($product->created) ?></td>
                <td class="actions">
                   <?= $this->Html->link(
                        '<span class="fa fa-eye"></span><span class="sr-only">' . __('View') . '</span>',
                        ['action' => 'view', $product->id],
                        ['escape' => false, 'title' => __('View'), 'class' => 'btn btn-info btn-xs']
                    ) ?> 
             
                    <?= $this->Html->link(
                        '<span class="fa fa-pencil"></span><span class="sr-only">' . __('Edit') . '</span>',
                        ['action' => 'edit', $product->id],
                        ['escape' => false, 'title' => __('Edit'), 'class' => 'btn btn-success btn-xs']
                    ) ?> 
                  
                     
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id),'class' => 'btn btn-danger btn-xs delt']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
     
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        
        
        
        </div>  
    </div>
</section>       