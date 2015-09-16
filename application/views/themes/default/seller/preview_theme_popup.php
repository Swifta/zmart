	
    
    <div class="shadow_bg"></div>
        <div class="sign_up_outer" style="text-align: center;">  
            <div class="sign_up_logo">
                <a href="<?php echo PATH;?>"><img alt="<?php echo $this->Lang['LOGO']; ?>" src="<?php echo PATH;?>themes/<?php echo THEME_NAME; ?>/images/logo.png"/></a>        	
                <a class="close2" title="<?php echo $this->Lang['CLOSE']; ?>" id="close_preview_theme">&nbsp;</a>                
            </div>
            <div class="signup_content clearfix">
                  
                  <img src="" class="preview_theme_selected" style="width:550px; height: 500px; text-align: center; margin:2px auto;" />

            </div>
        </div>
              

<script type="text/javascript">
$(document).ready(function(){
$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer 				   		   
//Close Popups and Fade Layer

$('#close_preview_theme').live('click', function() {
    
		$('.popup_block_theme').css({'display' : 'none'});
		
		$('#fade').css({'visibility' : 'hidden'});
			//  location.reload();
	
	return false;
});


$(document).keyup(function(e) { 
	if (e.keyCode == 27) { // esc keycode
		$('.popup_block_theme').css({'display' : 'none'});
		$('#fade').css({'visibility' : 'hidden'});
	
	
	return false;
	}
});

});

</script>