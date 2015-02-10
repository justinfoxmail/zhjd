$(document).ready(function(){
	$(".pushData").click(function(){
		var form = $(this).parent().attr("id");
		var action = $("#"+form).attr('action');
		var params = $("#"+form).serialize();
		$.post(
    		action, params,
    		function(data, status) {
                return false;
            }
   		 );	//end post
      });
});