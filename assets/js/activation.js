// execute all functions when the document is loaded
$(document).ready(function(){
	// change background-color and links color on scroll for the desktop view
	$(window).scroll(function() {
	    if ($(this).width() > 767) {
	      if ($(this).scrollTop() > 50) {
	        $("nav").css("background", "#ffffff").addClass("shadow-sm");
	        $(".navbar-brand, .nav-link").css("color", "#343a40").removeClass("text-shadow");
	      }
	      else{
	        $("nav").css("background", "transparent").removeClass("shadow-sm");
	        $(".navbar-brand, .nav-link").css("color", "#ffffff").addClass("text-shadow");
	      }
	    }
  	})

	// remove text-shadow in mobile view
	if ($(window).width() <= 767) {
		$(".navbar-brand, .nav-link").removeClass("text-shadow");
	}

	$(window).resize(function(){
		if ($(window).width() <= 767) {
			$(".navbar-brand, .nav-link").removeClass("text-shadow");
		}
	})
})