<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<script type="text/javascript" src="<?php echo PATH ?>js/jquery.js"></script>
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
<div class="bread_crumb"><a href="<?php echo PATH."admin.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
<div class="content_top">
  <div class="top_left"></div>
  <div class="top_center"></div>
  <div class="top_rgt"></div>
</div>
<div class="content_middle">
<form action="" method="get" class="admin_form">
    <label class="fl"> <b class="search_deal_title"><?php echo $this->Lang['SRCH_WEB_CUS']; ?> : </b></label>
<table class="list_table1 fl clr">			
    <tr>
    <td><label><?php echo $this->Lang['START_DATE']; ?></label></td>
    <td><label>:</label></td>
    <td><input type="text" id="startdat" name="start_date" readonly="readonly"  value="<?php if(isset($this->start_date)){ echo $this->start_date; }?>"> </td>
    <td><label><?php echo $this->Lang['END_DATE']; ?></label></td>
    <td><label>:</label></td>
    <td><input type="text" name="end_date" id="enddat" readonly="readonly" value="<?php if(isset($this->end_date)){ echo $this->end_date; }?>"></td>
    <td></td>


    <td>
        <input type="submit" value="<?php echo $this->Lang['SEARCH']; ?>" />                                        
    </td>
    <?php   if(isset($this->end_date)){  ?>
    <td>
        <input type="button" value="<?php echo $this->Lang['CANCEL']; ?>" onclick="window.location.href='<?php echo PATH; ?>admin/moderator-dashboard.html'"/>                    
    </td>
    <?php } ?>
    </tr>
</table>
</form>
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/highcharts.js"></script> 
	<script type="text/javascript" src="<?php echo PATH ?>js/chart/exporting.js"></script>
<?php 
$date_count="";  
     if(isset($this->end_date)){   
     $date_count=((strtotime($this->end_date)+86400)-strtotime($this->start_date))/86400;
     }

 /*********************** User today List Chart Start ************************/

    $date = '';   
    $tj = "0";  
    
    if(count($this->user_list)>0){    
        $tj = 0;       
        for($i=0;$i<1;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 2){
        
                $userdate=$user->joined_date;
                 
                         $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $tj +=1;              
                        }
                    }    
                }
         }    
    } 


    /*********************** User today List Chart Start ************************/

    $date = ''; 
    $wj ="0";  
    
    if(count($this->user_list)>0){    
        $wj = 0;       
        for($i=0;$i<7;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 2){
        
                $userdate=$user->joined_date;
                 
                         $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                        $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y"));
                        $date=date("M/d", strtotime("-$i day") ) ;
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $wj +=1;              
                        }
                    }    
                }
         }    
    } 

    /*********************** User days List Chart Start ************************/
    
    $con_con_date = '';
    $lead_val_date = ''; 
    $date = '';   
    $j = 0; 
        $d = 0; 
        if($date_count==""){
         $date_count = "30";
         } else { 
         $date_count = $date_count;
         }  
    if(count($this->user_list)>0){    
             
        for($i=0;$i<$date_count;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 2){
        
                $userdate=$user->joined_date;
                 
                      if(isset($this->end_date)){ 
                         $start=strtotime($this->start_date)+ (86400*$i);
                         $end=($start+86400);     
                         $date=date("M/d", strtotime($this->start_date)+ (86400*$i) ) ;
                        } else {  
                         $start=mktime(0, 0, 0, date("m")  , date("d")-$i, date("Y"));
                         $end=mktime(0, 0, 0, date("m")  , date("d")-$i+1, date("Y")); 
                         $date=date("M/d", strtotime("-$i day") ) ;                       
                        }
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $j +=1;  
                              $d +=1;            
                        }
                    }    
                }
          $con_con_date .= "'".$date."',"; 
          $lead_val_date .= $j.',';  
          $j=0;
         }    
    }
    
    /*********************** User Month List Chart Start ************************/
    
    $con_con = '';
    $lead_val = ''; 
    $date = '';   
    $j = 0;  

        $m = 0;
    if(count($this->user_list)>0){    
           
        for($i=0;$i<=11;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 2){
        
                $userdate=$user->joined_date;
                 
                        $start=strtotime(date("Y-m-1", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $end=strtotime(date("Y-m-t", strtotime("-$i month", strtotime(date("F") . "1")) )) ;
                        $date=date("M/Y", strtotime("-$i month", strtotime(date("F") . "1")) ) ;
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $j +=1;  
                              $m +=1;            
                        }
                    }    
                }
          $con_con .= "'".$date."',"; 
          $lead_val .= $j.',';  
          $j=0;
         }    
    }
    
    /*********************** User Year List Chart Start ************************/
    
    $con_con_year = '';
    $lead_val_year = ''; 
    $date = '';   
    $j = 0;  
        $y = 0; 
    if(count($this->user_list)>0){    
            
        for($i=0;$i<=9;$i++)
                {                                  
                foreach($this->user_list as $user){
                if($user->user_type == 2){
        
                $userdate=$user->joined_date;
                 
                        $start=strtotime(date("Y-1-1", strtotime("-$i year"))) ;
                        $end=strtotime(date("Y-12-t", strtotime("-$i year")));
                        $date=date("Y", strtotime("-$i year") ) ;
                        if(($start <= $userdate) && ( $end >= $userdate)) {
                              $j +=1; 
                              $y +=1;              
                        }
                    }    
                }
          $con_con_year .= "'".$date."',"; 
          $lead_val_year .= $j.',';  
          $j=0;
         }    
    }

    /*********************** User Count Bar Chart Start ************************/
    $NU = 0; $AU = 0; $FU = 0; $ME = 0; $admin_user="0"; $facebook_user="0"; $merchant="0";
    if(count($this->user_list)>0) { 
                
            foreach($this->user_list as $user){
                if($user->login_type == 1){
                 $NU++;                        
                }
                if(($user->login_type == 2)&&($user->user_type != 3)){
                 $AU++;                        
                }
                if($user->login_type == 3){
                 $FU++;                        
                }
                if($user->user_type == 3){
                 $ME++;                        
                }
           }
        $normal_user =  $NU; 
        $admin_user =  $AU;
        $facebook_user =  $FU;  
        $merchant =  $ME; 
    }
     
 ?>

<script type="text/javascript">
//<![CDATA[

Highcharts.theme = {
   colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
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
// Last 30 Day's Website Customer 

$(function () {
var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'user_day',
                type: 'column'
            },
            
            <?php if(isset($this->end_date)){?>
		title: {
			text: "<?php echo $this->Lang['SRCH_REP_FR']; ?> <?php echo date('d/M/Y', strtotime($this->start_date) ); ?> <?php echo $this->Lang['TO']; ?> <?php echo date('d/M/Y', strtotime($this->end_date) ); ?>"
		},
		<?php } else { ?>
		 title: {
                text: "<?php echo $this->Lang['LST_THIRTY_DYS_WEB_CUS']; ?>"
            },
		<?php } ?>
           
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo $con_con_date; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: "<?php echo $this->Lang['NUM']; ?>"
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: 'none',
                align: 'left',
                verticalAlign: 'top',
                x: 60,
                y: 20,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: "<?php echo $this->Lang['NEW_CUS']; ?>",
                data: [<?php echo $lead_val_date; ?>]
    
            }]
        });
    });
});

//Last 12 Month's Website Customer 

$(function () {
var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'user_month',
                type: 'column'
            },
            title: {
                text: "<?php echo $this->Lang['LST_TWELVE_MHS_WEB_CUS']; ?>"
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo $con_con; ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: "<?php echo $this->Lang['NUM']; ?>"
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: 'none',
                align: 'left',
                verticalAlign: 'top',
                x: 60,
                y: 20,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: "<?php echo $this->Lang['WEB_CUS']; ?>",
                data: [<?php echo $lead_val; ?>]
    
            }]
        });
    });
});

//Last 10 Year's Website Customer

$(function () {
var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'user_year',
                type: 'column'
            },
            title: {
                text: "<?php echo $this->Lang['LST_TEN_YRS_WEB_CUS']; ?>"
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<?php echo $con_con_year; ?>]
            },

            yAxis: {
                min: 0,
                title: {
                    text: "<?php echo $this->Lang['NUM']; ?>"
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: 'none',
                align: 'left',
                verticalAlign: 'top',
                x: 60,
                y: 20,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' ';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                name: "<?php echo $this->Lang['WEB_CUS']; ?>",
                data: [<?php echo $lead_val_year; ?>]    
            }]
        });
    });
});

//Total Users Count And Merchant Count

var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: "<?php echo $this->Lang['TOT_CUS_CUNT']; ?> "
		},
		
		plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
		series: [{
			type: 'pie',
			name: "<?php echo $this->Lang['CUS_CUNT']; ?>",
			data: [
				["<?php echo $this->Lang['ADMIN_USER']; ?> ", <?php echo $admin_user; ?>],
				{
					name: "<?php echo $this->Lang['WEB_CUS']; ?>",
					y: <?php echo abs($y-$admin_user-$facebook_user); ?>,
					sliced: true,
					selected: true
				},
				["<?php echo $this->Lang['FACEBOOK_USER']; ?> ", <?php echo $facebook_user; ?>]

			]
		}]
	});
});
//]]>
</script> 
<?php if(isset($this->end_date)){ } else {?>

<div class="chart_1 fl">
    <ul>
    <li  id="userdate" class=" selected fl"> 
      <div class="tab1"></div>
      <div class="tab2" ><a  onclick="return User_date();" id="userdate"><?php echo $this->Lang['LST_THIRTY_DYS_WEB_CUS']; ?></a></div>
      <div class="tab3"></div>
    </li>
    <li class=" fl" id="usermonth">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_month();"  id="usermonth"><?php echo $this->Lang['LST_TWELVE_MHS_WEB_CUS']; ?></a></div>
      <div class="tab3"></div>
    </li>
    
    <li class=" fl" id="useryear">
      <div class="tab1"></div>
      <div class="tab2" ><a onclick="return User_year();"  id="useryear"><?php echo $this->Lang['LST_TEN_YRS_WEB_CUS']; ?></a></div>
      <div class="tab3"></div>
    </li>
  </ul>
</div> 
<div class="user_date" style="overflow-x:scroll; width:750px;">
<div id="user_day" class="chart_2 fl" style="float:left; width:1600px;"></div>
</div>

<div class="user_month" style="overflow-x:scroll; width:750px;">
<div id="user_month" class="chart_2 fl" style="float:left; width:900px;"></div>
</div>

<div class="user_year" style="overflow-x:scroll; width:750px;">
<div id="user_year" class="chart_2 fl" style="float:left; width:900px;"></div>
</div>
 <?php } ?>
   <?php if(isset($this->end_date)){?>
   <div class="scr_date" style="overflow-x:scroll; width:750px;">
<div id="user_day" class="chart_2 fl" style="float:left; width:1600px;"></div>
  </div>
   <?php } ?>
</div>
<div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
