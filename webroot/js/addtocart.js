jQuery(document).ready(function () {
  var BaseUrl = '';
  var protocol = window.location.protocol ;
  if(window.location.host == 'localhost'){
    BaseUrl = protocol +'//'+window.location.host+'/2018/restaurant/';
  }else{
     BaseUrl = protocol +'//'+window.location.host+'/';
  }


  $.getJSON(BaseUrl+"restaurants/webdisplaycart", function (data) { 

 jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){     
  myvar += '<a href="'+BaseUrl+'restaurants"><img src="'+BaseUrl+'images/empty-cart-icon-1.jpg" alt="img" /></a>';   
 }else{


var myvar = '<h2>You have <span>'+data['data']['cartcount']+' items</span> in your order.</h2><div class="table-responsive-md"><table class="table table-bordered">'+
'    <thead>'+
'        <tr>'+
'            <th class="text-center">Name</th>'+
'            <th class="text-center">Plate</th>'+
'            <th class="text-center">Price</th>'+
'            <th class="text-center">Qty.</th>'+
'            <th class="text-center">Total</th>'+
' <th class="text-center">Action</th>'+
'        </tr>'+
'    </thead>'+
'    <tbody>';
$.each(data['data']['products'], function (index, value) {       
    var str = value.product.description; 
    var price_two = value.product.price_two; 
   
	var platetype = value.plate;
        var checkedfull = "";
        var checkedhalf = "";
	if(platetype=='full'){
            checkedfull = "checked";
        }else if(platetype=='half'){
            checkedhalf = "checked";
        }else{
            checkedhalf = "";
            checkedfull = "";
        }
myvar += '   <tr>'+
'            <td>'+
'             <a href="'+BaseUrl+'products/view/'+value.product.slug+'"><img src="'+ value.product.image +'" with="80" height="80"></a>'+
'             <div class="name">'+
'                <h4>'+ value.product.name +'</h4>'+
'            </div>'+
'        </td>';
   if(price_two>0){
myvar +='<td>\n\
<div class="form-group">'+
'             <label>Full</label>'+
'                <input '+checkedfull+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="full-'+ value.product.id +'" value="full-'+ value.product.id +'">'+
'            </div>'+
'             <div class="form-group">'+
'             <label>Half</label>'+
'                <input '+checkedhalf+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="half-'+ value.product.id +'" value="half-'+ value.product.id +'">'+
'            </div>'+
'        </td>';
   }else{
      myvar +='<td>&nbsp;</td>';
   }
        
myvar +='        <td class="text-center">Rs '+ value.price +'</td>'+
'        <td class="text-center">'+
'            <p class="qtypara">'+
'                <span id="minus1" class="minus"><i id="'+value.product.id+'" class="icofont icofont-minus cmins"></i></span>'+
'                <input type="text" name="quantity" value="'+ value.quantity +'" size="2" id="input-quantity1" class="form-control qty" />'+
'                <span id="add1" class="add"><i id="'+value.product.id+'" class="icofont icofont-plus cplus"></i></span>'+
'                <input type="hidden" name="product_id" value="1" />'+
'            </p>'+
'        </td>'+
'        <td class="text-center">Rs '+ value.quantity*value.price +'</td>'+
'        <td class="text-center">'+
'            <span><i class="icofont icofont-close-line remove_item" id=' + value.product.id + '></i></span>'+
'        </td>'+
'    </tr> ';

 
	if(value.plate =='full'){
	$('#full-'+ value.product.id).attr('checked', 'checked');
	}else{
	$('#half-'+ value.product.id).attr('checked', 'checked');	
	}
 }); 
myvar += '    <tr>'+
'        <td colspan="6">'+ 
'            <h3 class="text-right">SUBTOTAL - Rs '+data['data']['cartInfo']['total']+'</h3>'+
'            <div class="buttons float-left">'+
'                <a href="'+BaseUrl+'restaurants" class="btn btn-theme btn-md btn-wide">Continue Shopping</a>'+
'            </div>'+
'            <div class="buttons float-right">'+
'                <a href="'+BaseUrl+'restaurants/checkout" class="btn btn-theme btn-md btn-wide">Checkout</a>'+
'            </div>'+
'        </td>'+
'    </tr>'+
'</tbody>'+
'</table></div>';
  
 } 
  $('#tab-cart').html(myvar);   
 
        rmv();
        //$('#total_items').delay(2000).fadeIn('slow');
    });
    
    
    function rmv() {
		$(function () {
		jQuery(document).on("click", ".remove_item", function() {		

            var cartid = jQuery(this).attr("id") ;
      
                    swal({
                      title: "Are you sure?",
                      text: "You want to delete this item!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Yes, delete it!",
                      cancelButtonText: "No, cancel please!",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm) {
                      if (isConfirm) {
                          
                          jQuery.ajax({
                type: "POST",
                url: BaseUrl+"restaurants/webremoveitems",  
                data: {
                    id: cartid
                },
                dataType: "json",
                success: function (data) { 
                    
                swal("Deleted!", "Your item has been deleted.", "success");
 jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<a href="'+BaseUrl+'restaurants"><img src="'+BaseUrl+'images/empty-cart-icon-1.jpg" alt="img" /></a>'; 
 }else{


var myvar = '<h2>You have <span>'+data['data']['cartcount']+' items</span> in your order.</h2><div class="table-responsive-md"><table class="table table-bordered">'+
'    <thead>'+
'        <tr>'+
'            <th class="text-center">Name</th>'+
'            <th class="text-center">Plate</th>'+
'            <th class="text-center">Price</th>'+
'            <th class="text-center">Qty.</th>'+
'            <th class="text-center">Total</th>'+
' <th class="text-center">Action</th>'+
'        </tr>'+
'    </thead>'+
'    <tbody>';
$.each(data['data']['products'], function (index, value) {      
    var str = value.product.description; 
    var price_two = value.product.price_two; 
	var platetype = value.plate;
        var checkedfull = "";
        var checkedhalf = "";
	if(platetype=='full'){
            checkedfull = "checked";
        }else if(platetype=='half'){
            checkedhalf = "checked";
        }else{
            checkedhalf = "";
            checkedfull = "";
        }
myvar += '   <tr>'+
'            <td>'+
'             <a href="'+BaseUrl+'products/view/'+value.product.slug+'"><img src="'+ value.product.image +'" with="80" height="80"></a>'+
'             <div class="name">'+
'                <h4>'+ value.product.name +'</h4>'+
'            </div>'+
'        </td>';
if(price_two>0){
myvar += '<td>\n\
            <div class="form-group">'+
'             <label>Full</label>'+
'                <input '+checkedfull+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="full-'+ value.product.id +'" value="full-'+ value.product.id +'">'+
'            </div>'+
'             <div class="form-group">'+
'             <label>Half</label>'+
'                <input '+checkedhalf+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="half-'+ value.product.id +'" value="half-'+ value.product.id +'">'+
'            </div>'+
'        </td>';
}else{
    myvar += '<td>&nbsp;</td>';
}
myvar += '        <td class="text-center">Rs '+ value.price +'</td>'+
'        <td class="text-center">'+
'            <p class="qtypara">'+
'                <span id="minus1" class="minus"><i id="'+value.product.id+'" class="icofont icofont-minus cmins"></i></span>'+
'                <input type="text" name="quantity" value="'+ value.quantity +'" size="2" id="input-quantity1" class="form-control qty" />'+
'                <span id="add1" class="add"><i id="'+value.product.id+'" class="icofont icofont-plus cplus"></i></span>'+
'                <input type="hidden" name="product_id" value="1" />'+
'            </p>'+
'        </td>'+
'        <td class="text-center">Rs '+ value.quantity*value.price +'</td>'+
'        <td class="text-center">'+
'            <span><i class="icofont icofont-close-line remove_item" id=' + value.product.id + '></i></span>'+
'        </td>'+
'    </tr> ';
	if(value.plate =='full'){
	$('#full-'+ value.product.id).attr('checked', 'checked');
	}else{
	$('#half-'+ value.product.id).attr('checked', 'checked');	
	}
 }); 
myvar += '    <tr>'+
'        <td colspan="6">'+
'            <h3 class="text-right">SUBTOTAL - Rs '+data['data']['cartInfo']['total']+'</h3>'+
'            <div class="buttons float-left">'+
'                <a href="'+BaseUrl+'restaurants" class="btn btn-theme btn-md btn-wide">Continue Shopping</a>'+
'            </div>'+
'            <div class="buttons float-right">'+
'                <a href="'+BaseUrl+'restaurants/checkout"  class="btn btn-theme btn-md btn-wide">Checkout</a>'+
'            </div>'+
'        </td>'+
'    </tr>'+
'</tbody>'+
'</table></div>';
  
 } 
  $('#tab-cart').html(myvar);    
 
        rmv();
                },
                error: function () { 
                      swal("Deleted!", "Something worng!.", "error");
                }
            });
                        
                        
                        
                        
                        
                        
                      } else {
                          swal("Cancelled", "Your item is safe :)", "error");
                      }
                    });
            
            
          
            return false;
        });
		});
        
        
   /*****************Increase Decrease**********************/  
   
   jQuery('.cplus').off("click").on('click', function () {
            jQuery.ajax({
                type: "POST",
                url: BaseUrl+"restaurants/cartincreaseqty", 
                data: { 
                    id:jQuery(this).attr("id"),
                },
                dataType: "json",
                success: function (data) { 

              jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<a href="'+BaseUrl+'restaurants"><img src="'+BaseUrl+'images/empty-cart-icon-1.jpg" alt="img" /></a>'; 
 }else{


var myvar = '<h2>You have <span>'+data['data']['cartcount']+' items</span> in your order.</h2><div class="table-responsive-md"><table class="table table-bordered">'+
'    <thead>'+
'        <tr>'+
'            <th class="text-center">Name</th>'+
'            <th class="text-center">Plate</th>'+
'            <th class="text-center">Price</th>'+
'            <th class="text-center">Qty.</th>'+
'            <th class="text-center">Total</th>'+
' <th class="text-center">Action</th>'+
'        </tr>'+
'    </thead>'+
'    <tbody>';
$.each(data['data']['products'], function (index, value) {    
    var str = value.product.description;  
    var price_two = value.product.price_two;  
		if(value.plate =='full'){
	$('#full-'+ value.product.id).attr('checked', 'checked');
	}else{
	$('#half-'+ value.product.id).attr('checked', 'checked');	
	}
        
        var platetype = value.plate;
        var checkedfull = "";
        var checkedhalf = "";
	if(platetype=='full'){
            checkedfull = "checked";
        }else if(platetype=='half'){
            checkedhalf = "checked";
        }else{
            checkedhalf = "";
            checkedfull = "";
        }
        
myvar += '   <tr>'+
'            <td>'+
'             <a href="'+BaseUrl+'products/view/'+value.product.slug+'"><img src="'+ value.product.image +'" with="80" height="80"></a>'+
'             <div class="name">'+
'                <h4>'+ value.product.name +'</h4>'+
'            </div>'+
'        </td>';
   if(price_two>0){
myvar +='<td>\n\
<div class="form-group">'+
'             <label>Full</label>'+
'                <input '+checkedfull+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="full-'+ value.product.id +'" value="full-'+ value.product.id +'">'+
'            </div>'+
'             <div class="form-group">'+
'             <label>Half</label>'+
'                <input '+checkedhalf+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="half-'+ value.product.id +'" value="half-'+ value.product.id +'">'+
'            </div>'+
'        </td>';
   }else{
      myvar +='<td>&nbsp;</td>';
   }
        
myvar +='<td class="text-center">Rs '+ value.price +'</td>'+
'        <td class="text-center">'+
'            <p class="qtypara">'+
'                <span id="minus1" class="minus"><i id="'+value.product.id+'" class="icofont icofont-minus cmins"></i></span>'+
'                <input type="text" name="quantity" value="'+ value.quantity +'" size="2" id="input-quantity1" class="form-control qty" />'+
'                <span id="add1" class="add"><i id="'+value.product.id+'" class="icofont icofont-plus cplus"></i></span>'+
'                <p class="stock" style="color:red;"></p>'+
'            </p>'+
'        </td>'+
'        <td class="text-center">Rs '+ value.quantity*value.price +'</td>'+
'        <td class="text-center">'+
'            <span><i class="icofont icofont-close-line remove_item" id=' + value.product.id + '></i></span>'+
'        </td>'+
'    </tr> ';
 }); 
myvar += '    <tr>'+
'        <td colspan="6">'+
'            <h3 class="text-right">SUBTOTAL - Rs '+data['data']['cartInfo']['total']+'</h3>'+
'            <div class="buttons float-left">'+
'                <a href="'+BaseUrl+'restaurants" class="btn btn-theme btn-md btn-wide">Continue Shopping</a>'+
'            </div>'+
'            <div class="buttons float-right">'+
'                <a href="'+BaseUrl+'restaurants/checkout"  class="btn btn-theme btn-md btn-wide">Checkout</a>'+  
'            </div>'+
'        </td>'+
'    </tr>'+
'</tbody>'+
'</table></div>';
  
 } 
  $('#tab-cart').html(myvar);     
  jQuery('.stock').html(data.msg);   
        rmv();
                },
                error: function () {
                    console.log('Error!');    
                }
            });
            return false;
        });
		
		
		
        jQuery('.cmins').off("click").on('click', function () { 
            jQuery.ajax({
                type: "POST",    
                url: BaseUrl+"restaurants/cartdecreaseqty",         
                data: { 
                   id:jQuery(this).attr("id"), 
                },
                dataType: "json",
                success: function (data) {
     
               jQuery('#cartcount').html(data['data']['cartcount']); 
                
  var myvar = '';  
 if(data['data']['cartcount'] == "0"){    
  myvar += '<a href="'+BaseUrl+'restaurants"><img src="'+BaseUrl+'images/empty-cart-icon-1.jpg" alt="img" /></a>';  
 }else{


var myvar = '<h2>You have <span>'+data['data']['cartcount']+' items</span> in your order.</h2><div class="table-responsive-md"><table class="table table-bordered">'+
'    <thead>'+
'        <tr>'+
'            <th class="text-center">Name</th>'+
'            <th class="text-center">Plate</th>'+
'            <th class="text-center">Price</th>'+
'            <th class="text-center">Qty.</th>'+
'            <th class="text-center">Total</th>'+
' <th class="text-center">Action</th>'+
'        </tr>'+
'    </thead>'+
'    <tbody>';
$.each(data['data']['products'], function (index, value) {       
    var str = value.product.description;
    var price_two = value.product.price_two;
	if(value.plate =='full'){
	$('#full-'+ value.product.id).attr('checked', 'checked');
	}else{
	$('#half-'+ value.product.id).attr('checked', 'checked');	
	}	
        
        
        var platetype = value.plate;
        var checkedfull = "";
        var checkedhalf = "";
	if(platetype=='full'){
            checkedfull = "checked";
        }else if(platetype=='half'){
            checkedhalf = "checked";
        }else{
            checkedhalf = "";
            checkedfull = "";
        }
        
        
myvar += '   <tr>'+
'            <td>'+
'             <a href="'+BaseUrl+'products/view/'+value.product.slug+'"><img src="'+ value.product.image +'" with="80" height="80"></a>'+
'             <div class="name">'+
'                <h4>'+ value.product.name +'</h4>'+ 
'            </div>'+
'        </td>';
if(price_two>0){
myvar +='<td>\n\
<div class="form-group">'+
'             <label>Full</label>'+
'                <input '+checkedfull+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="full-'+ value.product.id +'" value="full-'+ value.product.id +'">'+
'            </div>'+
'             <div class="form-group">'+
'             <label>Half</label>'+
'                <input '+checkedhalf+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="half-'+ value.product.id +'" value="half-'+ value.product.id +'">'+
'            </div>'+
'        </td>';
   }else{
      myvar +='<td>&nbsp;</td>';
   }
        
myvar +='<td class="text-center">Rs '+ value.price +'</td>'+
'        <td class="text-center">'+
'            <p class="qtypara">'+
'                <span id="minus1" class="minus"><i id="'+value.product.id+'" class="icofont icofont-minus cmins"></i></span>'+
'                <input type="text" name="quantity" value="'+ value.quantity +'" size="2" id="input-quantity1" class="form-control qty" />'+
'                <span id="add1" class="add"><i id="'+value.product.id+'" class="icofont icofont-plus cplus"></i></span>'+
'                <p class="stock" style="color:red;"></p>'+
'            </p>'+
'        </td>'+
'        <td class="text-center">Rs '+ value.quantity*value.price +'</td>'+
'        <td class="text-center">'+
'            <span><i class="icofont icofont-close-line remove_item" id=' + value.product.id + '></i></span>'+
'        </td>'+
'    </tr> ';
 }); 
myvar += '    <tr>'+
'        <td colspan="6">'+
'            <h3 class="text-right">SUBTOTAL - Rs '+data['data']['cartInfo']['total']+'</h3>'+
'            <div class="buttons float-left">'+
'                <a href="'+BaseUrl+'restaurants" class="btn btn-theme btn-md btn-wide">Continue Shopping</a>'+
'            </div>'+
'            <div class="buttons float-right">'+
'                <a href="'+BaseUrl+'restaurants/checkout" class="btn btn-theme btn-md btn-wide">Checkout</a>'+
'            </div>'+
'        </td>'+
'    </tr>'+
'</tbody>'+
'</table></div>';   
  
 } 
  $('#tab-cart').html(myvar);      
   jQuery('.stock').html(data.msg); 
        rmv();      
                },
                error: function () {
                    console.log('Error!');   
                }
            });
            return false;  
        });
       
        


      /*****************Full Half**********************/  
   
   jQuery('.platerate').on('click', function () {
       var pdata= jQuery(this).val();
      
	   $("#"+pdata).attr('checked','true');
            jQuery.ajax({
                type: "POST",
                url: BaseUrl+"restaurants/platerate", 
                data: {  
                    pdata:pdata
                },
                dataType: "json",
                success: function (data) { 

              jQuery('#cartcount').html(data['data']['cartcount']); 
  var myvar = '';
 if(data['data']['cartcount'] == "0"){    
  myvar += '<a href="'+BaseUrl+'restaurants"><img src="'+BaseUrl+'images/empty-cart-icon-1.jpg" alt="img" /></a>'; 
 }else{


var myvar = '<h2>You have <span>'+data['data']['cartcount']+' items</span> in your order.</h2><div class="table-responsive-md"><table class="table table-bordered">'+
'    <thead>'+
'        <tr>'+
'            <th class="text-center">Name</th>'+
'            <th class="text-center">Plate</th>'+
'            <th class="text-center">Price</th>'+
'            <th class="text-center">Qty.</th>'+
'            <th class="text-center">Total</th>'+
' <th class="text-center">Action</th>'+
'        </tr>'+
'    </thead>'+
'    <tbody>';
$.each(data['data']['products'], function (index, value) {    
    var str = value.product.description;
    var price_two = value.product.price_two;
    var platetype = value.plate;
        var checkedfull = "";
        var checkedhalf = "";
	if(platetype=='full'){
            checkedfull = "checked";
        }else if(platetype=='half'){
            checkedhalf = "checked";
        }else{
            checkedhalf = "";
            checkedfull = "";
        }
myvar += '   <tr>'+
'            <td>'+
'             <a href="'+BaseUrl+'products/view/'+value.product.slug+'"><img src="'+ value.product.image +'" with="80" height="80"></a>'+
'             <div class="name">'+
'                <h4>'+ value.product.name +'</h4>'+
'            </div>'+
'        </td>';
if(price_two>0){
myvar +='<td>\n\
<div class="form-group">'+
'             <label>Full</label>'+
'                <input '+checkedfull+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="full-'+ value.product.id +'" value="full-'+ value.product.id +'">'+
'            </div>'+
'             <div class="form-group">'+
'             <label>Half</label>'+
'                <input '+checkedhalf+' type="radio" class="platerate" name="plate'+ value.product.id +'" id="half-'+ value.product.id +'" value="half-'+ value.product.id +'">'+
'            </div>'+
'        </td>';
   }else{
      myvar +='<td>&nbsp;</td>';
   }
        
myvar +='<td class="text-center">Rs '+ value.price +'</td>'+
'        <td class="text-center">'+
'            <p class="qtypara">'+
'                <span id="minus1" class="minus"><i id="'+value.product.id+'" class="icofont icofont-minus cmins"></i></span>'+
'                <input type="text" name="quantity" value="'+ value.quantity +'" size="2" id="input-quantity1" class="form-control qty" />'+
'                <span id="add1" class="add"><i id="'+value.product.id+'" class="icofont icofont-plus cplus"></i></span>'+
'                <p class="stock" style="color:red;"></p>'+
'            </p>'+
'        </td>'+
'        <td class="text-center">Rs '+ value.quantity*value.price +'</td>'+
'        <td class="text-center">'+
'            <span><i class="icofont icofont-close-line remove_item" id=' + value.product.id + '></i></span>'+
'        </td>'+
'    </tr> ';

	if(value.plate =='full'){
	$('#full-'+ value.product.id).attr('checked', 'checked');
	}else{
	$('#half-'+ value.product.id).attr('checked', 'checked');	
	}
 }); 
myvar += '    <tr>'+
'        <td colspan="6">'+
'            <h3 class="text-right">SUBTOTAL - Rs '+data['data']['cartInfo']['total']+'</h3>'+
'            <div class="buttons float-left">'+
'                <a href="'+BaseUrl+'restaurants" class="btn btn-theme btn-md btn-wide">Continue Shopping</a>'+
'            </div>'+
'            <div class="buttons float-right">'+
'                <a href="'+BaseUrl+'restaurants/checkout"  class="btn btn-theme btn-md btn-wide">Checkout</a>'+  
'            </div>'+
'        </td>'+
'    </tr>'+
'</tbody>'+
'</table></div>';
  
 } 
  $('#tab-cart').html(myvar);     
  jQuery('.stock').html(data.msg);   
        rmv();
                },
                error: function () {
                    console.log('Error!');    
                }
            });
            return false;
        });   
        
        
        
               
               
        
       
    }       
    
  
  
      
});        