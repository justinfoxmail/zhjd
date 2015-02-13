function setCover()
{
	this.id = 0;
}
setCover.setId = function(id){
	setCover.id = id;
};
setCover.setCover = function(key){
	document.getElementById("hotel_cover"+this.id).innerHTML = $("#coverImg"+key).attr("src");
	$flag = confirm("选择该图片为封面");
	if($flag==true) {
		$.post(
    		"/admin.php/Hotel/setcover", {url:$("#coverImg"+key).attr("src"),id:this.id},
    		function(data, status) {
                return false;
            }
   		 );
	}
	$('#coverModal').modal('hide');
}