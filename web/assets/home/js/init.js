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
	 * - slides down on hover / slides up
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
	
	/*
	 * Animate statistic content -
	 * -----------------
	 *  
	 * - expand on hover / shrink
	 */
	// mouse in / mouse out
	$("#statistics").hover(
	function () {
		
		// display content
		$('.content', this).css('display', 'block');
		
		$('.content', this).animate({
		    height: '120px',
		    opacity: 0.65,
		    
		}, 500, function() {
		    // animation complete.
		});
			   
	}, 
	function () {
		
		$('.content', this).animate({
			height: '0px',
			opacity: 0,
		}, 500, function() {
		    // animation complete.
			
			// hide content
			$(this).css('display', 'none');
		});	 
		
	});
	
});