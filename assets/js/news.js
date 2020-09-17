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
				data: { 'message': text }
			})
			.done(function(response){
				var infoBox = $("#info-box").width();
				if (infoBox > 0) {
					$("#info-box").fadeOut();
					$("temporary-content").after(response);
					zoom = false;
					$("textarea[name='edit-post']").val('');
					$("textarea[name='edit-post']").removeAttr('style');
					$("#post-contain").removeClass('post-focus').addClass('post-normal');
					$("#form-contain").removeAttr('style').addClass('w-100');
					$("#temporary-content").removeAttr('style').addClass('mt-3');
					$("#attachment").removeClass('btn-customized-alternativ').addClass('label-disabled');
					$("button[name='posting'], input[name='fileToUpload']").attr('disabled', 'disabled');
					$(".close_zoom").addClass('d-none');
				}
				else{
					$("temporary-content").after(response);
					zoom = false;
					$("textarea[name='edit-post']").val('');
					$("textarea[name='edit-post']").removeAttr('style');
					$("#post-contain").removeClass('post-focus').addClass('post-normal');
					$("#form-contain").removeAttr('style').addClass('w-100');
					$("#temporary-content").removeAttr('style').addClass('mt-3');
					$("#attachment").removeClass('btn-customized-alternativ').addClass('label-disabled');
					$("button[name='posting'], input[name='fileToUpload']").attr('disabled', 'disabled');
					$(".close_zoom").addClass('d-none');
				}
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
})

function commenter(id){
	$("#commentsBloc_"+id).slideToggle();
}