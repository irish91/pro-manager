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
	//var headerTop = $("#header").css('top');
	var headerTop = '-75px';
	
	// variable for delay
	var timerHeader;
	
	// is timer on
	var isTimerHeaderOn = false;
	
	// mouse in / mouse out
	$("#header").hover(
	function () {
		
		// show
		animHeader(true, headerTop);
		
		// clear timer
		if(isTimerHeaderOn === true){
			clearTimeout(timerHeader);
			isTimerHeaderOn = false;
		}
	}, 
	function () {
		
		// delay hide
		timerHeader = setTimeout("animHeader(0, '" + headerTop + "')", 4000);
		
		// set timer to true
		isTimerHeaderOn = true;
	});
	
	/**
	 * Event: statistics bar - hover
	 * -----------------
	 *  
	 * - expand stats container on hover / shrink
	 */
	// variable for delay
	var timerStats;
	
	// is timer on
	var isTimerStatsOn = false;
	
	// mouse in / mouse out
	$("#statistics").hover(
	function () {
		
		// show
		animStatistics(true);
		
		// clear timer
		if(isTimerStatsOn === true){
			clearTimeout(timerStats);
			isTimerStatsOn = false;
		}
	}, 
	function () {

		// delay hide
		timerStats = setTimeout("animStatistics(0)", 4000);
		
		// set timer on
		isTimerStatsOn = true;
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
	
	if(show == true){
		
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
	
	if(show == true){
		
		// display content
		$('#statistics .content').css('display', 'block');
		
		$('#statistics .content').animate({
		    height: '120px',
		    opacity: 0.65,
		    
		}, 700, function() {
		    // animation complete.
		}); 
		
	}
	else
	{
		$('#statistics .content').animate({
			height: '0px',
			opacity: 0,
		}, 700, function() {
		    // animation complete.
			
			// hide content
			$('#statistics .content').css('display', 'none');
		});	
	}
};