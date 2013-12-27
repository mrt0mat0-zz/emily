$(document).ready(function(){
	$('.confirm').on('click',function(e){
		e.preventDefault();
		if(confirm("Are you sure?")){
			$('#delete').submit();
		}
	});
	
	$('#menu_locations').chosen().change(function(){
		var locs = parseInt($(this).val());
		$.post('/locations/change',{locations : locs},function(){
			location.reload(true);
		});
	});
	
	$('#menu_companies').chosen().change(function(){
		var companies = $(this).val();
		$.post('/companies/change',{companies : companies},function(){
			location.reload(true);
		});
	});
	
});
