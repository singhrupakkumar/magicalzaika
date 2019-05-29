<section class="content-header">
    <h1>
    Product
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View</li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($product->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?=  $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($product->category->name) ?></td>
        </tr>

         <!--<tr>
            <th scope="row"><?//= __('Sub Category') ?></th>
            <td><?//= h($product->subcategory->name) ?></td>
        </tr>-->
        <tr>
            <th scope="row"><?= __('Restaurant') ?></th> 
            <td><?= h($product->restaurant->name) ?></td>
        </tr>
        
    
         <tr>
            <th scope="row"><?= __('Price') ?></th> 
            <td>Rs <?= h($product->price) ?></td>
        </tr>
		
		<tr>
            <th scope="row"><?= __('Price Two') ?></th> 
            <td>Rs <?= h($product->price_two) ?></td>
        </tr>
     
        
  
    
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
     
        <tr>
          <th><?= __('Image') ?></th>
          <td>
            <?php if($product->image != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $product->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php } ?>
          </td>
        </tr>
  
      </tbody>  
    </table>
  </div>
  <!-- /.box-body -->
</div>

        
        
        
        </div>
    </div>
</section>       