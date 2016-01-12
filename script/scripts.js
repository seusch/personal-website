// JavaScript Document
$(document).ready(function(){
	$(window).resize(function(){
		var windowheight=$(window).height();
		$(".mainsection").height(windowheight);
	}); 
	$(window).resize();
	
	$("#replacement a").click(function(evt){
		evt.preventDefault();
		var sectionname = $(this).data("section");
		scroll_offset = $('#'+sectionname).offset(),
		scroll_offset_top = scroll_offset.top;
		
		$("body, html").animate({
			"scrollTop": scroll_offset_top
		});
		function overlay() {
	el = document.getElementById("overlay");
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
		}
	});
	
	
	
}) //end document ready
	