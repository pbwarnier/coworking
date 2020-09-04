// execute fonction when page is loading
$(document).ready(function(){
	if ($("#div_form").hasClass('d-none')) {
		// steps before show the form
		setTimeout(function(){
			$("#div_text").addClass('d-none');
			$("#div_loader").removeClass('d-none');
			setTimeout(function(){
				$("#div_loader").addClass('d-none');
				$("#div_form").removeClass('d-none');
				setTimeout(function(){
					$("#user-pic").css({
						'transform': 'scale(1.8)',
						'margin-top': '-30px'
					});
				}, 1000);
			}, 3500);
		}, 3000);
	}
	else {
		setTimeout(function(){
			$("#user-pic").css({
				'transform': 'scale(1.8)',
				'margin-top': '-30px'
			});
		}, 500);
	}

	if ($(window).width() < 575) {
		$("nav").removeClass('fixed-top');
	}

	var avatar = false;

	// if user choose a personal image, checking file extension
	$("input[data-preview]").change(function() {
		var file = $("#data-preview").val();
        var ext = file.split(".");
    	ext = ext[ext.length - 1].toLowerCase();      
    	var arrayExtensions = ["jpg" , "jpeg", "png", "gif"];

    	// lastIndexOf -1 return error
	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Seuls les fichiers au format jpg, jpeg, png et gif sont acceptés.");
	    }
        else{
        	avatar = true;
        	$("#remove-btn").removeClass('d-none');
        	$("button[name='skip']").addClass('d-none');
        	$("button[name='next']").removeClass('d-none');
        	$(".custom-file-upload").addClass('d-none');
        	var input = $(this);
			var oFReader = new FileReader();
			oFReader.readAsDataURL(this.files[0]);
			oFReader.onload	= function(oFREvent) {
				$(input.data('preview')).css('background-image', 'url("'+oFREvent.target.result+'")');
			};
        }
	});

	// delete input value and change blackground-image in the preview
	$("#remove-btn").click(function(){
		$("#data-preview").val("");
		$(".preview").css('background-image', 'url("/coworking/assets/pictures/user.png")');
		$("button[name='skip']").removeClass('d-none');
		$("#remove-btn").addClass('d-none');
		$("button[name='next']").addClass('d-none');
		$(".custom-file-upload").removeClass('d-none');
		avatar = false;
	});

	var number = 1;
	// advances in the steps of the form
	$("button[name='next']").click(function(){
		if (number == 1) {
			$("#user-pic").css({
				'transform': 'scale(1)',
				'margin-top': '-60px'
			});
			$("#remove-btn").addClass('d-none');
			$("#step1").removeClass('d-flex').addClass('d-none');
			$("#step2").removeClass('d-none').addClass('d-flex');
			number++;
		}
		else{
			$("#step"+number).removeClass('d-flex').addClass('d-none');
			number++;
			$("#step"+number).removeClass('d-none').addClass('d-flex');
		}
	});

	$("button[name='skip']").click(function(){
		$("#user-pic").css({
			'transform': 'scale(1)',
			'margin-top': '-60px'
		});
		$("#step"+number).removeClass('d-flex').addClass('d-none');
		number++;
		$("#step"+number).removeClass('d-none').addClass('d-flex');
		$("button[name='next']").removeClass('d-none');
	});

	// previous steps
	$("button[name='prev']").click(function(){
		if (number == 2) {
			$("#user-pic").css({
				'transform': 'scale(1.8)',
				'margin-top': '-30px'
			});

			if (avatar == true) {
				setTimeout(function(){
					$("#remove-btn").removeClass('d-none');
				}, 1000);
			}
			else{
				$("button[name='next']").addClass('d-none');
			}

			$("#step"+number).removeClass('d-flex').addClass('d-none');
			number--;
			$("#step"+number).removeClass('d-none').addClass('d-flex');
		}
		else{
			$("#step"+number).removeClass('d-flex').addClass('d-none');
			number--;
			$("#step"+number).removeClass('d-none').addClass('d-flex');
		}
	});

	$("#birthdate").datepicker({
	    format: "dd/mm/yyyy",
	    maxViewMode: 3,
	    language: "fr",
	    daysOfWeekHighlighted: "0,6",
	    autoclose: true,
	    todayHighlight: true,
	    toggleActive: true,
	    orientation: "bottom auto",
	    endDate: "now"
	});

	$("#date").datepicker({
	    format: "dd/mm/yyyy",
	    maxViewMode: 3,
	    language: "fr",
	    daysOfWeekHighlighted: "0,6",
	    autoclose: true,
	    todayHighlight: true,
	    toggleActive: true,
	    orientation: "bottom auto",
	    endDate: "now"
	});

	var nb_skills = 1;
	$("button[name='add_skills']").click(function(){
		var skills = $("input[name='skills']");

		if (nb_skills <= 5 && skills.val() != "") {
			let value = skills.val();
			$("input[name='skill_"+nb_skills+"']").val(value);
			skills.val("");
			$("#list_skills").append('<div class="my-1 mr-2 px-2 py-1 small text-dark bg-white border rounded-pill d-inline-block">'+value+'</div>');
			nb_skills++;
		}
		else{
			if (nb_skills > 5) {
				$("#errorSkills").modal('show')
			}

			if (skills.val() == "") {
				skills.addClass('border-danger');
				setTimeout(function(){
					skills.removeClass('border-danger');
				}, 3000);
			}
		}
	});

	$("input[name='skills']").keyup(function(){
		string = $(this).val();
		string = string.substr(0, 1).toUpperCase() + string.substr(1, string.length).toLowerCase();
		$(this).val(string);
	})

	// count caracters in textarea
	$("textarea[name='biography']").keyup(function(){
		var string = $("textarea[name='biography']").val();
		$("#compteur").text(string.length);
	});
});
