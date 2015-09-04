	<style>
	
	.map_outer{float:left;clear:both;width: 684px;background:#000;height:120px;z-index:9;position:relative;margin:-120px 0 0 0;opacity:0.7;filter: alpha(opacity = 70);}
	.map_inner{float:left;z-index:10; position:relative;width:680px;height:100px;margin:10px 0 0 10px;clear:both;margin:-120px 0 0 0;}
	.map_inner_content{float:left;width:360px;margin:10px 0 0 10px;padding-right:15px;}
	
	.map_inner_content h5{font:bold 18px Arial, Helvetica, sans-serif;color:#fff;width:auto;clear:both;padding-bottom:5px;}
	.map_inner_content h6{font:bold 15px Arial, Helvetica, sans-serif;color:#fff;width:auto;clear:both;padding-bottom:5px;}
	.map_inner_content p{font:bold 13px Arial, Helvetica, sans-serif;color:#fff;width:auto;clear:both;padding-bottom:5px;}
	.map_inner_content span{font:normal 12px Arial, Helvetica, sans-serif;color:#fff;width:auto;clear:both;padding-bottom:5px;}
	.map_see_all{float:left;width:87px;height:32px;margin:40px 0 0 0;}
	.map_close{float:left;width:15px;height:15px;margin:5px 0 0 5px; cursor:pointer;}
	.map_deal_image{float:left;margin:6px 0 0 10px;opacity:1.0;border:4px solid #000;}
	
	</style>

    <div id="map_canvas" style="width:684px; height:265px; margin-bottom:13px; "></div>
    
    <div id="map_outer_id" style="display:none;">
    <div class="map_outer"></div>   
    <div  class="map_inner">
        <img class="map_deal_image" id="mapdealimage" height="100" />
        <div class="map_inner_content">
            <h5 id="mapdealtitle"></h5>
        </div>
        <a  class="map_see_all" id="mapdealdetail" target="_blank"  >
        	<img src="<?php echo PATH;?>images/map/see_deal.png" />
        </a>
        <a   title="close" class="map_close" onclick="return closepopup();">
        	<img src="<?php echo PATH;?>images/map/close.png" />
        </a>
  </div>
        </div>
	<?php 
        $latitude = ""; $longitude = "";$cityid = $this->city_id;
        if(isset($this->current_cityid)){
            $cityid = $this->current_cityid;
        } 
        foreach($this->all_city_list as $CData){ 
            if($CData->city_id == $cityid){
               $latitude = $CData->city_latitude;
                $longitude = $CData->city_longitude;
            } 
        }
    ?>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">

            var latlng = new google.maps.LatLng(<?php echo $latitude;?>,<?php echo $longitude;?>);
            var settings = {
                zoom: 5,
                center: latlng,
                mapTypeControl: true,
                mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                navigationControl: true,
                navigationControlOptions: {style: google.maps.NavigationControlStyle.LARGE},
                mapTypeId: google.maps.MapTypeId.ROADMAP};
            var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
    </script>	
    <script>	
        <?php
        if(count($this->deals_lists) > 0){ 
        foreach($this->deals_lists as $Deals){  if($Deals->latitude && $Deals->longitude){	
	
		$categoryURL = "others";
	        foreach($this->category_list as $cateD){
			if($Deals->category_id == $cateD->category_id ){	
                    $categoryURL = $cateD->category_url;
		}}
                ?>		  
            var companyImage = new google.maps.MarkerImage(Path+'/images/pointer.png',
                new google.maps.Size(100,50),
                new google.maps.Point(0,0),
                new google.maps.Point(50,50)
            );

            var companyShadow = new google.maps.MarkerImage(Path+'/images/map/logo_shadow.png',
                new google.maps.Size(130,50),
                new google.maps.Point(0,0),
                new google.maps.Point(65, 50));

            var companyPos = new google.maps.LatLng(<?php echo $Deals->latitude;?>,<?php echo $Deals->longitude; ?>);
            var companyMarker = new google.maps.Marker({
                position: companyPos,
                map: map,
                icon: companyImage,
                //shadow: companyShadow,
                title:"deal"});
                
                google.maps.event.addListener(companyMarker, 'click', function() {
					 
	        <?php 
		$imgpath = "images/deals/15090/".$Deals->deal_key.$Deals->deal_id.".jpg"; 
		if(!file_exists(DOCROOT.$imgpath)){
			$imgpath = "themes/".THEME_NAME."/images/noimage.png";
		}	
		$imgpath = PATH.$imgpath;		
		$dealUrl = PATH.$Deals->city_url."/".$Deals->url_title."--".$Deals->deal_key."/frame/";
	        ?>
		document.getElementById('mapdealtitle').innerHTML = '<?php echo mysql_escape_string($Deals->deal_title); ?>';
		document.getElementById('mapdealimage').src = '<?php echo $imgpath; ?>';
		document.getElementById('mapdealdetail').href = '<?php echo $dealUrl; ?>';
		$("#map_outer_id").show();
                
            });
    
    <?php }}  } ?>
	
	function closepopup(){
	
		$("#map_outer_id").hide();
	}

</script>
