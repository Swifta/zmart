/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	$(".tab_menu > li").click(function(e){
		switch(e.target.id){
			case "featured":
				//change status & style menu
				$("#featured").addClass("active");
				$("#new_arival").removeClass("active");
				$("#top_selling").removeClass("active");
				//display selected division, hide others
				$("div.featured").fadeIn();
				$("div.featured").css("visibility", "visible");
				$("div.new_arival").css("display", "none");
				$("div.top_selling").css("display", "none");
			break;
			case "new_arival":
				//change status & style menu
				$("#featured").removeClass("active");
				$("#new_arival").addClass("active");
				$("#top_selling").removeClass("active");
				//display selected division, hide others
				$("div.new_arival").fadeIn();
				$("div.new_arival").css("visibility", "visible");
				$("div.featured").css("display", "none");
				$("div.top_selling").css("display", "none");
			break;
			case "top_selling":
				//change status & style menu
				$("#featured").removeClass("active");
				$("#new_arival").removeClass("active");
				$("#top_selling").addClass("active");
				//display selected division, hide others
				$("div.top_selling").fadeIn();
				$("div.top_selling").css("visibility", "visible");
				$("div.featured").css("display", "none");
				$("div.new_arival").css("display", "none");
			break;
		}
		//alert(e.target.id);
		return false;
	});
});
