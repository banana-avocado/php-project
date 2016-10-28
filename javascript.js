var currentslide = 0;
$(document).ready(function () {
	resize();
	tryUrl();
	navClick();
	slide();
	userControlling();
	//preslide();
});
$(window).load(function(){
    popupboxRight();
});
$(window).resize (function () {
	autoslide();
});
function resize() {
	var pagewidth = $(window).width();
	$("#container").css("width", pagewidth);
	$(".page").css("width", pagewidth);
	$("#wrapper").css("width", pagewidth * $('#wrapper').children().size());
}
function navClick() {
	$("#nav li").click(function () {
		currentslide = this.getAttribute("pos");
		slide();
		$("#nav li").css ("border-bottom", "#00b3fd"); 
		$(this).css ("border-bottom", "#ff7d00 solid 4px");
	});
}
function slide() {
	var pagewidth = $(window).width();
	var offset = currentslide*pagewidth;
	$("#wrapper").animate({
		left:-offset+"px"
	}, 500);
}
function tryUrl() {
	var url = window.location.href;
	if (url.substr(-12, 12)=="#helikoptern"){
		currentslide = 1;
		slide();
		$("#nav li").css("border-bottom", "#00b3fd");
		$("#ett").css("border-bottom", "#ff7d00 solid 4px");
	}
	else if (url.substr(-10, 10)=="#projektet"){
		currentslide = 2;
		slide();
		$("#nav li").css("border-bottom", "#00b3fd");
		$("#två").css("border-bottom", "#ff7d00 solid 4px");
	}
	else if (url.substr(-12, 12)=="#medverkande"){
		currentslide = 3;
		slide();
		$("#nav li").css("border-bottom", "#00b3fd");
		$("#tre").css("border-bottom", "#ff7d00 solid 4px");
	}
	else{
		currentslide=0;
	}
}
function get_form(element){
    while(element){
        element = element.parentNode
        if(element.tagName.toLowerCase() == "form"){
            //alert(element) //debug/test
            return element
        }
    }
    return 0; //error: no form found in ancestors
}
function popupboxRight(){
    var buttonW = $("#popupbutton").width();
    $("#popupbox").css("right", buttonW+32+"px");   
}

function autoslide(){
	var pagewidth = $(window).width();
	$("#container").css ("width", pagewidth);
	$(".page").css ("width", pagewidth);
	$("#wrapper").css ("width", pagewidth* $('#wrapper').children().size() );
	var offset = currentslide*pagewidth;
	$("#wrapper").css("left", -offset);

}