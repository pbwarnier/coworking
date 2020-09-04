$(document).ready(function(){
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
		var id = $(this).prev().attr('id');
		id = id.substr(6, 6);
		id++;
		$(this).before('<div id="skill_'+id+'" class="my-1 d-inline-block"><input id="skill_name" class="my-md-0 my-2 mr-2 px-3 py-2 d-inline-block rounded-pill form-control" name="skill_name" maxlenght="50" style="max-width: 200px;"></div>')
		$(this).removeClass('d-inline-block').addClass('d-none');
		$("input[name='skill_name']").focus();
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