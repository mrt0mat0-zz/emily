$(document).ready(function(){
	$('#company_id').change(function(){
		$.get('/companies/'+ $(this).val() + '/users', function(data){
			if(data.length){
				$('#primary_user_id').find('option').remove().end();
				jQuery.each(data, function(i,val){
					$('#primary_user_id').append("<option value="+i+">"+val+"</option>");
				});
			}else{
				console.log('no data');
			}
		});
	});
	
});


