$(document).ready(function(){

	//hide the table until it is used
	$('#invoice_table').hide();
	$("#customer_id").chosen({width: "100%"});
	$("#product_id").chosen({width: "100%"});
	
	$('#new_customer').click(function(){
			$('#new_customer_container').toggle(500).toggleClass('hidden');
			$('#customer_id').val(0);
	});
	
	$('#new_product').click(function(){
		$('#new_product_container').toggle(500).toggleClass('hidden');
		$('#product_id').val(0);
	});
	
	$('#customer_submit').click(function(e){
		$('#alert-customer').remove();
		e.preventDefault();
		$.post('/customers',$('#new_customer_container :input').serialize(), function(data){
			if(data %1 ===0){
				getCustomers($('#location_id').val(), data);
				$('#new_customer_container').toggle(500).toggleClass('hidden');
			}else{
				var errorMessage = "";
				jQuery.each(data.errors, function(i,val){
					errorMessage += val + "<br/>";
				});
				$("#new_customer_container").prepend("<div id='alert-customer' class='alert alert-danger'>" + errorMessage + "</div>");
			}
		});
	});
	
	$('#product_submit').click(function(e){
		$('#alert-product').remove();
		e.preventDefault();
		$.post('/products',$('#new_product_container :input').serialize(), function(data){
			if(data %1 ===0){
				getProducts($('#location_id').val(), data);
				getProduct(data);
				$('#new_product_container').toggle(500).toggleClass('hidden');
			}else{
				var errorMessage = "";
				jQuery.each(data.errors, function(i,val){
					errorMessage += val + "<br/>";
				});
				$("#new_product_container").prepend("<div id='alert-product' class='alert alert-danger'>" + errorMessage + "</div>");
			}
		});
	});
	
	//validates and submits
	$('#submit').click(function(){
		$('#new_customer_container, #new_product_container').remove();
		if(!($('#invoice_table tr').size()-1)){
			alert('No items added to Invoice');
			return false;
		}else if(!$('#po_number').val()){
			alert('PO Number must be populated');
			return false;
		}else if($('#customer_id').val() == 0){
			alert('Customer must be selected');
			return false;
		}else{
			$('#invoice_form').delay(499).submit();
			
		}
	});
	
	//get's the exempt state of the customer
	$("#customer_id").change(function(){
		if($(this).val() == 999999999){
			$('#new_customer_container').toggle(500).toggleClass('hidden');
		}else{
			$.get('/customers/'+$(this).val()+'/exempt', function(data){
				$('#tax_exempt').val(data);
			});
		}
		
	});
	
	$('#product_id').change(function(){
		if($(this).val() == 999999999){
			$('#new_product_container').toggle(500).toggleClass('hidden');
		}else{
			getProduct($(this).val());
		}
	});
	
	$('#quantity, #price').keyup(function(){
		var intRegex = /^[\d]{0,7}[\.]{0,1}[\d]{0,2}$/;
		if(intRegex.test($(this).val())) {
			var subtotal = $('#quantity').val() * $('#price').val();
			$('#subtotal').val(subtotal.toFixed(2));
		}else{
			$(this).val(''); 
		}
	});
	
	$('#add').click(function(e){
		e.preventDefault();
		if($('#quantity').val().length !== 0){
			addProduct();
		}
	});
	
	$("#shipping, #discount").keyup(function(e){
		var intRegex = /^[\d]+[.]*[\d]{0,2}$/;
		if(!intRegex.test($(this).val())) {
			$(this).val('0');
		}
		calcTotals();
	}).focus(function(){
		if($(this).val() == '0.00'){
			$(this).val('');
		}
	}).blur(function(){
		if($(this).val() == ''){
			$(this).val('0.00');
		}
	});
});
	
function getCustomers(location_id, id){
        $('#customer_id').find('option').remove().end();
        $.get('/locations/'+location_id+'/customers', function(data){
                jQuery.each(data, function(i,val){
                        if(i == id){
                                $('#customer_id').append("<option selected=selected value="+i+">"+val+"</option>");
                        }else{	
                                $('#customer_id').append("<option value="+i+">"+val+"</option>");
                        }
                });
                $('#customer_id').trigger("liszt:updated");
        });

}

function getProduct(product_id){
        $.get('/locations/'+$('#location_id').val()+'/products/'+product_id, function(data){
                $('#price').val(data.price);
                $('#taxable').val(data.taxable);
                $('#item_shipping').val(data.shipping);
        });
        $('#quantity, #subtotal').val('');
}

function getProducts(location_id, id){
        $('#product_id').find('option').remove().end();
        $.get('/locations/'+location_id+'/products', function(data){
                jQuery.each(data, function(i,val){
                        if(id == i){
                                $('#product_id').append("<option selected=selected value="+i+">"+val+"</option>");
                        }else{
                                $('#product_id').append("<option value="+i+">"+val+"</option>");
                        }
                });
                $('#product_id').trigger("liszt:updated");
        });
}

function addProduct(product_id, product_name, quantity, taxable, shipping, price, subtotal){
        var count = $('#count').val();
        var product_id = product_id?product_id:$('#product_id').val();
        var product_name = product_name?product_name:$("#product_id option:selected").html();
        var quantity = quantity?quantity:$('#quantity').val();
        var taxable = taxable?taxable:$('#taxable').val();
        var shipping = shipping?shipping:$('#item_shipping').val();
        if(!product_id || quantity === '0'){
                return;
        }
        var price = price?price:$('#price').val();
        var subtotal = subtotal?subtotal:$('#subtotal').val();
        var remove = $('<td><button class="remove btn btn-default btn-small padding">Remove</button></td>');
        var product_td = $('<td><input type=hidden name=invoice_products['+count+'][product_id] value="'+product_id+'" />'+product_name+'</td>');
        var quantity_td = $('<td><input type=hidden name=invoice_products['+count+'][quantity] value='+quantity+' />'+quantity+'</td>');
        var price_td = $('<td><input type=hidden class=taxable value='+ taxable +' /><input type=hidden name=invoice_products['+count+'][price] value='+Number(price).toFixed(2)+' />'+ Number(price).toFixed(2) +'</td>');
        var shipping_td = $('<td><input type=hidden class=item_shipping name=invoice_products['+count+'][shipping] value='+Number(shipping * quantity).toFixed(2)+' />'+ Number(shipping * quantity).toFixed(2) +'</td>');
        var subtotal_td = $('<td class="subtotal text-right">'+ Number(subtotal).toFixed(2) +'</td>');
        row = $('<tr class=table_row style="display:none;"></tr>').append(remove).append(product_td).append(quantity_td).append(price_td).append(shipping_td).append(subtotal_td);
        $('#invoice_table').append(row).show('slow');
        $('.table_row').show('slow');
        $('.remove').click(removeProduct);
        count++;
        $('#count').val(count);
        $('#quantity, #subtotal, #price, #item_shipping').val('');
        $('#product_id').val(0);
        calcShipping();
        calcTotals();
}

function removeProduct(){
        $(this).closest('tr').remove();
        calcTotals();
        return false;
}

function calcTotals(){
        //getTaxes
        var taxes = 0;
        if($('#tax_exempt').val() == 0){
                $('#invoice_table tr').each(function(){
                        if($(this).find('.taxable').val()){
                                taxes += ($(this).find('.taxable').val() * $('#tax').val() * $(this).find('.subtotal').text() * .01);
                        }
                });
        }
        $('#total_tax').text(taxes.toFixed(2));
        $('#total_tax_hidden').val(taxes.toFixed(2));

        //getTotal with tax
        var total = 0;
        $('.subtotal').each(function(){
                total += parseFloat($(this).text());
        });
        total += taxes - parseFloat($("#discount").val()) + parseFloat($("#shipping").val());
        $('#total').text(total.toFixed(2));
        $('#total_hidden').val(total.toFixed(2));
}

function calcShipping(){
        var shipping = 0;
        $('#invoice_table tr .item_shipping').each(function(){
                item_shipping = $(this).val();
                shipping += parseFloat(item_shipping);
        });

        $("#shipping").val(shipping.toFixed(2));
}



