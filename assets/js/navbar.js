$(document).ready(function() {
	var open_notifications = false;
	var openNav = false;
	
	$("#btn_slideNav").click(function(){
		if (openNav == false) {
			$("#slideNav").css('width', '100%');
			openNav = true;
		}
		else {
			$("#slideNav").css('width', '0');
			openNav = false;
		}
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