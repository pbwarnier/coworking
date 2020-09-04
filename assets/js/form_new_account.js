function changeColor(id){
	$("select[name='"+id+"']").removeClass('text-secondary').addClass('text-dark');
}

// first letter in upper case for first and lastname
function upperCase(string, name_input){
	string = string.substr(0, 1).toUpperCase() + string.substr(1, string.length).toLowerCase();
	$("input[name='"+name_input+"']").val(string);
}

function slideDown(id) {
	$("#"+id).slideDown();
	if (id == "check_passwords") {
	  	var input = $("input[name='password']");
	  	var compare = $("#confirm_password");
		var div = $("#check_passwords");
		var checked = $("#checked_info");
		// compare password values
	  	if (compare.val() != "" && input.val() == compare.val()) {
			checked.removeClass("invalid");
			checked.addClass("valid");
			checked.text("Les mots de passe correspondent");
		}
		else {
			checked.removeClass("valid");
			checked.addClass("invalid");
			checked.text("Les mots de passe ne correspondent pas"); 
		}
	}
}

function force() {
	// select value in input password
	var password = $("input[name='password']").val();
	var textForce = $("#force");
	var force = 0;
				
	// verifies that the password contains letters and numbers
	// if this is true the force incrementing
	if (password.match(/(?=.*[a-z])/) || password.match(/(?=.*[A-Z])/) || password.match(/(?=.*[0-9])/)) {
		force ++;
	}

	// verifies that the input value contains at least 1 digit and at least 4 characters
	if (password.match(/(?=.*[0-9])/) && password.length >= 4) {
		force ++;
	}

	// verifies that the value of the input contains special characters
	if (password.match(/(?=.*\W)/) && password.length >= 4) {
		force ++;
	}

	// verifies that the password is at least 8 characters long
	if (password.length >= 8) {
		force ++;
	}

	// couleur et texte en fonction de la force
	if (force == 1 || password == '') {
		var bgColor = '#dc3545';
		textForce.text('Faible');
	}
	else {
		if (force == 2) {
			var bgColor = '#ffc107';
			textForce.text('Moyen');
		}
		else{
			if (force == 3) {
				var bgColor = '#28a745';
				textForce.text('Fort');
			}
			else{
				if (force == 4) {
					var bgColor = '#0d6e25';
					textForce.text('Très fort');
				}
			}
		}
	}

	// change css of the progressbar
	$("#progress").css({
		'width': 25*force+'%',
		'background-color': bgColor
	});
}

function compare_passwords() {
	var input = $("#input_password");
	var compare = $("#confirm_password");
	var checked = $("#checked_info");
	if (compare.val() != "" && input.val() == compare.val()) {
		checked.removeClass("invalid");
		checked.addClass("valid");
		checked.text("Les mots de passe correspondent");
	}
	else {
		checked.removeClass("valid");
		checked.addClass("invalid");
		checked.text("Les mots de passe ne correspondent pas");
	}
}

function slideUp(id) {
	  $("#"+id).slideUp();
}

// auto-scroll from bottom
function scrollDown() {
	$('html, body').animate({scrollTop: $('#down').offset().top}, 1500);
	return false;
}

function next_step(number){
	if (number == "1") {
		$("#step1").addClass('d-none');
		$("#step2").removeClass('d-none');
	}
				
	if (number == "2") {
		$("#step2").addClass('d-none');
		$("#step3").removeClass('d-none');
	}
}

function last_step(number){
	if (number == "2") {
		$("#step2").addClass('d-none');
		$("#step1").removeClass('d-none');
	}
				
	if (number == "3") {
		$("#step3").addClass('d-none');
		$("#step2").removeClass('d-none');
	}
}

function checkbox(){
	if ($("#owner").is(':checked')) {
		$("#owner-result").text("Oui");
	}
	else {
		$("#owner-result").text("Non");
	}
}


function searchCity(zipcode){
	if (zipcode.length > 2) {
		$.ajax({
			url: '/coworking/controllers/search_city_controller.php',
			type: 'POST',
			data: { 'zipcode': zipcode }
		})
		.done(function(list_city){
			list_city = $.parseJSON(list_city);
			if (list_city != 0) {
				$("#error_search").remove();
				$("select[name='city']").removeAttr('disabled');
				$.each(list_city, function(key, value){
					console.log(value);
				})
			}
			else {
				$("#error_search").remove();
				$("select[name='city']").after('<div id="error_search" class="text-danger small">Auncun résultat trouvé pour '+zipcode+'</div>');
			}
		})
	}
	else {
		$("#error_search").remove();
		$("select[name='city']").attr('disabled', 'disabled');
	}
}

$(document).ready(function(){
	$('.carousel').carousel({
  		interval: 7000
	})	
})

$("input[name='postal_code']").keyup(function(){
	var zipcode = $(this).val();
	searchCity(zipcode);
}).on(function(){
	var zipcode = $(this).val();
	searchCity(zipcode);
})
	
	
$("#subscribe").click(function(event){
	// prevents page reloading
	event.preventDefault();
	var data = $("#subscribeForm").serialize();
	// get the form type and add it to the serialized chain
	data = data+encodeURI('&type='+$(this).data('target'));
	$.post('/coworking/controllers/form_new_account_controller.php', data, function(response){
		// drop element which have text-danger class
		$(".text-danger").remove();
		$("input").removeClass('border-danger').removeClass('invalid-shadow');
		$("select").removeClass('border-danger').removeClass('invalid-shadow');
		if (response.length != 0) {
			var nb_error = 1;
			// scan JSON for get key => value
			$.each(response, function(index, value){
				if (nb_error == 1) {
					// show the first step with error
					// closest remonte l’arborescence DOM jusqu’à ce qu’il trouve une correspondance pour le sélecteur fourni
					var div = $(`[name="${index}"]`).closest('.step');
					if (div.hasClass('d-none')) {
						$("#step3").addClass('d-none');
						div.removeClass('d-none');
					}
					nb_error++;
				}
				// write error box
				$(`[name="${index}"]`).after('<div id="'+index+'" class="text-danger small">'+value+'</div>');
				$(`[name="${index}"]`).val('');
				$(`[name="${index}"]`).addClass('invalid-shadow').addClass('border-danger');
			})
		}
		else{
			$("#subscribeForm").submit();
		}
	}, 'json')	
})