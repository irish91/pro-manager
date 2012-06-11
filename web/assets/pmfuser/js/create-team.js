$(document).ready(function(){
	
	$('a#box-error-trigger').fancybox({
		'autoDimensions': true,
		'padding': -5,
		'margin': 0,
		'hideOnOverlayClick': false,
	});
	
	// ajax call for registration
	
	//@TODO: SEE ISSUE #2 FOR MORE INFORMATION 
	/* $('form#create-team').ajaxForm({ 
        dataType:  	'json', 
        success:   	processJson,
        error: 		errorJson,
    }); */

});

function processJson(data) {
    if(data.success == true){
    	
    	alert('test');
    	
    	 window.location = Routing.generate('registration_sign_contract');
    	
    	alert('test2');
    	
    } else{ 
    	
    	$('#box-error .content').html(data.errorsView);
    	
    	$("a#box-error-trigger").trigger('click');
    }
}

// temporary
function errorJson(xhr) {
    $('#content').html(xhr.responseText); 
}