$(document).ready(function(){
        $('.addcolor').hide();
         $('.addsize').hide();
       $('#add').hide();
       $('#remove').hide();
       var i = $('inputs').size() + 0;
        
    $('#add').click(function() {

        $('#remove').show();
        if(i != 4)  {

        $('<div class="field file-right"><input type="file" class="textbox" name="image[]" value="" onchange="return validateFileExtension(this)" ></div>').fadeIn("slow").appendTo('.inputs');
        
        i++;
        if(i == 4)  {
                $('#add').hide();
        }
        }else{ $('#add').hide(); } 
    });
    
    $('#remove').click(function() {
        if(i > 0) {
        $('#add').show();
        $('.field:last').remove();
        i--;
        if(i==0)
        {
        $('#remove').hide();
        }
        }else if(i == 0){
        alert('No more to remove');
        i = 1;
        return false;
        }
    });
    
    $('#sub').click(function() {
        if(!$('.textbox').val()) {
                alert('Upload the File textbox empty');
        }
    });

});

function validateFileExtension(fld) {

        $('#add').show();
        if(!/(\.png|\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(fld.value)) {
                alert("Invalid image file type.");      
               //fld.form.reset();
                if($('#first').val()) {
                        //fld.form.reset();
                        $('#add').show();
			$('#first').val('');
			$('.field').remove();
			$('#remove').hide();
			
                }
                else if($('.textbox').val())
                {
                        $('.field:last').remove();
			$('#first').val('');
			$('.field').remove();
			$('#remove').hide();
                }
                fld.focus();        
                return false;   
        }   
        return true; 
}




function checkedretailprice(fld)
{
        $('.aramexshipping').hide();
	$('.retailprice').show();
	$('.wholesaleprice').hide();
    return true;
}

function checkedwholesaleprice(fld)
{
        $('.aramexshipping').hide();
	$('.wholesaleprice').show();
	$('.retailprice').hide();
    return true;
}

function checkedaramex(fld)
{
        $('.aramexshipping').show();
	$('.wholesaleprice').hide();
	$('.retailprice').hide();
    return true;
}




$(document).ready(function(){

        
         
       $('#removetext').hide();
       var i = $('inputs').size() + 0;
        
    $('#addtext').click(function() {

        $('#removetext').show();
        if(i != 5)  {

        $('<div class="inputs"><input type="text"  name="color[]" value="" onchange="return validateFileExtensiontext(this)" ></div>').fadeIn("slow").appendTo('.inputs_text');
        
        i++;
        if(i == 5)  {
                $('#addtext').hide();
        }
        }else{ $('#addtext').hide(); } 
    });
    
    $('#removetext').click(function() {
        if(i > 0) {
        $('#addtext').show();
        $('.field:last').remove();
        i--;
        if(i==0)
        {
        $('#removetext').hide();
        }
        }else if(i == 0){
        alert('No more to remove');
        i = 1;
        return false;
        }
    });
    
    $('#sub').click(function() {
        if(!$('.textbox').val()) {
                alert('Upload the File textbox empty');
        }
    });

});

function validateFileExtensiontext(fld) {

        $('#addtext').show();
        
        return true; 
}

function checkedsizeremove(fld){

        $('.addsize').hide();
        
        return true; 
}

function checkedshippingadd(fld){

        $('.addshipping').show();
        
        return true; 
}

function checkedshippingremove(fld){

        $('.addshipping').hide();
        
        return true; 
}

/* Multiple Image upload */
function validateFileExtension1(fld) {

        if(!/(\.png|\.bmp|\.gif|\.jpg|\.jpeg)$/i.test(fld.value)) { 
               var x= alert("Invalid image file type."); 
               if(x==undefined) {
					$('.first').val('');
				}
                     
               //fld.form.reset();
                if($('#first').val('')) {
					
                        //fld.form.reset();
                        $('#first').show();
			$('#first').val('');
			$('.field').remove();
			$('#remove').hide();
			
                }
                else if($('.textbox').val())
                {
                        $('.field:last').remove();
			$('#first').val('');
			$('.field').remove();
			$('#remove').hide();
                }
                fld.focus();        
                return false;   
        }   
    
        return true; 
}

