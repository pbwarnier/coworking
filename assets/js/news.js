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

	$("textarea[name='edit-post']").click(function(){
		zoom = true;
		$(".news").scrollTop(0);
		$(this).css('height', '114px');
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
		if (this.files[0].name.length > 20) {
			var fileSplit = this.files[0].name.split('.');
			var fileExt = fileSplit.pop();
			var fileName = fileSplit.join('').substr(0, 20)+'[...].'+fileExt;
			$("#file-name").html(fileName);
		}
		else{
			$("#file-name").html(this.files[0].name);
		}
	})

	$("button[name='happy'], button[name='bad']").click(function(){
		$("#temporary-issue").fadeOut();
		setTimeout(function(){
			$("#temporary-answer").fadeIn();
		}, 400)
	})
})

function commenter(id){
	$("#commentsBloc_"+id).slideToggle();
}