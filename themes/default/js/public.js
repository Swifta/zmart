// JavaScript Document
var scripts = document.getElementsByTagName("script"),
SrcPath = scripts[0].src;
Path = SrcPath.replace("js/jquery.js", "");


$(document).ready(function () {
        
	if($('#messagedisplay')){
		$('#messagedisplay').animate({opacity: 1.0}, 8000)
		//$('#messagedisplay').fadeOut('slow');
	}
	if($('#error_messagedisplay')){
		$('#error_messagedisplay').animate({opacity: 1.0}, 8000)
		//$('#error_messagedisplay').fadeOut('slow');
	}
	
	  $("form").submit( function () {
   $('.processing_image').show();
	$('#submit').hide();
   $("input.required").each(function(){
        if ($.trim($(this).val()).length == ""){
             $('.processing_image').hide();
				$('#submit').show();
            
        }else{
           $('.processing_image').show();
			$('#submit').hide();
        }
     } );

} );

	$('.cart_button').click(function() {
		var count=$("#item_count").html();
		var id=$(this).attr('id').replace('cart','');
		var id_name=$(this).attr('id_name').replace('cart','');
		if(id){ var url = Path+'payment_product/cart_items/'+count+"/"+id;  }

	                $.ajax(
	                {
		        type:'POST',
		        url:url,
		        cache:false,
		        async:true,
		        global:false,
		        dataType:"html",
		        success:function(check)
		        {
		          window.location.href = Path+"cart.html" ;
		          document.getElementById("item_count").innerHTML=check;
		        },
		        error:function()
		        {
			        alert('No data found.');
		        }

	                });
		});

	$('a.submit').click(function() {
		var Pass= $("#password").val();
		var email= $("#email").val();
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (filter.test(email)) {
		if(email !='' && Pass !=''){
			$.post(Path+'users/login?email='+email+'&Pass='+Pass, {
			}, function(response){
			});
		}
		}else if(email=='') {
		$("#email_error").text("*Required");
		}
		else{
		$("#email_error").text("Invalid Email");
		}
		var req="* Required";
		if(Pass==''){
			$('#pass_error').text(req); }

		else if((Pass.length<5)||(Pass.length>20) && Pass!=''){
			$('#pass_error').text("The Password Should contain 5-20 Cahracters"); }

		else{
			$('#pass_error').empty();
			 }
	});

		$('a.profile_edit').live("click", function(e){
			var UserID =  $(this).attr('id').replace('NEDIT-','');
				$.post(Path+'users/edit_user_name?user_id='+UserID, {
				}, function(response){
					$('#user_name').css('display','none');
					$('#edit_hide').css('display','none');
					$('#Editprofile-'+UserID).css('display','');
					$("#e_followup-"+UserID).val(response);
					});
		});
		
		$('.sample_12').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample-','');
			var id_val = $('#sample-'+getUID).attr('data-subcat');
				if(id_val==0)
				{
					$('#sub_category_'+getUID).css('display','none');
					$('#sample-'+getUID).css('background','none');
				}
				else{
					var url = Path+"products/all_products/?cate_id="+(getUID)+'&t=1';
					$.post(url,function(check){
						if(getUID!=""){
							$('#categeory1-'+getUID).html(check);
							$('#categeory1-'+getUID).show();
						}
					});
				}

            });

			$('.sample32').mouseover(function() {
				var getUID =  $(this).attr('id').replace('sample32-','');
				var id_val = $('#sample32-'+getUID).attr('data-subcat');
					if(id_val==0)
					{
						$('#product_sub_category_'+getUID).css('display','none');
						$('#categeory32-'+getUID).css('background','none');
					}
					else{
						//var getUID =  $(this).attr('id').replace('sample32-','');
						var url = Path+"products/all_products/?cate_id="+(getUID)+'&t=1';
						$.post(url,function(check){
							if(getUID!=""){
								$('#categeory32-'+getUID).html(check);
								$('#categeory32-'+getUID).show();
							}
						});
					}

			});

			$('.sample324').mouseover(function() {
				var getUID =  $(this).attr('id').replace('sample324-','');
				var id_val = $('#sample324-'+getUID).attr('data-subcat');
					if(id_val==0)
					{
						$('#deal_sub_category_'+getUID).css('display','none');
						$('#categeory324-'+getUID).css('background','none');
					}
					else{
						//var getUID =  $(this).attr('id').replace('sample32-','');
						var url = Path+"deals/today_deals/?cate_id="+(getUID)+'&t=1';
						$.post(url,function(check){
							if(getUID!=""){
								$('#categeory324-'+getUID).html(check);
								$('#categeory324-'+getUID).show();
							}
						});
					}

			});
		$('.sample325').mouseover(function() {
			var getUID =  $(this).attr('id').replace('sample325-','');
			var id_val = $('#sample325-'+getUID).attr('data-subcat');
				if(id_val==0)
				{
					$('#auction_sub_category_'+getUID).css('display','none');
					$('#categeory325-'+getUID).css('background','none');
				}
				else{
					//var getUID =  $(this).attr('id').replace('sample32-','');
					var url = Path+"auction/today_auction/?cate_id="+(getUID)+'&t=1';
					$.post(url,function(check){
						if(getUID!=""){
							$('#categeory325-'+getUID).html(check);
							$('#categeory325-'+getUID).show();
						}
					});
				}
		});
        });
var win2;
function facebookconnect()
{
        win2 = window.open(Path+'facebook-connect.php',null,'width=750,location=0,status=0,height=500');
        checkChild();
}

var win3;
function facebookconnect_share()
{
        win3 = window.open(Path+'facebook-connect-share.php',null,'width=750,location=0,status=0,height=500');
        checkChild();
}
function checkChild() {
	  if (win2.closed) {
		window.location.reload(true);
	  } else setTimeout("checkChild()",1);
}

function closeerr(t)
{
	if(t=="err"){
		$("#error_messagedisplay").hide();
	}
	else{
		$("#messagedisplay").hide();
	}
}

/** Change City **/

function changecity(cityID, CityURL)
{
	window.location.href = Path+"changecity/"+cityID+"/"+CityURL+'.html';
}

function filtercategory(category_url,type,cat_type)
{
      if(category_url && type == "products"){
                  window.location.href = Path+"products/c/"+cat_type+"/"+category_url+'.html';
      }else  if(category_url && type == "storecreditproducts"){
                  window.location.href = Path+"storecredits-products/c/"+cat_type+"/"+category_url+'.html';
      } else if(category_url && type == "deal"){
               window.location.href = Path+"deal/c/"+cat_type+"/"+category_url+'.html';
      }
       else if(category_url && type == "auction"){
               window.location.href = Path+"auction-c/"+cat_type+"/"+category_url+'.html';
      }
       return true;
}
function filtercolor(id)
{
        if(id){
                  window.location.href = Path+"products/color_filter/"+id+'.html';
        }
        return true;
}

function change_category()
{
	$('#submit').click();
}
function change_category1()
{
	$('#submit_1').click();
}

function change_sort()
{
	$('#submit').click();
}

/** SUBSCRIBE  UNSUBSCRIBE **/

function SubscribeUnsubscribe(id,type)
{
       var IsChecked = $('.check_subcity:checked').length;
       if(IsChecked==false){
               alert("Please select atleast one city");
               return false;
       }
       if(id && type){
               window.location.href =Path+"users/"+type+"-select/"+id;
       }
       return;
}

function submitform()
{
        if(document.forms["myform"].q.value==""){
                document.forms["myform"].q.placeholder="Search Value Empty";
        }
        else{
                document.forms["myform"].submit();
        }
}

function productaddtocart(id,key)
{
	if(id && key){
	        var url = Path+"product/addtocart/"+id+"/"+key;
		$.post(url,function(check){
		        alert(check); exit;
			window.location.href = Path+"cart.html" ;
		});
	       //window.location.href = Path+"product/addtocart/"+id+"/"+key;
	}
	return;
}
function show_popup()
{
	$('#fade').css({'visibility' : 'visible'});
	$('.popup_block5').css({'display' : 'block'});
}

function showlogin()
{
	document.login.email.value='';
	document.login.password.value='';
	$('#email_error').html('');
	$('#password_error').html('');
	$('#fade').css({'visibility' : 'visible'});
	$('.popup_block').css({'display' : 'block'});
	$('.popup_block1').css({'display' : 'none'});
	$('.popup_block2').css({'display' : 'none'});
	$('.popup_block4').css({'display' : 'none'});
}

function show_auction(userid,auction_key,auction_title)
{
        if(!userid) {
	        $('input[name="auction_key"]').val(auction_key);
	        $('input[name="auction_title"]').val(auction_title);
	        $('#fade').css({'visibility' : 'visible'});
	        $('.popup_block').css({'display' : 'block'});
        } else {
	        $('#fade').css({'visibility' : 'visible'});
	        $('.popup_auction').css({'display' : 'block'});
        }
}

function showforgotpassword()
{
	document.forget_password.email.value='';
	$('#femail_error').html('');
	$('#fade').css({'visibility' : 'visible'});
	$('.popup_block2').css({'display' : 'block'});
	$('.popup_block').css({'display' : 'none'});
	$('.popup_block1').css({'display' : 'none'});
	$('.popup_block4').css({'display' : 'none'});
}

function showsignup()
{
	document.signup.f_name.value='';
	document.signup.password.value='';
	document.signup.email.value='';
	document.signup.city.value='-99';
	$('#fname_error').html('');
	$('#emai_error').html('');
	$('#pass_error').html('');
	$('#city_error').html('');
	$('#country_error').html('');
        $('#emai_error').html('');
        $('#city_error').html('');
        $('#pass_error').html('');
        $('#cpass_error').html('');
        $('#fname_error').html('');
         $('#terms_error').html('');
	$('#fade').css({'visibility' : 'visible'});
	$('.popup_block').css({'display' : 'none'});
	$('.popup_block1').css({'display' : 'block'});
	$('.popup_block2').css({'display' : 'none'});
	$('.popup_block4').css({'display' : 'none'});
}

function check(){

	        var filter = /^[0-9]+$/;
		var old_bid = $('#old_bid').val();
		var new_bid = $('#new_bid').val();
		var deal_id = $('input[name="bid_deal_id"]').val();
		if(parseFloat(new_bid)==""){
			$(".place_input").css('border','1px solid red');
				return false;
		}
		else if(filter.test(parseFloat(new_bid))==false){
			$(".place_input").css('border','1px solid red');
				$('#new_bid').val('');
				return false;
		}
		else if(parseFloat(old_bid) > parseFloat(new_bid)){
			$(".place_input").css('border','1px solid red');
			return false;
		}
		if(parseFloat(new_bid) >= parseFloat(old_bid)){
			$.post(Path+'auction/check_amount/'+new_bid+'/'+deal_id,function(check){
				if(check == 1) {
					document.auction_bid.action = Path+"auction/bid_payment";
					document.auction_bid.submit();
					return true;
				 }
				else {
					$(".place_input").css('border','1px solid red');
					return false;
				}
			});
			return false;
		}
}

/** SUBSCRIBE  UNSUBSCRIBE **/

function like1(d_id,u_id,dis_id,type)
{
    if(d_id  && u_id){
		var url = Path+"welcome/like1?deal_id="+d_id+"&user_id="+u_id+"&dis_id="+dis_id+"&type="+type;
		$.post(url,function(check){
			$('#load_like_unlike1_'+dis_id).html(check);
		});
	}
	return true;
}

function unlike1(d_id,u_id,dis_id,type)
{
    if(d_id  && u_id){
		var url = Path+"welcome/unlike1?deal_id="+d_id+"&user_id="+u_id+"&dis_id="+dis_id+"&type="+type;
		$.post(url,function(check){
			$('#load_like_unlike1_'+dis_id).html(check);
		});
	}
	return true;
}
function like(s_id,u_id,dis_id)
{
    if(s_id  && u_id){
		var url = Path+"stores/like?store_id="+s_id+"&user_id="+u_id+"&dis_id="+dis_id;
		$.post(url,function(check){
			$('#load_like_unlike1_'+dis_id).html(check);
		});
	}
	return true;
}

function unlike(s_id,u_id,dis_id)
{
    if(s_id  && u_id){
		var url = Path+"stores/unlike?store_id="+s_id+"&user_id="+u_id+"&dis_id="+dis_id;
		$.post(url,function(check){
			$('#load_like_unlike1_'+dis_id).html(check);
		});
	}
	return true;
}

function check_comment()
{
	var c = $("#comment_box").val();
	if(c=="Add a comment..."){
	        $('#error').html('Required*');
	        return false;
	}
	var d = $("#deal_id").val();
	var t = $("#type").val();
	var u_id = $('#user_id').val();
	if(u_id ==""){
		$("#comment_box").val('');
		$('#error').html('Please sign in to post comments');
		return false;
	}
	else{
	        if(c == ""){
		        $(".comment_box").css('border','1px solid red');
		        return false;
	        }
	        else{
		        var url = Path+'welcome/comments/?comment='+c+"&deal_id="+d+"&type="+t;
		        $.post(url,function(check){
				        $('#show').html(check);
				        $("#comment_box").val('');
				        $('#messagedisplay1').animate({opacity: 1.0}, 1000)
				        $('#messagedisplay1').fadeIn(1000);
				        $('#messagedisplay1').fadeOut(4000);
		        });
	        }
	}
}
/* EDIT Comments */
function edit_comment(commentid)
{
	var c = $("#comment_box-"+commentid).val();
	var d = $("#comment_id").val();
	if(c==""){
	        $('#error-'+commentid).html('Required*');
	        return false;
	}

	var d = $("#deal_id").val();
	var t = $("#type").val();
	var u_id = $('#user_id').val();
	if(u_id ==""){
		$("#comment_box-"+commentid).val('');
		$('#error-'+commentid).html('Please sign in to post comments');
		return false;
	}
	else{
	        if(c == ""){
		        $(".comment_box-"+commentid).css('border','1px solid red');
		        return false;
	        }
	        else{
		        var url = Path+'welcome/comments/?comment='+c+"&deal_id="+d+"&type="+t+"&dis_id="+commentid+"&action_type=update";
		        $.post(url,function(check){
				        $('#show').html(check);
				        //$('#show_comment').html(check);
				        //$("#comment_box-"+commentid).val('');
				        $('#messagedisplay1').animate({opacity: 1.0}, 1000)
				        $('#messagedisplay1').fadeIn(1000);
				        $('#messagedisplay1').fadeOut(4000);
				        $('#face_top_textarea'+commentid).hide();
				        $('.post_button'+commentid).hide();
		        });
                }
	}
}
/* EDIT store Comments */
function edit_comment1(commentid)
{

	var c = $("#comment_box-"+commentid).val();
	var d = $("#comment_id").val();
	if(c==""){
	        $('#error-'+commentid).html('Required*');
	        return false;
	}
	var d = $("#store_id").val();
	var u_id = $('#user_id').val();
	if(u_id ==""){
		$("#comment_box-"+commentid).val('');
		$('#error-'+commentid).html('Please sign in to post comments');
		return false;
	}
	else{
	if(c == ""){
		$(".comment_box-"+commentid).css('border','1px solid red');
		return false;
	}
	else{
		var url = Path+'stores/comments?comment='+c+"&store_id="+d+"&dis_id="+commentid+"&action_type=update";
		$.post(url,function(check){
				//$('#show').html(check);
				$('#show_comment').html(check);
				//$("#comment_box-"+commentid).val('');
				$('#'+commentid).hide();
				$('.post_button'+commentid).hide();

		});
	}
	}
}

function check_comment1()
{
	var c = $("#comment_box").val();
	var d = $("#store_id").val();
	var u_id = $('#user_id').val();
	if(u_id ==""){
		$("#comment_box").val('');
		$('#error').html('Please sign in to post comments');
		return false;
	}
	if(c == ""){
		$(".comment_box").css('border','1px solid red');
		return false;
	}
	else{
			var url = Path+'stores/comments/?comment='+c+"&store_id="+d;
			$.post(url,function(check){
					$('#show_comment').html(check);
					$("#comment_box").val('');
			});
	}

}
/* EDIT Comments */
function deleteComments(dealid,userid,commentid,type)
{
			var url = Path+'welcome/delete_users_comments?dis_id='+commentid+"&deal_id="+dealid+"&type="+type;
			$.post(url,function(check){
					$('#show').html(check);
			});
}


function filter_deals()
{
	var amount = $("#amount").val();
	var discount = $("#discount").val();
        var url = Path+"deals/ajax_post_deals/?amount="+amount+"&discount="+discount;
	$.post(url,function(check){
		$('#deal').html(check);
	});
}

function filter_products()
{
       var amount = $("#amount").val();
       var url = Path+"products/ajax_post_products/?amount="+amount;
		$.post(url,function(check){
			$('#product').html(check);
		});
}

function filter_auctions()
{
       var amount = $("#amount_1").val();
       var url = Path+"auction/ajax_post_auctions/?amount="+amount;
		$.post(url,function(check){
			$('.auction').html(check);
		});
}

function filter_color(color_id)
{
        var url = Path+"products/ajax_post_color/?color="+color_id;
        $.post(url,function(check){
	        $('#product').html(check);
        });
}

function filter_size(size_id)
{
        var url = Path+"products/ajax_post_size/?size="+size_id;
        $.post(url,function(check){
        $('#product').html(check);
        });
}

//Deal Details
function deal_detail() {
                $('.deal').show();
                $('.highlight').hide();
                $('.fineprint').hide();
                $('.terms_conditions').hide();
                $('.specification').hide();
                $("#deal_details").addClass("act4");
                $("#highlights").removeClass("act4");
                $("#fineprints").removeClass("act4");
                $("#terms_conditions").removeClass("act4");

}

//Highlight Details
function high_lights() {
                $('.highlight').show();
                $('.deal').hide();
                $('.fineprint').hide();
                $('.terms_conditions').hide();
                $('.specification').hide();
                $("#highlights").addClass("act4");
                $("#deal_details").removeClass("act4");
                $("#fineprints").removeClass("act4");
                $("#terms_conditions").removeClass("act4");

}
//fine_prints Details
function fine_prints() {
                $('.fineprint').show();
                $('.deal').hide();
                $('.highlight').hide();
                $('.terms_conditions').hide();
                $('.specification').hide();
                $("#fineprints").addClass("act4");
                $("#deal_details").removeClass("act4");
                $("#highlights").removeClass("act4");
                $("#terms_conditions").removeClass("act4");

}
//Terms and Conditions
function terms_conditions() {
                $('.terms_conditions').show();
                $('.deal').hide();
                $('.fineprint').hide();
                $('.highlight').hide();
                $('.specification').hide();
                $("#terms_conditions").addClass("act4");
                $("#deal_details").removeClass("act4");
                $("#highlights").removeClass("act4");
                $("#fineprints").removeClass("act4");
}

//Highlight Details
function specification() {
                $('.specification').show();
                $('.fineprint').hide();
                $('.deal').hide();
                $('.highlight').hide();
                $('#specification').addClass("act4");
                $("#fineprints").removeClass("act4");
                $("#deal_details").removeClass("act4");
                $("#highlights").removeClass("act4");

}

 //send it to friend
function showfriend(userid,type,key,title)
{

	if(!userid) {
		$('input[name="auction_key"]').val(key);
		$('input[name="auction_title"]').val(title);
		$('input[name="type"]').val(type);
		$('#fade').css({'visibility' : 'visible'});
		$('.popup_block').css({'visibility' : 'visible'});
	}else{
		$('#fade').css({'visibility' : 'visible'});
		$('.popup_auction').css({'display' : 'block'});
	}

}

function select_color(color_id, product_id)
{
	var color_sel = $("#sel_color").val();
	if(color_sel!=color_id){
		var url = Path+"products/addmore_color/"+color_id+"/"+product_id;
		 $.post(url,function(check){
			  $(".color_"+check).addClass("active");

			  $(".color_"+color_sel).removeClass("active");
			  $("#sel_color").val(color_id);
			    $('.error_size').hide();
                                $('.error_color').hide();
                                $('.error_all').hide();
		});
	}
}

function select_size(size_id, product_id, quantity)
{
	var size_sel = $("#sel_size").val();
	if(size_sel!=size_id){
		var url = Path+"products/addmore_size/"+size_id+"/"+product_id+'/'+quantity;
		$.post(url, function(check){
				$(".size_"+check).addClass("act");
				$(".size_"+size_sel).removeClass("act");
				$("#sel_size").val(size_id);
				$("#sel_quant").val(quantity);
				$('.error_size').hide();
                                $('.error_color').hide();
                                $('.error_all').hide();
		});
   }
}

function check_validation(deal_id)
{
	var nosize = $("#no_size").val();
	var color_count = $("#color_count").val();
	var color_sel = $("#sel_color").val();
	var size_sel = $("#sel_size").val();
	var quan_sel = $("#sel_quant").val();

	if(color_count == 1){
		if(quan_sel != "" && color_sel != "" && nosize != 1){
			window.location.href=Path+"payment_product/cart_items?deal_id="+deal_id;
		}else if(color_sel != "" && nosize == 1){
			window.location.href=Path+"payment_product/cart_items?deal_id="+deal_id;
		}else{
			if(quan_sel == "" && color_sel == "" && nosize != 1){
				$('.error_all').show();
				$('.error_size').hide();
				$('.error_color').hide();
				//$(".new_color").css('border-bottom','1px solid #D6D6D6');
				//$(".new_bid").css('border-bottom','1px solid #D6D6D6');
			}else if(quan_sel == "" && nosize != 1){
				$('.error_size').show();
				$('.error_all').hide();
				$('.error_color').hide();
				//$(".new_bid").css('border-bottom','1px solid #D6D6D6');
			}else if(color_sel == "" && nosize != 1){
				$('.error_color').show();
				$('.error_all').hide();
				$('.error_size').hide();
				//$(".new_color").css('border-bottom','1px solid #D6D6D6');
			}else if(color_sel == "" && nosize == 1){
				$('.error_color').show();
				$('.error_all').hide();
				$('.error_size').hide();
				//$(".new_color").css('border-bottom','1px solid #D6D6D6');
			}
		}
	}else{

		if(quan_sel != "" && nosize == ""){
			window.location.href=Path+"payment_product/cart_items?deal_id="+deal_id;
		}else if(quan_sel == "" && nosize == 1){
			window.location.href=Path+"payment_product/cart_items?deal_id="+deal_id;
		}else if(quan_sel != "" && nosize == 1){
			window.location.href=Path+"payment_product/cart_items?deal_id="+deal_id;
		}else{
			$('.error_size').show();
			//$(".new_bid").css('border-bottom','1px solid #D6D6D6');
		}
	}

}

function remove_cart_item(item)
{
	count = $('input[name="item_count"]').val();
	var url=Path+'payment_product/cart_remove/'+item;

	$.post(url,function(data){
		if(data){
			$('#cart_item_'+data).remove();
			if(parseInt(count)>1){
				count=count-1;
				$('input[name="item_count"]').val(count);
				$('.have_count').text(count);
			}
			else{
				$('#cart_item_0').remove();
				$('.have_count').text('0');
			}
		}
	});

}

/* Add to compare */
function addToCompare(product_id,tis,t) {


	if(tis != ""){
	        var a = $(tis).is(':checked');
	} else {
	        var a = "true";
	}

		var targeturl = Path+"products/add_compare/?product_id="+product_id+"&title="+'&abc=false'+'&action=true'+'&act='+a+'&type='+t;

			$.post(targeturl,function(response)
			{
				//console.log(response); return false;
				if(response)
				{
                                        var lastChar = response.substr(response.length - 1);
                                        var dispaly_response = response.substr(0 , response.length - 1);
                                        if(lastChar > 0 ){ 
                                           var lastChar = response.substr(response.length - 2);
                                           if(lastChar != -1){
                                           var redirecturl = Path+"product-compare.html";
				            $('.addcomper').html("<a href="+redirecturl+" title=My compare>My compare</a>");
				            $('.mnav_dnone').html(" | " );
				            
				            }
				            if(lastChar == -1){
				            var dispaly_response = response.substr(0 , response.length - 2);
				             $('.addcomper').html(" ");
				            }
				            } 
				            if(lastChar == 0 || lastChar == -1 ){
				            $('.addcomper').html(" ");
				            }
					//if(response!=1){
						$('#success_message').html(success_message1(dispaly_response));
						animate_flash(8000);
					//}
					//else{

							if(a){
								$(tis).attr('data-added','1');
								$(tis).attr('checked',true);
							}
							else{
								$(tis).attr('data-added','0');
								$(tis).attr('unchecked',true);
							}

					//}
				}
				else
				{
					$('#success_message').html(error_message1("Error: No Data Found"));
					animate_flash(8000);
				}
			});


}

/* product remove compare */
function RemoveCompare(product_id,act)
{

	var targeturl =(act)?Path+"products/remove_compare/?product_id=d": Path+"products/remove_compare/?product_id="+product_id;
	if(product_id && confirm('Are you sure want to delete?'))
		{
			$.post(targeturl,function(response)
			{
				if(response == 1)
				{
					$('#success_message').html(success_message1("You have modified your product compare!"));
					animate_flash(6000);
					location.reload();
				}
				else
				{
					$('#success_message').html(error_message1("Error: No Data Found"));
					animate_flash(6000);
				}
			});
		}
}

//To animate the div and show flash message
function animate_flash(time) {
	$('html, body').animate({ scrollTop: 0 }, 'slow');
	$('#messagedisplay').animate({opacity: 1.0}, time)
	$('#messagedisplay').fadeOut(time);
	$('#error_messagedisplay').animate({opacity: 1.0}, time)
	$('#error_messagedisplay').fadeOut(time);
}

function success_message1(text)
{
var succ = '<div class="msg_show"  id="messagedisplay"><div class="session_wrap"><div class="session_container"><div class="success_session"><p><span >'+text+'</span></p><div class="close_session_2"><a class="closestatus cur" title="Close"  onclick="return closeerr();" >&nbsp;</a></div></div></div></div></div>'
return succ;
}

function error_message1(text)
{
var succ = '<div class="msg_show" id="error_messagedisplay"><div class="session_wrap"><div class="session_container"><div class="failure_session"><p ><span></span>'+text+'</p><div class="close_session"><a title="CLOSE" title="Close" onclick="return closeerror();" > &nbsp;</a></div></div></div></div></div>';
return succ;
}

function closeerror()
{
$("#error_messagedisplay").hide();
}

//Add to whis list
function addToWishList(product_id,title) {
	var targeturl = Path+"products/add_wishlist/?product_id="+product_id;
		$.post(targeturl,function(response)
		{
			if(response == "1")
			{
				$('#success_message').html(success_message1("Success: You have added "+ title +" to your <a href="+Path+"wishlist.html title='wish list' style='color: #0078CA;text-decoration: underline;'>wish list</a>!"));
				animate_flash(8000);
			}
			else if(response == "2")
			{
				$('#success_message').html(error_message1("Error: You have already added "+ title +" to your <a href="+Path+"wishlist.html title='wish list' style='color: #0078CA;text-decoration: underline;' >wish list</a>!"));
				animate_flash(8000);
			}
			else if(response == "3")
			{
				//$('#success_message').html(success_message1("You must <a onclick='showlogin()' title='login' style='color: #0078CA;text-decoration: underline;' >login</a>&nbsp;or&nbsp;<a onclick='showsignup()' title='create an account' style='color: #0078CA;text-decoration: underline;'>create an account</a> to save the product to your wish list!"));
				//animate_flash(8000);
				showlogin();
			}
			else
			{
				$('#success_message').html(error_message1("Error: No Data Found"));
				animate_flash(8000);
			}
		});
}

function removewishlist(product_id)
{
	if(product_id && confirm('Are you sure want to delete?'))
	{
		window.location.href = Path+"delete-wishlist/"+product_id+".html"
	}
}

function show_page(main,sub,sec,third)
{
	var size = "";
	$('#loading').show();
	$(".size input:checked").each(function() {
		size += this.value+',';
		
	});
	var color = "";
	$(".color input:checked").each(function() {
		color += this.value+',';
	});
	var discount = "";
	$(".discount input:checked").each(function() {
		discount += this.value+',';
	});
	var price = "";
	$(".price input:checked").each(function() {
		price += this.value+',';
	});
	var price_text = $("#amount1").val();
	if(price_text==undefined){
			        var price_text = "";
			}
	if(size != ""){
	$('#size_filter').show();
	} else {
	$('#size_filter').hide();
	}
	if(color != ""){
	$('#color_filter').show();
	}else {
	$('#color_filter').hide();
	}
	if(discount != ""){
	$('#discount_filter').show();
	}else {
	$('#discount_filter').hide();
	}
	if(price != ""){
	$('#price_filter').show();
	}else {
	$('#price_filter').hide();
	}
	if(price_text != ""){
	$('#pricetext_filter').hide();
	}else {
	$('#pricetext_filter').hide();
	}
	var url = Path+"products/load_page_content?size="+size+'&color='+color+'&discount='+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=0';
	$.post(url, function(check){ //alert(check);
		$("#product").html(check);
// for see more pagination
		var url1 = Path+"products/load_page_content?size="+size+'&color='+color+'&discount='+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+"&type=1";
		$.post(url1, function(check1){
			if(check1 <= 12){
				$('#loading').hide();
			}else{
				$('#record1').val(check1);
			}
		});


	});
}

function show_deal_ajax_page(main,sub,sec,third)
{
	$('#loading').show();
	var discount = "";
	$(".discount input:checked").each(function() {
		discount += this.value+',';
	});

	var price = "";
	$(".price input:checked").each(function() {
		price += this.value+',';
	});

	var price_text = $("#amount1").val();
	if(price_text==undefined){
			        var price_text = "";
			}

	if(discount != ""){
	$('#deal_discount_filter').show();
	}else {
	$('#deal_discount_filter').hide();
	}
	if(price != ""){
	$('#deal_price_filter').show();
	}else {
	$('#deal_price_filter').hide();
	}
	if(price_text != ""){
	$('#deal_pricetext_filter').hide();
	}else {
	$('#deal_pricetext_filter').hide();
	}
	var url = Path+"deals/load_page_content?discount="+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=0';
	$.post(url, function(check){ //alert(check);
		$("#deal").html(check);
	});

// for see more pagination
	var url1 = Path+"deals/load_page_content?discount="+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=1';
	$.post(url1, function(check1){ //alert(check);
		if(check1 <= 12){
				$('#loading').hide();
			}else{
				$('#record1').val(check1);
			}
	});
}

function show_auction_ajax_page(main,sub,sec,third)
{
	/*var discount = "";
	$(".discount input:checked").each(function() {
		discount += this.value+',';
	}); */
        $('#loading').show();
	var price = "";
	$(".price input:checked").each(function() {
		price += this.value+',';

	});
	var price_text = $("#amount1").val();
	if(price_text==undefined){
			        var price_text = "";
			}

	if(price != ""){
	$('#auction_price_filter').show();
	}else {
	$('#auction_price_filter').hide();
	}
	if(price_text != ""){
	$('#auction_pricetext_filter').hide();
	}else {
	$('#auction_pricetext_filter').hide();
	}
	var url = Path+"auction/load_page_content?price="+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=0';
	$.post(url, function(check){ //alert(check);
		$(".auction").html(check);
	});

// for see more pagination
	var url1 = Path+"auction/load_page_content?price="+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=1';
	$.post(url1, function(check1){ //alert(check);
		if(check1 <= 12){
				$('#loading').hide();
			}else{
				$('#record1').val(check1);
			}
	});
}

function clear_filter(main,sub,sec,third,fild,t)
{
	$('.'+fild+' input:checked').removeAttr('checked');
	if(t==1){
		show_page(main,sub,sec,third);
	}else if(t==2){
		show_deal_ajax_page(main,sub,sec,third);
	}
	else if (t==3){
		show_auction_ajax_page(main,sub,sec,third);
	}

}

function city_change_merchant(country){
if(country == ''){ var country = -1;  }
	if(country){var url = Path+'/payment_product/CitySelectionPayment/'+country; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		
		success:function(check)
		{
		   $("#CitySD").html(check);
		     $("#CitySD_log").html(check);
		},
		error:function()
		{		        
			alert('No city has been added under this country.');
		}
	});
}

function city_change_payment(country){ 

if(country == ''){ var country = -1;  }
if(country == '-99'){ var country = -1;  }
	if(country){var url = Path+'/payment_product/CitySelectionPayment/'+country; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		   $(".CityPAY").show();
		   $(".CityPAY_new").show();
		   $(".CityPAY_new").html(check);
		   $(".CityPAY").html(check);
		},
		error:function()
		{
			alert('No city has been added under this country.');
		}
	});
}


function city_change_payment_step(country){ 

if(country == ''){ var country = -1;  }
 
	if(country){var url = Path+'/payment_product/CitySelectionPaymentstep/'+country; }
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,
		dataType:"html",
		success:function(check)
		{
		   $("#CitySD").html(check);
		     $("#CitySD_log").html(check);
		},
		error:function()
		{
			alert('No city has been added under this country.');
		}
	});
}

function showfbsignup()
{
	document.fb_signup.email.value='';
	$('#femail_error').html('');
	$('#fade').css({'visibility' : 'visible'});
	$('.popup_block2').css({'display' : 'none'});
	$('.popup_block').css({'display' : 'none'});
	$('.popup_block1').css({'display' : 'none'});
	$('.popup_block4').css({'display' : 'block'});
	
}
function changing_sectors(sector)
{
	if(sector == ''){ var sector = -1;  }
	if(sector=='0')
	{
		$(".subsector_list").hide();
	}else{
		$(".subsector_list").show();
	}

	if(sector){var url = Path+'/seller/change_sector/'+sector; }
	//$.post(url,function(check){ $("#CitySD").html(check); /*document.getElementById('CitySD').innerHTML = check; */});
	$.ajax(
	{
		type:'POST',
		url:url,
		cache:false,
		async:true,
		global:false,

		dataType:"html",
		success:function(check)
		{
		   $("#subSector").html(check);
		},
		error:function()
		{
			alert('No category has been added under this top category.');
		}
	});
}
function filtercategory_store(category_url,type,cat_type,store_url)
{
      if(category_url && type == "products"){
                  window.location.href = Path+store_url+"/products/c/"+cat_type+"/"+category_url+'.html';
      }
      else if(category_url && type == "deal"){
               window.location.href = Path+store_url+"/deal/c/"+cat_type+"/"+category_url+'.html';
      }
       else if(category_url && type == "auction"){
               window.location.href = Path+store_url+"/auction/c/"+cat_type+"/"+category_url+'.html';
      }
       return true;
}

// store credits filter products

function show_page_storecredits(main,sub,sec,third)
{
	var size = "";
	$('#loading').show();
	$(".size input:checked").each(function() {
		size += this.value+',';
		
	});
	var color = "";
	$(".color input:checked").each(function() {
		color += this.value+',';
	});
	var discount = "";
	$(".discount input:checked").each(function() {
		discount += this.value+',';
	});
	var price = "";
	$(".price input:checked").each(function() {
		price += this.value+',';
	});
	var price_text = $("#amount1").val();
	if(price_text==undefined){
			        var price_text = "";
			}
	if(size != ""){
	$('#size_filter').show();
	} else {
	$('#size_filter').hide();
	}
	if(color != ""){
	$('#color_filter').show();
	}else {
	$('#color_filter').hide();
	}
	if(discount != ""){
	$('#discount_filter').show();
	}else {
	$('#discount_filter').hide();
	}
	if(price != ""){
	$('#price_filter').show();
	}else {
	$('#price_filter').hide();
	}
	if(price_text != ""){
	$('#pricetext_filter').hide();
	}else {
	$('#pricetext_filter').hide();
	}
	var url = Path+"products/load_page_content?size="+size+'&color='+color+'&discount='+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+'&type=0';
	$.post(url, function(check){ //alert(check);
		$("#product").html(check);
// for see more pagination
		var url1 = Path+"products/load_page_content?size="+size+'&color='+color+'&discount='+discount+'&price='+price+'&main='+main+'&sub='+sub+'&sec='+sec+'&third='+third+'&price1='+price_text+"&type=1";
		$.post(url1, function(check1){
			if(check1 <= 12){
				$('#loading').hide();
			}else{
				$('#record1').val(check1);
			}
		});


	});
}
