$(document).ready(function(){
	var txt_offset = $("#form-contain").offset();
	var temporary_offset = $("#temporary-content").offset();
	var width = $("#form-contain").width();
	var height = $("#post-contain").height();
	var zoom = false;

	$(window).resize(function(){
		if (zoom == true) {
			$("#post-contain").removeClass('post-focus').addClass('post-normal');
			$("#form-contain").removeAttr('style').addClass('w-100');
			$("#temporary-content").removeAttr('style').addClass('mt-3');
			$("#attachment").removeClass('btn-customized-alternativ').addClass('label-disabled');
			$("button[name='posting'], input[name='fileToUpload']").attr('disabled', 'disabled');
			$(".close_zoom").addClass('d-none');
		}
	})

	$("textarea[name='edit-post'], #writing-post").click(function(){
		zoom = true;
		$(".news").scrollTop(0);
		$("textarea[name='edit-post']").css('height', '114px');
		$("#post-contain").removeClass('post-normal').addClass('post-focus');
		$("#form-contain").removeClass('w-100').css({
			'margin-top':+txt_offset.top,
			'margin-left':+txt_offset.left,
			'width':+width
		});
		$("#temporary-content").removeClass('mt-3').css('margin-top', + height+73);
		$("#attachment").removeClass('label-disabled').addClass('btn-customized-alternativ');
		$("button[name='posting'], input[name='fileToUpload']").removeAttr('disabled');
		$(".close_zoom").removeClass('d-none');
		$("#notifications").parent().removeClass('active');
		$("#drop-notifications").dropdown('hide');
	})

	$(".close_zoom").click(function(){
		zoom = false;
		$("textarea[name='edit-post']").removeAttr('style');
		$("#post-contain").removeClass('post-focus').addClass('post-normal');
		$("#form-contain").removeAttr('style').addClass('w-100');
		$("#temporary-content").removeAttr('style').addClass('mt-3');
		$("#attachment").removeClass('btn-customized-alternativ').addClass('label-disabled');
		$("button[name='posting'], input[name='fileToUpload']").attr('disabled', 'disabled');
		$(".close_zoom").addClass('d-none');
	})

	$("input[name='fileToUpload']").change(function(){
		var file = $(this).val();
		var ext = file.split(".");
    	ext = ext[ext.length - 1].toLowerCase();      
    	var arrayExtensions = ["jpg" , "jpeg", "png", "gif", "txt", "doc", "docx", "pdf", "xls", "zip"];

    	// lastIndexOf -1 return error
	    if (arrayExtensions.lastIndexOf(ext) == -1) {
	        alert("Le format de votre pièce jointe n'est pas acceptée.\nExtensions prises en charge pour les images :\n-> jpg, jpeg, png et gif\nExtension prises en charge pour les documents :\n-> txt, doc, docx, pdf, xls et xlsx\nPour tout autres format, veuillez compresser votre fichier en zip.");
	        $(this).val('');
	    }
	    else{
	    	$("button[name='posting']").removeClass("posting");
	    	$("button[name='posting']").attr("type", "submit");
	    	if (this.files[0].name.length > 20) {
				var fileSplit = this.files[0].name.split('.');
				var fileExt = fileSplit.pop();
				var fileName = fileSplit.join('').substr(0, 20)+'[...].'+fileExt;
				$("#file-name").html(fileName);
			}
			else{
				$("#file-name").html(this.files[0].name);
			}
	    }
	})

	$("body").on('click', '.posting', function(){
		var text = $("textarea[name='edit-post']").val();
		var file = $("input[name='fileToUpload']").val();
		text = text.trim();
		text = text.replace(/(<([^>]+)>)/gi, "");

		if (text.length == 0) {
			alert("Pour poster, rédigez un message");
		}
		else{
			$.ajax({
				url: 'controllers/new_posting_controller.php',
				type: 'POST',
				data: { 'text': text }
			})
			.done(function(response){
				response = JSON.parse(response);
				var infoBox = $(".info-box").width();
				if (infoBox > 0) {
					$(".info-box").fadeOut();
				}

				zoom = false;
				$("#temporary-content").after(response.html);
				$("textarea[name='edit-post']").val('');
				$("textarea[name='edit-post']").removeAttr('style');
				$("#post-contain").removeClass('post-focus').addClass('post-normal');
				$("#form-contain").removeAttr('style').addClass('w-100');
				$("#temporary-content").removeAttr('style').addClass('mt-3');
				$("#attachment").removeClass('btn-customized-alternativ').addClass('label-disabled');
				$("button[name='posting'], input[name='fileToUpload']").attr('disabled', 'disabled');
				$(".close_zoom").addClass('d-none');
				$("#post_"+response.id).fadeIn();
			})
		}
	})

	$("button[name='happy'], button[name='bad']").click(function(){
		$("#temporary-issue").fadeOut();
		setTimeout(function(){
			$("#temporary-answer").fadeIn();
		}, 400)
	})

	$("#close-info").click(function(){
		$.ajax({
			url: '',
			type: 'POST',
			data: { 'close-info-box': 1 } // name and value for the $_POST
		})
		.done(function(){
			$("#info-box").fadeOut();
		})
	})

	$("body").on('click', '.delete-post', function(){
		var div = $(this).closest('div.shadow-sm');
		var id = div.attr('id');
		id = id.split('_');
		$.post('controllers/news_controller.php', { idPost: id[1], action: "delete" }, function(response){
			if (response == 1) {
				div.addClass('p-3').addClass('bg-info').addClass('text-light').removeClass('border');
				div.html('Votre publication est supprimée');
				setTimeout(function(){
					div.fadeOut();
				}, 4000);
			}
			else{
				alert("Une erreur est survenue, contactez l'administrateur");
			}
		})
	})

	$("body").on('click', '.btn-interaction', function(){
		var id = $(this).attr("data-id");
		var action = $(this).attr("data-action");

		if (action == "comment") {
			$("#commentsBloc_"+id).slideToggle();
		}

		if(action == "like" && $("#btn-like-"+id).hasClass('disliked')){
			$.post('controllers/news_controller.php', { idPost: id, action: "like" }, function(response){
				response = JSON.parse(response);
				if (response.success == 1) {
					$("#btn-like-"+id)
					.addClass('text-info')
					.removeClass('disliked')
					.addClass('liked')
					.attr('data-action', 'dislike');

					if (response.count == 1) {
						$("#post_"+id+" p").after('<div id="reactions_'+id+'" class="text-secondary small text-right">1<i class="ml-2 mr-3 far fa-thumbs-up"></i>0<i class="mx-2 far fa-comment"></i></div>');
					}
					else {
						var nb_likes = $("#likes_"+id).text();
						nb_likes = parseInt(nb_likes);
						nb_likes = nb_likes + 1;
						$("#likes_"+id).text(nb_likes);
					}	
				}
				else {
					var post = $(this).closest('div.shadow-sm');
					var postId = post.attr('id');
					$("#"+postId+" p").after('<div class="alert alert-danger" role="alert">Une erreur est survenue lors de l\'enregistrement de votre réaction, contactez l\'administrateur.</div>');
				}	
			})
		}

		if (action == "dislike" && $("#btn-like-"+id).hasClass('liked')) {
			$.post('controllers/news_controller.php', { idPost: id, action: "dislike" }, function(response){
				response = JSON.parse(response);
				if (response.success == 1) {
					$("#btn-like-"+id)
					.removeClass('text-info')
					.removeClass('liked')
					.addClass('disliked')
					.attr('data-action', 'like');

					if (response.count == 0) {
						$("#reactions_"+id).remove();
					}
					else {
						var nb_likes = $("#likes_"+id).text();
						nb_likes = parseInt(nb_likes);
						nb_likes = nb_likes + 1;
						$("#likes_"+id).text(nb_likes);
					}	
				}
				else {
					var post = $(this).closest('div.shadow-sm');
					var postId = post.attr('id');
					$("#"+postId+" p").after('<div class="alert alert-danger" role="alert">Une erreur est survenue lors de l\'enregistrement de votre réaction, contactez l\'administrateur.</div>');
				}
			})
		}
	})
})