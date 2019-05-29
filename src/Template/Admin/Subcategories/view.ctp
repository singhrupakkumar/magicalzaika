<section class="content-header">
    <h1>
    <?= __('Sub categories') ?>
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i><?= __('Home') ?> </a></li>
        <li class="active"><?= __('View') ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-xs-12"> 
        
        
        <div class="box">
  <div class="box-header">
    <h3 class="box-title"><?= h($subcategories->name) ?></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tbody>
  
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subcategories->name) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h(strip_tags($subcategories->description)) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?=  $this->Number->format($subcategories->id) ?></td>
        </tr>
  
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subcategories->created) ?></td>
        </tr>
        <tr>
          <th><?= __('Image') ?></th>
          <td>
            <?php if($subcategories->image != ''){ ?>
            <img src="<?php echo $this->request->webroot; ?>images/categories/<?php echo $subcategories->image; ?>" style="width: 190px; margin-bottom: 20px;
            " class="previewHolder"/>
            <?php }else{ ?>
            <img src="<?php echo $this->request->webroot; ?>images/categories/no-image.jpg" style="width: 190px; margin-bottom: 20px;
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