$(document).ready(function(){
	var open_notifications = false;
	
	$("#commentate").click(function(){
		$("textarea[name='edit-comment']").focus();
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
})