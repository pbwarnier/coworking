$(document).ready(function() {
	var open_notifications = false;
	
	$("#open_slideNav").click(function(){
		$("#slideNav").css('width', '100%');
	})

	$(".close_nav").click(function(){
		$("#slideNav").css('width', '0');
	})

	$("#notifications").click(function(){
		if (open_notifications == false) {
			$("#notifications").parent().addClass('active');
			$("#drop-notifications").dropdown('show');
			open_notifications = true;
		}
		else{
			$("#notifications").parent().removeClass('active');
			$("#drop-notifications").dropdown('hide');
			open_notifications = false;
		}
	})
});