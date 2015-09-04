
	<div class="near_me_map" style="position:absolute;">
		<?php if (($this->type==1)||($this->type=='')||($this->type==2)) { ?>
		<div id="map_canvas" style="width:100%; height:704px;"></div>
             
               
			<div class="nm_content_mid_container_wrap" id="map_outer_id" style="display:none;">
                               
                            <div class="mid_po clearfix">
                                    <h3 class="top_po"></h3>
                                    <div class="close_button_nm">
                                        <a class="cursor" onclick="closepopup();" title="<?php echo $this->Lang['CLOSE']; ?>">&nbsp;</a>
                                    </div>
                                    <div class="nm_content_mid_container_3" id="map_page_inner">
                                    </div> 
                                </div>
                
				
		</div>
		<?php } elseif($this->type==3) { ?>
		
		<div id="map_canvas" style="width:100%; height:704px;"></div>
                
                
			  
			<div class="nm_content_mid_container_wrap" id="map_outer_id" style="display:none;">
                               
                            <div class="mid_po clearfix">
                                    <h3 class="top_po"></h3>
                                <div class="close_button_nm">
                                        <a class="cursor" onclick="closepopup();" title="<?php echo $this->Lang['CLOSE']; ?>">&nbsp;</a>
                                    </div>
                                    <div class="nm_content_mid_container_3" id="map_page_inner">
                                    </div> 
                            </div>
                
				
		</div>
	<?php } ?>

      </div>
   


  <?php
  
	$this->session = Session::instance();
	$this->city_id = $this->session->get("CityID");
        $latitude = ""; $longitude = "";$cityid = $this->city_id;

        if(isset($this->city_id)){
            $cityid = $this->city_id;
        } 
        foreach($this->all_city_list as $CData){ 
            if($CData->city_id == $cityid){
               $latitude = $CData->city_latitude;
                $longitude = $CData->city_longitude;
            } 
        }
        
		  if(count($this->deals_list) > 0){  // for locate the map pointer to center
        
				foreach($this->deals_list as $Deals){
					if($Deals->latitude && $Deals->longitude){
						 $latitude = $Deals->latitude;
						 $longitude = $Deals->longitude;
						break;
					}
				}
			}
		
  
    ?>
</div> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>

function show_map_popup(store_id,type,str_name)
{

    var url= '<?php echo PATH; ?>'+'welcome/show_deals_popup?store_id='+store_id+"&type="+type;

		 $.post(url,function(check){
					document.getElementById('map_page_inner').innerHTML = check;
					$('.top_po').html(str_name);
					$("#map_outer_id").show();
		});

}
</script>

<script type="text/javascript">

            var map;

            var latlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
            
            var myOptions = {

                        zoom: 7,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        navigationControl: true,
                        mapTypeControl: true,
                        scaleControl: true
                };
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                
/* new map resize */           

google.maps.event.addDomListener(window, 'load');

var side="wide";

function reSize() {

var oldside=map.getBounds().getNorthEast().lng()
if (side=="wide"){
	
document.getElementById("map_canvas").style.width="90%"
side="narr";

	} else {

document.getElementById("map_canvas").style.width="100%"

side="wide";
	} 
google.maps.event.trigger(map,'resize');
var newside=map.getBounds().getNorthEast().lng()
var topan=oldside-newside;
map.setCenter(new google.maps.LatLng(map.getCenter().lat(),map.getCenter().lng()+topan));	
}

/* end new map resize */    

</script>
<div id="slider">
  <ul id="images">
  </ul>
</div>





<script>	



	<?php 	if(($this->type==1)|| ($this->type)=="") { ?>

        <?php 
	 
        if(count($this->deals_list) > 0){  $i=0;
        
        foreach($this->deals_list as $Deals){  if($Deals->latitude && $Deals->longitude){ if($Deals->purchase_count < $Deals->maximum_deals_limit){	
		
		if(count($i)){  ?>	
                  
                var companyImage = new google.maps.MarkerImage(Path+'/images/map_pointer.png',
                        new google.maps.Size(100,50)
                );
                
                <?php } ?>
                
            var companyPos = new google.maps.LatLng(<?php echo $Deals->latitude;?>,<?php echo $Deals->longitude; ?>);
            var companyMarker = new google.maps.Marker({
                position: companyPos,
                map: map,
                icon: companyImage,
         	
                title:""});
              
                                             
                google.maps.event.addListener(companyMarker, 'click', function() {
                        show_map_popup('<?php echo $Deals->shop_id; ?>','1','<?php echo ucfirst($Deals->store_name); ?>');  
		               
                });
            
            
    <?php } $i++; }}  }  ?>



	<?php } else if(($this->type==2)&& ($this->type!=1) && ($this->type!='')){ ?>

	        <?php 
	 
        if(count($this->deals_list) > 0){  $i=0;
        
        foreach($this->deals_list as $Deals){  if($Deals->latitude && $Deals->longitude){if($Deals->purchase_count < $Deals-> user_limit_quantity){ 	
		
		if(count($i)){  ?>	
                  
                var companyImage = new google.maps.MarkerImage('<?php echo PATH; ?>'+'/images/map_pointer.png',
                        new google.maps.Size(100,50)
                );
                
                <?php } ?>
                
            var companyPos = new google.maps.LatLng(<?php echo $Deals->latitude;?>,<?php echo $Deals->longitude; ?>);
            var companyMarker = new google.maps.Marker({
                position: companyPos,
                map: map,
                icon: companyImage,
        	
                title:""});
              
                                             
                google.maps.event.addListener(companyMarker, 'click', function() {
                        show_map_popup('<?php echo $Deals->shop_id; ?>','2','<?php echo ucfirst($Deals->store_name); ?>');  
		               
                });
            
            
   	 <?php } $i++; }}  }  ?>
	

	<?php  } else { ?>
	        <?php 
	 
        if(count($this->deals_list) > 0){  $i=0;
        
        foreach($this->deals_list as $Deals){  if($Deals->latitude && $Deals->longitude){
		
		if(count($i)){  ?>	
                  
                var companyImage = new google.maps.MarkerImage(Path+'/images/map_pointer.png',
                        new google.maps.Size(100,50)
                );
                
                <?php } ?>
                
            var companyPos = new google.maps.LatLng(<?php echo $Deals->latitude;?>,<?php echo $Deals->longitude; ?>);
            var companyMarker = new google.maps.Marker({
                position: companyPos,
                map: map,
                icon: companyImage,
             	
                title:""});
              
                                             
                google.maps.event.addListener(companyMarker, 'click', function() {
                        show_map_popup('<?php echo $Deals->shop_id; ?>','3','<?php echo ucfirst($Deals->store_name); ?>');  
		               
                });
            
            
   	 <?php } $i++; }  }  ?>


	<?php } ?>

	
	function closepopup(){
	
		$("#map_outer_id").hide();
	}

</script>



