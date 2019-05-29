
<!-- Breadcrumb Start -->
<div class="bread-crumb">
  <div class="container">
    <div class="matter">
      <h2>Search</h2>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="<?php echo $this->request->webroot ?>">HOME</a></li>
        <li class="list-inline-item"><a href="#">Search</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="shop">
  <div class="container">
    <div class="row">
<?php if($ajax != 1): ?>

<?php $this->Html->addCrumb('Search'); ?>

<div class="container">
    
      <div class="col-sm-12">
	    <?= $this->Flash->render() ?> 
        <div class="fancy01">
          <h2>Search</h2>
        </div>
          </div>
    
<!--<h1>Search</h1>-->

<br />

<div class="row">

    <div class="container">
<?php echo $this->Form->create('Product', array('type' => 'GET')); ?>

<div class="col-sm-4 col-sm-offset-4">
   


 <div class="search-pg" >
  <div class="form-group">
     <?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'class' => 'form-control', 'autocomplete' => 'off', 'value' => $search)); ?>
   <?php echo $this->Form->button('Search', array('div' => false, 'class' => 'btn btn-theme btn-md btn-wide')); ?>
  </div>

  
</div> 
</div>


<?php echo $this->Form->end(); ?>

        </div>
        
</div>

</div><!--container-->
<br />
<br />

<?php endif; ?>


<?php $this->Html->addCrumb($search); ?>

	<!-- Product List Start -->
	<!-- Single Product Start -->
	<?php if(!empty($products)){
	 foreach ($products as $key => $value) {
	 
	?>
	<div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="product-thumb">
			<div class="image">
				<a class="link" href="<?php echo $this->request->webroot."products/view/".$value['slug']; ?>">
		<?php if($value['image']){ ?>
		<img src="<?php echo $this->request->webroot; ?>images/products/<?php echo $value['image']; ?>" alt="image" title="image" width="250" height="200"  />
		<?php }else{ ?>
		 <img src="<?php echo $this->request->webroot; ?>images/products/no-image.jpg" alt="image" title="image" width="250" height="200" />
		<?php }?>


				</a>
			
			</div>
			<div class="caption">
				<h4><?php echo $value['name']; ?></h4>
				<div class="rating">
		 <?php
		 $i= round($value['avg_rating']);
			
			for($j=0;$j<$i;$j++){
			?>
		  <i class="fa fa-star" aria-hidden="true"></i>
			
	 
			<?php } for($h=0;$h<5-$i;$h++){?>  
		  <i class="fa fa-star-o" aria-hidden="true"></i>
			<?php 
			
			}   
	 ?> 
					
				</div>
				<div class="price">Rs <?php echo $value['price']; ?></div>
				<p class="des"><?php echo $value['category']['name']; ?></p>
				<p><?php echo $value['description']; ?></p>
				<p><?php echo $this->Form->create(NULL, array('url' => array('controller'=>'restaurants','action' => 'addtocart'))); ?> 
				<?php echo $this->Form->control('id', array('type' => 'hidden', 'value' => $value['id'])); ?>  
						 
				<?php echo $this->Form->button('Add To Cart', array('class' => 'btn btn-theme btn-md','id' => $value['id']));?>
				<?php echo $this->Form->end(); ?></p>
			</div>
		</div>
	</div>
	<!-- Single Product End -->
	<?php } }else{
	echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/search-not-found.jpg" class="img-responsive"></div></div>';
	}	
    ?>
                 








</div>
</div>
</div>

