/**
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 * 
 */
// on document ready
$(document).ready(function(){
	
	/*
	 * Animate header -
	 * -----------------
	 *  
	 * - slides down on hover
	 */
	var headerTop = $("#header").css('top');;
	
	// mouse in / mouse out
	$("#header").hover(
	function () {
		
		$(this).animate({
		    top: '0px',
		}, 500, function() {
		    // animation complete.
		});
			   
	}, 
	function () {
		
		$(this).animate({
		    top: headerTop,
		}, 500, function() {
		    // animation complete.
		});	 
		
	});
	
	
});