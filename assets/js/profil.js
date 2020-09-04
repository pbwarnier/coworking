$(document).ready(function(){
	var open_notifications = false;
	
	$("#notifications").click(function(){
		if (open_notifications == false) {
			$("#notifications").parent().addClass('active');
			$("#drop-notifications").dropdown('show');
			open_notifications = true;
		}
		else{
			$("#notifications").parent().removeClass('active');
			$("#drop-notifications").dropdown("hide");
			open_notifications = false;
		}
	})
})

$(window).resize(function(){
	
})

function zoom(){
	$("#zoom").fadeIn('fast');
}

function closing_zoom(){
	$("#zoom").fadeOut('fast');
}