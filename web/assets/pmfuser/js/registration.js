$(document).ready(function(){
	
	// onclick return false

	
	// enable fancybox
	/*$('input#register').fancybox({
		'autoDimensions': true,
		'padding': -5,
		'margin': 0,
		'hideOnOverlayClick': false,
	});*/
	
	// ajax call for registration
	$('form#registration').ajaxForm({ 
        dataType:  	'json', 
        success:   	processJson,
        error: 		errorJson,
    });   

});

function processJson(data) {
    alert(''); 
}

function errorJson(xhr) {
    $('#content').html(xhr.responseText); 
}