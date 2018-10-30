$(document).ready(function() {
	<!-- Real-time Validation -->
		<!--Name cannot be blank-->
		$('#contact_name').on('input', function() {
			var input=$(this);
			var is_name=input.val();
			if(is_name){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}
		});
		
		<!--Email must be an email -->
		$('#contact_email').on('input', function() {
			var input=$(this);
			var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
			var is_email=re.test(input.val());
			if(is_email){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}
		});
		
		<!--Website must be a website -->
		$('#contact_website').on('input', function() {
			var input=$(this);
			// if (input.val().substring(0,4)=='www.'){input.val('http://www.'+input.val().substring(4));}
			var re = /^\+?([0-9]{1})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
			var is_url=re.test(input.val());
			if(is_url){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}
		});

		$('#contact_message').on('input', function() {
			var input=$(this);
			var is_name=input.val();
			if(is_name){input.removeClass("invalid").addClass("valid");}
			else{input.removeClass("valid").addClass("invalid");}
		});

	<!-- After Form Submitted Validation-->
	$("#contact_submit button").click(function(event){
		var form_data=$("#contact").serializeArray();
		var error_free=true;
		for (var input in form_data){
			var element=$("#contact_"+form_data[input]['name']);
			var valid=element.hasClass("valid");
			var error_element=$("span", element.parent());
			if (!valid){error_element.removeClass("error").addClass("error_show"); error_free=false;}
			else{error_element.removeClass("error_show").addClass("error");}
		}
		if (!error_free){
			event.preventDefault(); 
		}
		else{
			alert('No errors: Form will be submitted');
		}
	});
	
	
	
});