$(document).ready( function()
{
	$('.ajaxed').click(checkBoxChange);				
});

	checkBoxChange = function(){
		var newValue = this.checked ? 1 : 0;
		var parts = $(this).attr('id').split('_');
		$.ajax({
			data : { value : newValue, idSpecificProject : parts[2] , idEmployee : parts[1], level : parts[3] , isMain : parts[4] },
			url : baseUrl +'/specific-project/approved-user/',
			success: function() {
				window.location = window.location;
			}
		});
		
	}