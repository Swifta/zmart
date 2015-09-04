<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
 <channel>
    <title><?php echo ucfirst(SITENAME); ?> - Daily Deals</title>
    <link><?php echo PATH; ?></link>
    <description><?php if(CITY_SETTING) {  echo ucfirst($this->city_name); } ?></description>
    <language>en-US</language>
    <copyright><?php echo date("Y",strtotime("-1 year"))."-".date("Y")?> <?php echo ucfirst(SITENAME); ?>. All rights reserved.</copyright>
    <updated><?php echo date(DATE_RFC3339, time());?></updated>
    <image>
      <url><?php echo PATH; ?>themes/<?php echo THEME_NAME;?>/images/logo.png</url>
      <title><?php echo ucfirst(SITENAME); ?> - Daily Deals</title>
      <link><?php echo PATH; ?></link>
    </image>
<?php foreach($this->rss_deals_list as $Deals){?>
    <item>
	<link><?php echo PATH.$Deals->store_url_title.'/deals/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?></link>
	<title><?php  echo str_replace("&",'&#38;',$Deals->deal_title); ?></title>
	<pubDate><?php echo date(DATE_RFC3339, $Deals->created_date);?></pubDate>
    	<description>&lt;div&gt;&lt;a href="<?php echo PATH.$Deals->store_url_title.'/deals/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?>"&gt;&lt;img border="0" src="<?php echo PATH."images/deals/1000_800/".$Deals->deal_key."_1.png";?>" /&gt;&lt;/a&gt;&lt;/div&gt;
    &lt;div&gt;&lt;p/&gt;  <?php echo str_replace(array("&", '"','[.]'),'', strip_tags($Deals->deal_description)); ?>&lt;/p&gt;&lt;/div&gt;
  	 </description>
	<category><?php echo str_replace("&", "&amp;", $Deals->category_name); ?></category>
	<price><?php  echo $Deals->deal_value; ?></price>
	<value><?php  echo $Deals->deal_price; ?></value>
	<savings><?php  echo $Deals->deal_savings; ?></savings>
	<discount><?php  echo round($Deals->deal_percentage); ?>%</discount>
	<imageURL><?php echo PATH."images/deals/1000_800/".$Deals->deal_key."_1.png";?></imageURL>
	<DealEndDate><?php echo date(DATE_RFC3339, $Deals->startdate);?></DealEndDate>
	<DealExpiryDate><?php echo date(DATE_RFC3339, $Deals->enddate);?></DealExpiryDate>
	<merchant>
		<name><?php echo str_replace("&", "&amp;", $Deals->store_name); ?></name>
		<address><?php echo str_replace("&", "&amp;", $Deals->address1); ?>, <?php echo str_replace("&", "&amp;", $Deals->address2); ?></address>
		<latitude><?php  echo $Deals->latitude; ?></latitude>
		<longitude><?php  echo $Deals->longitude; ?></longitude>
		<CityName><?php if(CITY_SETTING) { echo str_replace("&", "&amp;", $Deals->city_name); } ?></CityName>
		<url><?php echo str_replace("&", "&amp;", $Deals->website); ?></url>
	</merchant>
	
    </item>
<?php } ?>	
	<item>
		<title><?php echo ucfirst(SITENAME); ?> - Daily Products</title>
		<link><?php echo PATH; ?></link>
	</item>
	
<?php foreach($this->rss_products_list as $Deals){?>
    <item>
	<link><?php echo PATH.$Deals->store_url_title.'/product/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?></link>
	<title><?php  echo str_replace("&",'&#38;',$Deals->deal_title); ?></title>
	<pubDate><?php echo date(DATE_RFC3339, $Deals->created_date);?></pubDate>
    	<description>&lt;div&gt;&lt;a href="<?php echo PATH.$Deals->store_url_title.'/product/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?>"&gt;&lt;img border="0" src="<?php echo PATH."images/products/1000_800/".$Deals->deal_key."_1.png";?>" /&gt;&lt;/a&gt;&lt;/div&gt;
    &lt;div&gt;&lt;p/&gt;  <?php echo str_replace(array("&", '"','[.]'),'', strip_tags($Deals->deal_description)); ?>&lt;/p&gt;&lt;/div&gt;
  	 </description>
	<category><?php echo str_replace("&", "&amp;", $Deals->category_name); ?></category>
	<price><?php echo $Deals->deal_value; ?></price>
	<value><?php  echo $Deals->deal_price; ?></value>
	<savings><?php  echo $Deals->deal_savings; ?></savings>
	<discount><?php  echo round($Deals->deal_percentage); ?>%</discount>
	<imageURL><?php echo PATH."images/products/1000_800/".$Deals->deal_key."_1.png";?></imageURL>
	
	<merchant>
		<name><?php echo str_replace("&", "&amp;", $Deals->store_name); ?></name>
		<address><?php echo str_replace("&", "&amp;", $Deals->address1); ?>, <?php echo str_replace("&", "&amp;", $Deals->address2); ?></address>
		<latitude><?php  echo $Deals->latitude; ?></latitude>
		<longitude><?php  echo $Deals->longitude; ?></longitude>
		<CityName><?php if(CITY_SETTING) { echo str_replace("&", "&amp;", $Deals->city_name); } ?></CityName>
		<url><?php echo str_replace("&", "&amp;", $Deals->website); ?></url>
	</merchant>
	
    </item>
<?php } ?>	
<item>
		<title><?php echo ucfirst(SITENAME); ?> - Daily Auctions</title>
		<link><?php echo PATH; ?></link>
	</item>
<?php foreach($this->rss_auction_list as $Deals){?>
    <item>
	<link><?php echo PATH.$Deals->store_url_title.'/auction/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?></link>
	<title><?php  echo str_replace("&",'&#38;',$Deals->deal_title); ?></title>
	<pubDate><?php echo date(DATE_RFC3339, $Deals->created_date);?></pubDate>
    	<description>&lt;div&gt;&lt;a href="<?php echo PATH.$Deals->store_url_title.'/auction/'.$Deals->deal_key.'/'.$Deals->url_title.'.html';?>"&gt;&lt;img border="0" src="<?php echo PATH."images/auction/1000_800/".$Deals->deal_key."_1.png";?>" /&gt;&lt;/a&gt;&lt;/div&gt;
    &lt;div&gt;&lt;p/&gt;  <?php echo str_replace(array("&", '"','[.]'),'', strip_tags($Deals->deal_description)); ?>&lt;/p&gt;&lt;/div&gt;
  	 </description>
	<category><?php echo str_replace("&", "&amp;", $Deals->category_name); ?></category>
	<price><?php echo $Deals->deal_value; ?></price>
	<value><?php  echo $Deals->deal_price; ?></value>
	<savings><?php  echo $Deals->deal_savings; ?></savings>
	
	<imageURL><?php echo PATH."images/auction/1000_800/".$Deals->deal_key."_1.png";?></imageURL>
	
	<merchant>
		<name><?php echo str_replace("&", "&amp;", $Deals->store_name); ?></name>
		<address><?php echo str_replace("&", "&amp;", $Deals->address1); ?>, <?php echo str_replace("&", "&amp;", $Deals->address2); ?></address>
		<latitude><?php  echo $Deals->latitude; ?></latitude>
		<longitude><?php  echo $Deals->longitude; ?></longitude>
		<CityName><?php if(CITY_SETTING) { echo str_replace("&", "&amp;", $Deals->city_name); } ?></CityName>
		
	</merchant>
	
    </item>
<?php } ?>	

  </channel>
  
</rss>




<?php /**


<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<feed  xml:lang="en-US"  xmlns="http://www.w3.org/2005/Atom">
  <id>tag:<?php echo PATH; ?>cities/<?php echo $this->atom_city_url; ?></id>
  <link type="text/html" rel="alternate" href="<?php echo PATH; ?>"/>
  <link type="application/atom+xml" rel="self" href="<?php echo PATH; ?>cities/<?php echo $this->atom_city_url; ?>.atom"/>
  <title><?php echo ucfirst(SITENAME); ?> Deals - <?php echo ucfirst($this->city_name); ?></title>
  <updated><?php echo date(DATE_RFC3339, time());?></updated><?php foreach($this->rss_deals_list as $Deals){ ?>
  <entry>
    <id>tag:<?php echo PATH; ?>cities/<?php echo $this->atom_city_url."/".$Deals->deal_id; ?></id>
    <published><?php echo date(DATE_RFC3339, $Deals->startdate); ?></published>
    <updated><?php echo date(DATE_RFC3339, time()); ?></updated>
    <link type="text/html" rel="alternate" href="<?php echo PATH."deal/".$Deals->deal_id."/".$Deals->deal_key;?>"/>
    <city><?php echo $this->city_name; ?></city>
    <title><?php  echo str_replace("&",'&#38;',$Deals->deal_title); ?></title>
    <price><?php echo $Deals->deal_price - $Deals->deal_savings;?></price>
    <value><?php echo $Deals->deal_price;?></value>
    <savings><?php echo $Deals->discount_percentage;?>%</savings><?php if($Deals->merchant_name){ ?>

    <merchant_name><?php echo ucfirst(str_replace("&",'&#38;',$Deals->merchant_name)); ?></merchant_name><?php } $imgpath = "images/deals/".$Deals->deal_key.$Deals->deal_id.".jpg"; if(!file_exists(DOCROOT.$imgpath)){ $imgpath = "themes/".THEME_NAME."/images/noimage.png";}?>
    <image_url><?php echo PATH.$imgpath;?></image_url><?php $categoryName = "Others"; if($Deals->category_id){foreach($this->category_list as $cat_id){ if($cat_id->category_id == $Deals->category_id){ $categoryName = $cat_id->category_name; } } }?>

    <category><?php echo str_replace("&", "&amp;", $categoryName); ?></category>
    <offer_ends_at><?php echo date(DATE_RFC3339, $Deals->enddate); ?></offer_ends_at>
    <description><?php echo str_replace(array("&", '"','[.]'),'', strip_tags($Deals->deal_description)); ?></description>
    <content type="html">&lt;h1&gt;<?php echo str_replace("&",'&#38;',$Deals->deal_title); ?>&lt;/h1&gt;
      &lt;div &gt;&lt;div&gt;&lt;a href="<?php echo PATH."deal/".$Deals->deal_id."/".$Deals->deal_key;?>"&gt;&lt;img border="0" src="<?php echo PATH.$imgpath;?>" /&gt;&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;
    &lt;div&gt;&lt;p/&gt;  <?php echo str_replace(array("&", '"','[.]'),'', strip_tags($Deals->deal_description)); ?>&lt;/p&gt;&lt;/div&gt;
    &lt;br/&gt;
   </content>
   <updated><?php echo date(DATE_RFC3339, time()); ?></updated>
    <author>
      <name><?php echo ucfirst(SITENAME); ?></name>
    </author>
  </entry><?php } ?>
</feed>  **/
