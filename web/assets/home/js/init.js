/**
 * @author Tobias Hourst <tobiashourst@elcyone.com>
 * 
 */
// on document ready
$(document).ready(function(){

	/**
	 * Event: header - hover
	 * -----------------
	 *  
	 * - slides down on hover / slides up
	 */
	var headerTop = $("#header").css('top');
	
	// mouse in / mouse out
	$("#header").hover(
	function () {
		
		// show
		animHeader(true, headerTop);
	}, 
	function () {
		
		// hide
		animHeader(false, headerTop);
	});
	
	/**
	 * Event: global container - hover
	 * -----------------
	 *  
	 * - expand stats container on hover / shrink
	 */
	// mouse in / mouse out
	$("#global-container").hover(
	function () {
		
		// show
		animStatistics(true);
	}, 
	function () {
		
		//hide 
		animStatistics(false);
	});
		
});
//---------------------------
//  END ON DOCUMENT READY
//---------------------------



/**
 * Function animate header
 * 
 * @var  bool  show  whether display or hide the container 
 */
var animHeader = function(show, headerTop){
	
	if(show === true){
		
		$("#header").animate({
		    top: '0px',
		}, 500, function() {
		    // animation complete.
		});
		
	}
	else
	{
		$("#header").animate({
		    top: headerTop,
		}, 500, function() {
		    // animation complete.
		});	
	}
};



/**
 * Function animate statistics container 
 * 
 * @var  bool  show  whether display or hide the container 
 */
var animStatistics = function(show){
	
	if(show === true){
		
		// display content
		$('#statistics .content').css('display', 'block');
		
		$('#statistics .content').animate({
		    height: '120px',
		    opacity: 0.65,
		    
		}, 500, function() {
		    // animation complete.
		}); 
		
	}
	else
	{
		$('#statistics .content').animate({
			height: '0px',
			opacity: 0,
		}, 500, function() {
		    // animation complete.
			
			// hide content
			$('#statistics .content').css('display', 'none');
		});	
	}
};