$(document).ready(function(){
	var add_event = false;
    var event_details = false;

	$(".calendar-case").click(function(){
		$(".event-view").slideDown();
		// récupère la data de la case du calendrier (yyyy-mm-jj)
		var date = $(this).data('calendar');
		// affecte la data de la case dans le bouton pour ajouter un évènement
      	$("#add-event").attr('data-event', date);
		var event;
  		if (window.XMLHttpRequest) {
    		event = new XMLHttpRequest();
  		} else {
    		// code for older browsers
    		event = new ActiveXObject("Microsoft.XMLHTTP");
  		}
		event.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			// affecte la date convertie
      			$("#event-date").text(this.responseText);
      			// Si le formulaire de nouvel évènement est ouvert, on le ferme pour afficher la liste d'un autre jour
      			if (add_event === true) {
      				$(".add-event").slideUp();
      			}
                // si le détail d'un évènment est ouvert, on le ferme pour afficher la liste d'un autre jour
                if (event_details === true) {
                    $(".event-details").slideUp();
                }
    		}
  		};
  		event.open("GET", "/coworking/utils/event_treatment.php?date="+date, true);
  		event.send();
	})

	$("#add-event").click(function(){
		var hours = $(".timepicker-hour").text();
    	var minutes = $(".timepicker-minute").text();
    	$("input[name='timeEvent']").val(hours+":"+minutes);
    	// obtient la data du bouton ajouter pour l'envoyer vers le bouton sauvegarder
    	date = $(this).attr('data-event');
    	$("button[name='save-event']").attr('data-event', date);
		$(".event-view").slideUp();
		$(".add-event").slideDown();
		add_event = true;
	})

    $(".event-line").click(function(){
        $(".event-view").slideUp();
        $(".event-details").slideDown();
        event_details = true;
    })

	$("button[name='close-event']").click(function(){
		$(".event-view").slideUp();
	})

    $("button[name='close-details']").click(function(){
        $(".event-details").slideUp();
        $(".event-view").slideDown();
    })

	$("button[name='close-newEvent']").click(function(){
		$(".add-event").slideUp();
	})

	$("#clock").datetimepicker({
        inline: true,
        locale: 'fr',
        format: 'LT',
        stepping: 5,
        icons: {
            up: "fas fa-chevron-up",
            down: "fas fa-chevron-down"
        }
    }).on('dp.change', function(){
    	var hours = $(".timepicker-hour").text();
    	var minutes = $(".timepicker-minute").text();
    	$("input[name='timeEvent']").val(hours+":"+minutes);
    });

    $("#everyDay").click(function(){
    	if ($(this).is(':checked')) {
    		$(".display-flex").slideUp();
    	}
    	else{
    		$(".display-flex").slideDown();
    	}
    })

    $("button[name='save-event']").click(function(){
    	// récupère les selecteurs 
    	var input_name_event = $("input[name='name-event']");
    	var input_time_event = $("input[name='timeEvent']");
    	var checkbox_event = $("input[name='everyDay']");
    	var input_location = $("input[name='location']");
    	var input_notes = $("textarea[name='notes']");
    	var button_save = $("button[name='save-event']");

    	let errors = false;

    	var name_event = input_name_event.val();
    	name_event = name_event.trim();
    	if (name_event.lenght == 0 || name_event == '') {
    		alert('Veuillez saisir le nom de votre évènement');
    		errors = true;
    	}

    	if (checkbox_event.is(':not(:checked)')) {
    		var time_event = input_time_event.val();
    		time_event = time_event.trim();
    		if (!time_event.match(/^((?:0[0-9])|(?:1[0-9])|(?:2[0-3])):[0-5][0-9]$/)) {
    			alert('Le format de votre heure n\'est pas correcte');
    			errors = true;
    		}
    	}

    	var date_event = button_save.attr('data-event');
    	date_event = date_event.trim();
    	if (!date_event.match(/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/)) {
    		alert('La date de votre évènement n\'est pas correcte');
    		errors = true;
    	}

    	if (errors == false) {
    		$(".add-event").slideUp();
    	}
    })

    $("#startingDate").datepicker({
        format: "dd/mm/yyyy",
        maxViewMode: 2,
        language: "fr",
        daysOfWeekHighlighted: "0,6",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true,
        startDate: "now",
        clearBtn: true
    }).on('changeDate', function(date){
        $("#endingDate").removeAttr('disabled');
        let startingDate = date.format();
        $("#endingDate").datepicker({
            format: "dd/mm/yyyy",
            maxViewMode: 2,
            language: "fr",
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            startDate: startingDate,
            clearBtn: true
        })
    })
    
    $("#send-request").click(function(){
        let startingDate = $("input[name='startingDate']").val();
        let endingDate = $("input[name='endingDate']").val();
        let nbDay = $("input[name='nbDay']").val();
        let errors = false;

        startingDate = startingDate.trim();
        if (startingDate.lenght == 0 || startingDate == '' || !startingDate.match(/^((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))\/((?:0[1-9])|(?:1[0-2]))\/((?:19|20)[0-9]{2})$/)) {
            errors = true;
            $("input[name='startingDate']").addClass('is-invalid');
        }

        endingDate = endingDate.trim();
        if (endingDate.lenght == 0 || endingDate == '' || !endingDate.match(/^((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))\/((?:0[1-9])|(?:1[0-2]))\/((?:19|20)[0-9]{2})$/)) {
            errors = true;
            $("input[name='endingDate']").addClass('is-invalid');
        }

        nbDay = nbDay.trim();
        if (nbDay <= 0 || nbDay > 35 || nbDay == '') {
            errors = true;
            $("input[name='nbDay']").addClass('is-invalid');
        }

        if ($("#signature").is(':not(:checked)')) {
            errors = true;
            $("#signature").addClass('is-invalid');
        }

        if (errors == false) {
            var newRequest;
            if (window.XMLHttpRequest) {
                newRequest = new XMLHttpRequest();
            } else {
                // code for older browsers
                newRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            newRequest.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $("#daysOff_list").append(this.responseText);
                    $("input[name='startingDate']").val('');
                    $("input[name='endingDate']").val('');
                    $("input[name='nbDay']").val('');
                }
            };
            newRequest.open("POST", "/coworking/utils/days_off_request.php", true);
            newRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            newRequest.send("startingDate="+startingDate+"&endingDate="+endingDate+"&nbDays="+nbDay);
        }
    })
})