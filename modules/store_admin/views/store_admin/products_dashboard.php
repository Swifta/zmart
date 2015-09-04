<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript"> 
$(document).ready(function(){
     $('.scr_month').hide();
     $('.scr_year').hide();
    $("#ui-datepicker-div").hide();
    var myDate = new Date(); 	
    var prettyDate =(myDate.getMonth()+1) + '/' + myDate.getDate() + '/' +
    myDate.getFullYear();

	if($('#enddat').val()=='' || $('#startdat').val()==''){
		$("#enddat").val(prettyDate);
		$("#startdat").val(prettyDate);
	}
    $.noConflict();
    var startDateTextBox = $('#startdat');
    var endDateTextBox = $('#enddat');
    startDateTextBox.datepicker({ 
        minDate:'-30Y',
        maxDate:0,
        onClose: function(dateText, inst) {
            if (endDateTextBox.val() != '') {
                var testStartDate = startDateTextBox.datepicker('getDate');
                var testEndDate = endDateTextBox.datepicker('getDate');
                if (testStartDate > testEndDate)
                endDateTextBox.datepicker('setDate', testStartDate);
            }
            else {
                endDateTextBox.val(dateText);
            }
        },
        onSelect: function (selectedDate){
            endDateTextBox.datepicker('option', 'minDate', startDateTextBox.datepicker('getDate') );
        }
    });
    endDateTextBox.datepicker({ 
        minDate:'-30Y',
        maxDate:0,
        onClose: function(dateText, inst) {
            if (startDateTextBox.val() != '') {
                var testStartDate = startDateTextBox.datepicker('getDate');
                var testEndDate = endDateTextBox.datepicker('getDate');
                if (testStartDate > testEndDate)
                startDateTextBox.datepicker('setDate', testEndDate);
            }
            else {
                startDateTextBox.val(dateText);
            }
        },
        onSelect: function (selectedDate){
            startDateTextBox.datepicker('option', 'maxDate', endDateTextBox.datepicker('getDate') );
        }
    });
});
</script>
<div class="bread_crumb"><a href="<?php echo PATH."store-admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top">
        <div class="top_left"></div>
        <div class="top_center"></div>
        <div class="top_rgt"></div>        
    </div>
    <div class="content_middle">
<form class="admin_form"  action="" method="get" >
    <label> <b class="search_deal_title"><?php echo $this->Lang['SRCH_PRO_TRANS']; ?> :  </b></label>
    
    <div class="date_range_common">            
        <div class="list_table1 fl clr date_range_part">
            <div class="date_range_lft">
                <label><?php echo $this->Lang['START_DATE']; ?> :</label>        
                <span><input type="text" id="startdat" name="start_date" readonly="readonly"  value="<?php if(isset($this->start_date)){ echo $this->start_date; }?>"></span>
            </div>
            <div class="date_range_right">
               <label><?php echo $this->Lang['END_DATE']; ?> :</label>        
               <span><input type="text" name="end_date" id="enddat" readonly="readonly" value="<?php if(isset($this->end_date)){ echo $this->end_date; }?>"></span>
            </div>        
        </div>
        <div class="date_range_bottm" >    
                <div class="date_range_submit">
                <input type="submit" title="<?php echo $this->Lang['SEARCH']; ?>" value="<?php echo $this->Lang['SEARCH']; ?>" />
                </div>
             <div class="cancel_button_common">
            <?php   if(isset($this->end_date)){  ?>    
                <input class="search_cancel" type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick='window.location.href="<?php echo PATH?>store-admin/products-dashboard.html"'/>                    
            <?php } ?>
             </div>
        </div>
    </div>
</form>
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/highcharts.js"></script>
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/exporting.js"></script>    
	<?php $c = $this->deals_dashboard_data; ?>    

 <?php    
     $date_count="";  
     if(isset($this->end_date)){   
     $date_count=((strtotime($this->end_date)+86400)-strtotime($this->start_date))/86400;
     }
    // print_r($date_count);exit;
     /*********************** Transaction List Chart Start ************************/
    
    $tra_con = '';
    $tra_val = '';
    $tra_pro = '';    
    
    if(count($this->transaction_list)>0){    
         $j = 0;  
         $p = 0;     
         if($date_count==""){
         $date_count = "30";
         } else { 
         $date_count = $date_count;
         }        
          
        for($i=0;$i<$date_count;$i++)
                {                                      
                foreach($this->transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;                                            
                           
                        $k=$i+1;
                        if(isset($this->end_date)){ 
                         $start=strtotime($this->start_date)+ (86400*$i);
                         $end=($start+86400);     
                         $date=date("M/d", strtotime($this->start_date)+ (86400*$i) ) ;
                        } else {  
                         $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                         $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y")); 
                         $date=date("M/d", strtotime("-$i day") ) ;                       
                        }
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                            if($transaction->deal_type==2){  
                                $p +=1; 
                            } else {
                                $j +=1; 
                            }              
                               
                        }
                }
               
          $tra_con .= "'".$date."',"; 
          $tra_val .= $j.',';  
          $tra_pro .= $p.','; 
          $j=0;
          $p=0;         
         
         } 
    } 
    /*********************** Transaction List For Month Chart Start ************************/
    
    $tra_month_con = '';
    $tra_month_val = ''; 
    $tra_month_pro = '';    
    
    if(count($this->transaction_list)>0){    
        $j = 0;       
        for($i=0;$i<=11;$i++)
                {                                  
                foreach($this->transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                                                
                        $start=strtotime(date("Y-m-1", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $end=strtotime(date("Y-m-t", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $date=date("M/Y", strtotime("-$i month", strtotime(date("F") . "1")) ) ;
                        $k=$i+1;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                              if($transaction->deal_type==2){  
                                $p +=1; 
                            } else {
                                $j +=1; 
                            }               
                        }
                }
          $tra_month_con .= "'".$date."',"; 
          $tra_month_val .= $j.',';  
          $tra_month_pro .= $p.','; 
          $j=0;
          $p=0;
         }    
    }  
    
    
    
    /*********************** Transaction List For year Chart Start ************************/
    
    $tra_year_con = '';
    $tra_year_val = '';  
    $tra_year_pro = '';   
    
    if(count($this->transaction_list)>0){    
        $j = 0;       
        for($i=0;$i<=9;$i++)
                {                                  
                foreach($this->transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                                                
                        $start=strtotime(date("Y-1-1", strtotime("-$i year"))) ;
                        $end=strtotime(date("Y-12-t", strtotime("-$i year")));
                        $date=date("Y", strtotime("-$i year") ) ;
                        $k=$i+1;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                            if($transaction->deal_type==2){  
                                $p +=1; 
                            } else {
                                $j +=1; 
                            }                
                        }
                }
          $tra_year_con .= "'".$date."',"; 
          $tra_year_val .= $j.','; 
          $tra_year_pro .= $p.',';  
          $j=0;
          $p=0;
         }    
    } 
  ?>
   
   
   
    <?php 
    $yp = 0; 
    $yd = 0; 
    $ap = 0; 
    $ad = 0; 
    if(count($this->deals_transaction_list)>0){    
                                         
                foreach($this->deals_transaction_list as $transaction){
                       
                            if($transaction->deal_type==2){                           
                               $yp +=1;   
                               $ap +=$transaction->deal_value;      
                            } else { 
                               $yd +=1;
                               $ad +=$transaction->deal_value;                            
                            }            
                       }
                }


   
   ?>
   
   
      <?php 
    $dpa = 0;  
    $dda = 0;  
    $dpc = 0;  
    $ddc = 0;
    if(count($this->deals_transaction_list)>0){       
        
        for($i=0;$i<1;$i++)
                {                                  
                foreach($this->deals_transaction_list as $transaction){                       
                        $transactiondate=$transaction->transaction_date;                        
                        $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                            if($transaction->deal_type==2){
                               $dpa += $transaction->deal_value;
                               $dpc += 1;  
                            } else { 
                               $dda +=$transaction->deal_value;
                               $ddc +=1; 
                            }
                        
                        }
                }

         }  
    
    }    
   
        $mpa = 0;  
        $mda = 0; 
        $mpc = 0;  
        $mdc = 0; 
    if(count($this->deals_transaction_list)>0){    
          
        
        for($i=0;$i<30;$i++)
                {                                  
                foreach($this->deals_transaction_list as $transaction){
                       
                        $transactiondate=$transaction->transaction_date;                        
                        $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $k=$i+1;
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                            if($transaction->deal_type==2){
                               $mpc +=1; 
                               $mpa +=$transaction->deal_value;                                 
                            } else { 
                               $mdc +=1; 
                               $mda +=$transaction->deal_value;                               
                            }
                        
                        }
                }
                
         }        
    } 
        $ypa = 0; 
        $yda = 0;
        $ypc = 0; 
        $ydc = 0;
    if(count($this->deals_transaction_list)>0){    
             
        for($i=0;$i<=11;$i++)
                {                                  
                foreach($this->deals_transaction_list as $transaction){
                        $transactiondate=$transaction->transaction_date;
                                            
                        $start=mktime(0, 0, 0, date("m")-$i  , date("d"), date("Y"));
                        $end=mktime(0, 0, 0, date("m")-$i+1  , date("d"), date("Y"));
                        $k=$i+1;
                        $date=date("M/d", strtotime("-$i month") ) ;
                        if(($start <= $transactiondate) && ( $end >= $transactiondate)) {
                             if($transaction->deal_type==2){
                               $ypc +=1;
                               $ypa +=$transaction->deal_value;                                 
                            } else { 
                               $ydc +=1; 
                               $yda +=$transaction->deal_value;
                                
                            }       
                        }
                }
         }  
    } 
     
 ?>

<script type="text/javascript">
//<![CDATA[
Highcharts.theme = {
   colors: ['#ff9b02', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
   chart: {
      backgroundColor: {
         linearGradient: [0, 0, 500, 500],
         stops: [
            [0, 'rgb(255, 255, 255)'],
            [1, 'rgb(240, 240, 255)']
         ]
      },
      borderWidth: 2,
      plotBackgroundColor: 'rgba(255, 255, 255, .9)',
      plotShadow: true,
      plotBorderWidth: 1
   },
   title: {
      style: {
         color: '#000',
         font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   subtitle: {
      style: {
         color: '#666666',
         font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
      }
   },
   xAxis: {
      gridLineWidth: 1,
      lineColor: '#000',
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'

         }
      }
   },
   yAxis: {
      minorTickInterval: 'auto',
      lineColor: '#000',
      lineWidth: 1,
      tickWidth: 1,
      tickColor: '#000',
      labels: {
         style: {
            color: '#000',
            font: '11px Trebuchet MS, Verdana, sans-serif'
         }
      },
      title: {
         style: {
            color: '#333',
            fontWeight: 'bold',
            fontSize: '12px',
            fontFamily: 'Trebuchet MS, Verdana, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         font: '9pt Trebuchet MS, Verdana, sans-serif',
         color: 'black'

      },
      itemHoverStyle: {
         color: '#039'
      },
      itemHiddenStyle: {
         color: 'gray'
      }
   },
   labels: {
      style: {
         color: '#99b'
      }
   }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
// Last 30 Day's Transaction Reports

var chart;
$(document).ready(function() {
    chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container_line',
			type: 'line',
			marginRight: 130,
			marginBottom: 15
		},
		<?php if(isset($this->end_date)){?>
		title: {
			text: "<?php echo $this->Lang['SRCH_REP_FR']; ?> <?php echo date('d/M/Y', strtotime($this->start_date) ); ?> <?php echo $this->Lang['TO']; ?> <?php echo date('d/M/Y', strtotime($this->end_date) ); ?>",
			x: -30 //center
		},
		<?php } else { ?>
		title: {
			text: "<?php echo $this->Lang['LAST_TRANS_REP']; ?>",
			x: -30 //center
		},
		<?php } ?>
		
		xAxis: {
			categories: [<?php echo $tra_con; ?>]
		},
		yAxis: {
			title: {
				text: '<?php echo $this->Lang["TRANS_COUNT"]; ?>'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b>'+
					this.x +': '+ this.y ;
			}
		},		
		
		series: [{
			name: '<?php echo $this->Lang["TRANS"]; ?>',
			data: [<?php echo $tra_pro; ?>]
		}]
	});
});



//Last 12 Month's Transaction Reports

var chart;
$(document).ready(function() {
    chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container_month_line',
			type: 'line',
			marginRight: 130,
			marginBottom: 15
		},
		title: {
			text: "<?php echo $this->Lang['LST_TWENTY_DL_REP']; ?>",
			x: -30 //center
		},
		
		xAxis: {
			categories: [<?php echo $tra_month_con; ?>]
		},
		yAxis: {
			title: {
				text: '<?php echo $this->Lang["TRANS_COUNT"]; ?>'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b>'+
					this.x +': '+ this.y ;
			}
		},		
		
		series: [{
			name: '<?php echo $this->Lang["TRANS"]; ?>',
			data: [<?php echo $tra_month_pro; ?>]
		}]
	});
});


// Last 10 year's Transaction Reports

var chart;
$(document).ready(function() {
    chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container_year_line',
			type: 'line',
			marginRight: 130,
			marginBottom: 15
		},
		title: {
			text: "<?php echo $this->Lang['LST_TEN_YR_DL_REP']; ?>",
			x: -30 //center
		},
		
		xAxis: {
			categories: [<?php echo $tra_year_con; ?>]
		},
		yAxis: {
			title: {
				text: '<?php echo $this->Lang["TRANS_COUNT"]; ?>'
			},
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b>'+
					this.x +': '+ this.y ;
			}
		},		
		
		series: [{
			name: '<?php echo $this->Lang["TRANS"]; ?> ',
			data: [<?php echo $tra_year_pro; ?>]
		}]
	});
});

$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
    
            chart: {
                renderTo: 'container',
                type: 'column'
            },
    
            title: {
                text: '<?php echo $this->Lang["TOT_PRO_CUNT"]; ?>'
            },
    
            xAxis: {
                categories: ['<?php echo $this->Lang["PRO_CUNT"]; ?>']
            },
    
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: '<?php echo $this->Lang["NUM_OF_PROS"]; ?>'
                }
                
            },
    
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br />'+
                        this.series.name +': '+ this.y +'<br />'+
                        'Total: '+ this.point.stackTotal;
                }
            },
    
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
    
            series: [ {
                name: '<?php echo $this->Lang['ACTIVE_PRODUCTS']; ?>',
                data: [<?php echo $c["active_products"]?>],
                stack: 'male'
            },{
                name: '<?php echo $this->Lang['SOLD_PRODUCTS']; ?>',
                data: [<?php echo $c["archive_products"]?>],
                stack: 'male'
            }]
        });
    });
    
});
//]]>

/************************************* Leads END **********************************/
</script> 

<?php if(isset($this->end_date)){ } else {?>
<div class="deal_dash_topn">
  <div id="container" class="chart_2 fl" style="width:390px; height:445px;"></div>
  <div class="fl"  style="width:310px;">
    <div class="invest-cl">
      <div class="invest-cr">
        <div class="inves_marketing">
          <h3 class="market"><?php echo $this->Lang['MAR_RESP_RATE']; ?></h3>
          <div class="invest-cl">
            <div class="invest-cr">
              <div class="invest-cm">
		 <p class="clearfix"> <span><?php echo $this->Lang["TOT_PRO_CUNT"]; ?> </span> <span class="right_1">  <?php echo $c["active_products"]+$c["archive_products"];?></span></p>
                
                <div class="prcess_bar3">
                  <div class="pro_left"></div>
                  <div class="pro_mid" style="width:95%"> </div>
                  <div class="pro_rgt"> </div>
                </div>
                 <p class="clearfix">
		    <span><a href="<?php  echo PATH; ?>store-admin/manage-products.html"><?php echo $this->Lang['ACTIVE_PRODUCTS']; ?> <?php echo $this->Lang['COUNT']; ?> </a></span>
		    <span class="right_1"> <?php echo $c["active_products"]?></span>
		 </p>
                <div class="prcess_bar1">
			<?php $act_tot=""; if(($c["active_products"]!=0)||($c["archive_products"]!=0)){$act_tot= ($c["active_products"]/($c["active_products"]+$c["archive_products"]))*100;  }?>
			      <?php  if($act_tot){?> 
                  <div class="pro_left"></div>
                  <div class="pro_mid" style="width:<?php echo round($act_tot-5);?>%;"> </div>
                  <div class="pro_rgt"> </div>
                  <?php } ?>
                </div>
                <p class="clearfix">
            <span><a href="<?php  echo PATH; ?>store-admin/sold-products.html"><?php echo $this->Lang['SOLD_PRODUCTS']; ?> <?php echo $this->Lang['COUNT']; ?> </a></span>
            <span class="right_1"> <?php echo $c["archive_products"];?></span>
        </p>
                <div class="prcess_bar2">
			<?php $arc_tot= ""; if(($c["active_products"]!=0)||($c["archive_products"]!=0)){$arc_tot= ($c["archive_products"]/($c["active_products"]+$c["archive_products"]))*100; }?>
			      <?php  if($arc_tot){?>  
                  <div class="pro_left"></div>
                  <div class="pro_mid" style="width:<?php echo round($arc_tot-5);?>%;"> </div>
                  <div class="pro_rgt"> </div>
                  <?php } ?>
                </div>
                <div class="dash_market_info">
                  <div class="transaction-table">
                    <div class="invest-tl">
                      <div class="trans_table_top">
                        <div class="trans_table_tl"> </div>
                        <div class="trans_table_tm"> </div>
                        <div class="trans_table_tr"> </div>
                      </div>
                      <div class="trans_table_mid">
                        <div class="trans_table_ml"> </div>
                        <div class="trans_table_mm" >
                          <h3 class="market"><?php echo $this->Lang['PRO_TRANS_DET']; ?></h3>
            <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
            <th align="left"><?php echo $this->Lang["TRANS"]; ?> </th>
            <th align="left"><?php echo $this->Lang['COUNT']; ?> </th>
            <th align="left"><?php echo $this->Lang['AMOUNT']; ?></th>
            </tr>
            <tr>
            <td><?php echo $this->Lang['TODAY']; ?> </td>
            <td><?php  echo $dpc; ?> </td>
            <td><?php  echo CURRENCY_SYMBOL.$dpa; ?></td>
            </tr>
            <tr>
            <td><?php echo $this->Lang['LST_THIRTY_DAYS']; ?>  </td>
            <td><?php  echo $mpc; ?></td>
            <td><?php  echo CURRENCY_SYMBOL.$mpa; ?></td>
            </tr>
            <tr>
            <td><?php echo $this->Lang['LST_YR']; ?> </td>
            <td><?php  echo $ypc; ?></td>
            <td><?php  echo CURRENCY_SYMBOL.$ypa; ?></td>
            </tr>
            <tr>
            <td><?php echo $this->Lang['TOTAL']; ?></td>
            <td><?php  echo $yp; ?></td>
            <td><?php  echo CURRENCY_SYMBOL.$ap; ?></td>
            </tr>
            </table>
                        </div>
                        <div class="trans_table_mr"> </div>
                      </div>
                      <div class="trans_table_bot">
                        <div class="trans_table_bl"> </div>
                        <div class="trans_table_bm"> </div>
                        <div class="trans_table_br"> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  

<div class="chart_1 fl">
    <ul>
    <li  id="transactiondate" class=" selected fl">
      <div class="tab1"></div>
      <div class="tab2 tab5" ><a  onclick="return Transaction_date();" id="transactiondate"><?php echo $this->Lang['LST_THIRTY_TRANS']; ?></a></div>
      <div class="tab3"></div>
    </li>
    <li class=" fl" id="transactionmonth">
      <div class="tab1"></div>
      <div class="tab2 tab5" ><a onclick="return Transaction_month();"  id="transactionmonth"><?php echo $this->Lang['LST_TWELVE_TRANS']; ?></a></div>
      <div class="tab3"></div>
    </li>
    
    <li class=" fl" id="transactionyear">

      <div class="tab1"></div>
      <div class="tab2 tab5" ><a onclick="return Transaction_year();"  id="transactionyear"><?php echo $this->Lang['LST_TEN_YR_TRANS']; ?></a></div>
      <div class="tab3"></div>
    </li>
  </ul>
</div>
<div class="scr_date" style="overflow-x:scroll; width:750px;">
<div id="container_line" class="chart_2" style="float:left; width:1600px;" ></div>
</div>

<div class="scr_month" style="overflow-x:scroll; width:750px;">
<div id="container_month_line" class="chart_2" style="float:left; width:1200px;" ></div>
</div>

<div class="scr_year" style="overflow-x:scroll; width:750px;">
<div id="container_year_line" class="chart_2" style="float:left; width:1200px;" ></div>
</div>
   <?php } ?>
   <?php if(isset($this->end_date)){?>
   <div class="scr_date" style="overflow-x:scroll; width:750px;">
    <div id="container_line" class="chart_2" style="float:left; width:1600px;" ></div>
  </div>
   <?php } ?>
</div>
<div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
