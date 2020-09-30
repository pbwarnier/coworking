$(document).ready(function(){
	$("input[name='firstname'], input[name='lastname']").keyup(function(){
		var string = $(this).val();
		string = string.substr(0, 1).toUpperCase() + string.substr(1, string.length).toLowerCase();
		$(this).val(string);
	})

	$("#birthdate").datepicker({
	    format: "dd/mm/yyyy",
	    maxViewMode: 3,
	    language: "fr",
	    daysOfWeekHighlighted: "0,6",
	    autoclose: true,
	    todayHighlight: true,
	    toggleActive: true,
	    endDate: "now"
	});

	var nb = $("#progress").data('progress');
	if (nb < 5) {
		var compteur = 0;
	}
	else{
		var compteur = nb - 5;
	}

	var time = 100
	increment(nb, compteur, time);

	$("button[name='add_skill']").click(function(){
		$(this).before('<div id="newSkill" class="my-1 d-inline-block"><input id="skill_name" class="my-md-0 my-2 mr-2 px-3 py-2 d-inline-block rounded-pill form-control" name="skill_name" maxlenght="50" style="max-width: 200px;"></div>')
		$(this).removeClass('d-inline-block').addClass('d-none');
		$("input[name='skill_name']").focus();
	})

	$("body").on('blur', 'input[name="skill_name"]', function(){
		var skill = $(this).val();
		if (skill.length > 0) {
			$.post('controllers/my_account_controller.php', { skillName: skill }, function(response){
				response = JSON.parse(response);
				if (response.insertSuccess == 1) {
					$("#newSkill").replaceWith('<div id="skill_'+response.lastId+'" class="my-1 mr-2 px-3 py-2 rounded bg-info d-inline-block text-light rounded-pill">'+response.skill_name+'<button class="ml-2 px-1 py-0 border-0 bg-info text-light rounded" name="removeSkill" data-skill="'+response.lastId+'">&times;</button></div>');
					$("button[name='add_skill']").removeClass('d-none').addClass('d-inline-block');
				}
				else{
					alert("Une erreur est survenue, contactez l'administrateur");
				}
			})
		}
		else{
			$("#newSkill").remove();
			$("button[name='add_skill']").removeClass('d-none').addClass('d-inline-block');
		}
	}).on('keypress', 'input[name="skill_name"]', function(event){
		var skill = $(this).val();
		if (event.which == 13 && skill.length > 0){
	    	event.preventDefault();
	    	$(this).blur();
	    }
	})

	$("body").on('click', 'button[name="removeSkill"]', function(){
		var skill_id = $(this).attr('data-skill');
		$.post('controllers/my_account_controller.php', { skill_id: skill_id }, function(response){
			if (response == 1) {
				$("#skill_"+skill_id).remove();
			}
			else{
				alert("Une erreur est survenue, contactez l'administrateur");
			}
		})
	})

	$("#localisation").keyup(function(){
		var localisation = $(this).val();
		localisation = localisation.replace(/(<([^>]+)>)/gi, ""); // delete HTML and PHP tags
		searchCity(localisation);
	}).on(function(){
		var localisation = $(this).val();
		localisation = localisation.replace(/(<([^>]+)>)/gi, "");
		searchCity(localisation);
	}).focus(function(){
		var localisation = $(this).val();
		localisation = localisation.replace(/(<([^>]+)>)/gi, ""); // delete HTML and PHP tags
		searchCity(localisation);
	})

	$("body").on('click', '.list-group-item-action', function(){
		var city_number = $(this).attr("data-city");
		var city_name = $(this).text();
		$("#localisation").val(city_name);
		$("input[name='city']").val(city_number);
		$("#resultSearch").remove();
	})
});

function increment(nb, compteur, time){
	if (compteur <= nb) {
		$("#compteur").text(compteur);
		setTimeout(function(){
			compteur++;
			time = time+100;
			increment(nb, compteur, time);
		}, time);
	}
}

function zoom(){
	$("#zoom").fadeIn('fast');
}

function closing_zoom(){
	$("#zoom").fadeOut('fast');
}

function searchCity(chain){
	// check the length of stings
	$("#resultSearch").remove();
	if (chain.length > 1) {
		var width = $("#localisation").outerWidth();
		$("#localisation").after('<div id="resultSearch" class="mt-1 list-group position-absolute shadow"></div>');
		$("#resultSearch").css("width", width+"px");
		$("#resultSearch").css("max-height", "270px");
		$.ajax({
			url: '/controllers/search_city_controller.php',
			type: 'POST',
			data: {
				'localisation': chain,
				'form' : 'update'
			} // name and value for the $_POST
		})
		.done(function(list_city){
			list_city = $.parseJSON(list_city); // construct strings with the JSON response
			if (list_city != 0) {
				$.each(list_city, function(key, value){
					var button = $("<button></button>") // create option
					.addClass("list-group-item") // add class selector
					.addClass("list-group-item-action")
					.attr("type", "button")
	        		.attr("data-city", value.ville_id) // add an attribute value with the city id
	        		.text(value.ville_nom_reel+' ('+value.ville_departement+')'); // add text in the button
					$("#resultSearch").append(button); // add button list in the list group
				})
			}
			else{
				var div = $("<div></div>") // create option
				.addClass("list-group-item") // add class selector
	        	.html('Aucun résulat pour <strong>'+chain+'</strong>'); // add text in the div
				$("#resultSearch").append(div); // add div list in the list group
			}
		})
	}
	else {
		$("input[name='city']").val('');
	}
}