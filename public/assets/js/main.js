console.log("JS LOADED");

$(document).ready(function(){

	$(".delete").on("click", function(){
		var returnVal = confirm("Voulez vous vraiment supprimer ?");

		if(returnVal == true){
			return true;
		}else{
			return false;
		}
	})

})