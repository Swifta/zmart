
$(document).ready(function(){
	$('.cancel_login').hide();
	$('.what_happens').hide();
	$('.what_buygift').hide();
	$('.can_change').hide();
});

$('.cancel_login').hide();
function SimilarDeals() {
        $('.cancel_login').show();
        $('.befor_login').hide();
}
function SimilarProducts() {
        $('.befor_login').show();
        $('.cancel_login').hide();
}

function WhatHappens() {
        $('.what_happens').slideToggle(300);
}
function Whatbuygift() {
         $('.what_buygift').slideToggle(300);
}
function CanChange() {
        $('.can_change').slideToggle(300);
}

