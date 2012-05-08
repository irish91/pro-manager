$(document).ready(function(){
	
	// onclick return false

	
	// enable fancybox
	$('a#box-success-trigger').fancybox({
		'autoDimensions': true,
		'padding': -5,
		'margin': 0,
		'hideOnOverlayClick': false,
	});
	
	// ajax call for registration
	$('form#registration').ajaxForm({ 
        dataType:  	'json', 
        success:   	processJson,
        error: 		errorJson,
    });   

});

function processJson(data) {
    if(data.success == true)
    	 $("a#box-success-trigger").trigger('click');
    else
    	alert('error');
}

function errorJson(xhr) {
    $('#content').html(xhr.responseText); 
}