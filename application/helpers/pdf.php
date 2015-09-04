<?php defined('SYSPATH') OR die('No direct access allowed.'); 
class Pdf{
	public function __construct()
	{
		parent::__construct();
		$this->session = Session::instance();
	}

          public function pdf_created($deals_coupons = array())
	  {
                ini_set('memory_limit','64M');
                set_time_limit(3200);
                
                for($i=0; $i < (count($deals_coupons)); $i++)
                {
                        $this->users = new Users_Model();
                        $this->deals_coupons= $this->users->get_deals_coupons_mail($deals_coupons[$i]);
                        foreach($this->deals_coupons as $u){
                        require_once(APPPATH.'vendor/pdf/config/lang/eng.php');
                        require_once(APPPATH.'vendor/pdf/tcpdf.php');
                        // create new PDF document
                        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                        
                       // include "modules/BarcodeQR.php"; 
                        //$qr = new BarcodeQR();
                        //$qr->url($deals_coupons[$i]); 									 
                        //$qr->draw(180, DOCROOT."images/user/qrcode/".$deals_coupons[$i].".png");

                       // $url1= PATH."modules/barcode_generator/barcode_generator.php?ccode=".$deals_coupons[$i];
                       // $imageDir1 = "images/user/barcode/";
                       // $imagePath1 = $imageDir1.$deals_coupons[$i].".png";
                       // $image11 = file_get_contents($url1);
                        //file_put_contents(DOCROOT.$imagePath1, $image11);
                        // set document information
                        $pdf->SetCreator(PDF_CREATOR);
                        $pdf->SetAuthor('Nicola Asuni');
                        $pdf->SetTitle('TCPDF Example 039');
                        $pdf->SetSubject('TCPDF Tutorial');
                        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                        // set default header data
                        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 039', PDF_HEADER_STRING);
                        // set header and footer fonts
                        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                        // set default monospaced font
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                        //set margins
                        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetMargins(6, 0, 0);                        
                        $pdf->SetHeaderMargin(-10);
                        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                        //set auto page breaks
                        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                        //set image scale factor
                        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                        //set some language-dependent strings
                       // $pdf->setLanguageArray($l);
                        // set font
                        $pdf->SetFont('helvetica', '', 10);
                        // add a page
                        $pdf->AddPage();
                        $symbol = CURRENCY_CODE;
                        $Purchase=date('d-M-Y',$u->transaction_date);
                        $expirydate=date('d-M-Y',$u->expirydate);
                        $enddate=date('d-M-Y',$u->enddate);
                        $desc = strip_tags($u->deal_description);
                        $description = text::limit_words($desc,60, '&nbsp;'); 
                        $logo ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/logo.png"  />';
                        $customer_name = $this->Lang['USER_NAME'];
                        $voucher_name =$this->Lang['VOUCHER'];
                        $shop_address =$this->Lang['SHOP_ADDR'];
                        $email_address =$this->Lang['EMAIL'];
                        $voucher_footer =$this->Lang['VOUCHER_FOOTER_CONTENT1'];
                        $title = $this->Lang['TITLE'];
                        $desc = $this->Lang['DESC'];
                        $purchase_date = $this->Lang['PURCHASE_DATE'];
                        $price = $this->Lang['PRI'];
                        $expiry = $this->Lang['EXPIRY'];
                        $shop_addr = $this->Lang['SHOP_ADDR'];
                        $thank_you = $this->Lang['THNK_YOU'];
                        $contact_email = CONTACT_EMAIL;
                        $contact_phone = PHONE1; 
                        $contact_sitename = SITENAME;
                        $pay_later_details = $this->Lang['PAY_LATER_DETAILS'];
                        $pay_later = PAY_LATER;


                        $voucher_image2 ='<img src="'.PATH.'themes/'.THEME_NAME.'/images/new/hw_1.png" width="25" height="25"  />';
                        $voucher_image3 ='<img src="'.PATH.'themes/'.THEME_NAME.'/images/new/hw_2.png" width="25" height="25"  />';
                        $voucher_image4 ='<img src="'.PATH.'themes/'.THEME_NAME.'/images/new/hw_3.png" width="25" height="25"  />';
                        $voucher_image5 ='<img src="'.PATH.'themes/'.THEME_NAME.'/images/new/hw_4.png" width="25" height="25"  />';

                        if(file_exists(DOCROOT.'images/deals/1000_800/'.$u->deal_key.'_1.png'))       
                        {
                        $deal_image ='<img src="'.PATH.'images/deals/1000_800/'.$u->deal_key.'_1.png" width="354" height="220"  />';
                        }
                        else
                        {
                        $deal_image ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/noimage_deals_details.png" width="354" height="220" />';
                        }

                        $qrcode = "";
                        if(file_exists(DOCROOT.'images/user/qrcode/'.$u->coupon_code.'.png'))        
                        { 
                        $qrcode ='<img src="'.PATH.'images/user/qrcode/'.$u->coupon_code.'.png"  />';
                        }
                        $barcode = "";
                        if(file_exists(DOCROOT.'images/user/barcode/'.$u->coupon_code.'.png'))        
                        { 
                        $barcode ='<img src="'.PATH.'images/user/barcode/'.$u->coupon_code.'.png" width="189" height="38" />';
                        }

$pay_later_show = '';

if(isset($this->set_pay_later) && $this->set_pay_later==1)
	$pay_later_show = '<tr height="5"><td></td></tr><tr><td>'.$pay_later_details.' : '.$pay_later.'</td></tr>';

// define some HTML content with style
$html = <<<EOF
<table width="700" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #d3d2d1;">
<tr height="15">
				<td colspan></td>
			</tr>
			<tr>
				<td width="10"></td>
                <td valign="top" width="680"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin:0;">
                        <tr>
                            <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr height="46">
                                        <td width="10" bgcolor="#ffc367">&nbsp;</td>
                                        <td width="240" bgcolor="#fff" align="center">$logo</td>
                                        <td width="160" bgcolor="#fff" align="center"></td>
                                        <td width="250" align="right" valign="middle" style="font:bold 22px arial;color:#666666;">$barcode</td>
                                        <td width="10">&nbsp;</td>
                                        <td width="10" bgcolor="#ffc367">&nbsp;</td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr height="10">
                            <td style="border-bottom: 1px dashed #c0c0c0;">&nbsp;</td>
                        </tr>
                        <tr height="10">
                            <td></td>
                        </tr>
                         <tr>
                            <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr height="220">
                                        <td width="370" align="center">$deal_image</td>
                                        <td width="14"></td>
                                        <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="color:#666666;font:normal 13px arial;">
                                                <tr>
                                                    <td style="font:normal 12px arial;color:#000000;">$u->deal_title</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td>End date : $enddate</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td>Expires date : $expirydate</td>
                                                </tr>
                                                <tr height="15"><td></td></tr>
                                                <tr>
                                                    <td style="font:normal 15px arial;color:#000000;">Voucher Value : $symbol  $u->deal_value</td>
                                                </tr>
                                            </table></td>
                                    </tr>   
                                </table></td>
                        </tr>
                        <tr height="15">
                            <td style="border-bottom:1px dashed #c0c0c0;"></td>
                        </tr>
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 13px arial;color:#333;">                                                                     
                                    <tr>
                                        <td valign="top" width="370"><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="font:normal 18px arial;color:#ff9b02;">Voucher Code: <b> $u->coupon_code</b></td>
                                                </tr>
                                                <tr height="10">
                                                    <td></td>
                                                </tr>                                                            
                                                <tr>
                                                    <td>Purchased Date : $Purchase</td>
                                                </tr> 
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP : $u->ip </td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP City Name : $u->ip_city_name</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>IP Country Name : $u->ip_country_name</td>
                                                </tr>$pay_later_show
                                            </table></td>
                                        <td width="14"></td>
                                        <td valign="top" ><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td style="font:normal 18px arial;color:#ff9b02;">$shop_address</td>
                                                </tr>
                                                <tr height="10">
                                                    <td></td>
                                                </tr>                                                                                                                      
                                                <tr>
                                                    <td>$u->store_name,</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>$u->address1 , $u->address2</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>$u->city_name - $u->zipcode</td>
                                                </tr>
                                                <tr height="5">
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile: $u->phone_number</td>
                                                </tr>                                                       
                                            </table></td>
                                    </tr>                                    
                                </table></td>
                        </tr>
                        <tr height="15">
                            <td style="border-bottom: 1px dashed #c0c0c0;">&nbsp;</td>
                        </tr>                                    
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" >
                                    <tr>
                                        <td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 12px arial;color:#666;">
                                                <tr>
                                                    <td style="font:bold 15px arial;color:#000;">Description</td>
                                                </tr>
                                                <tr height="10"><td></td></tr>
                                                <tr>
                                                    <td>$description</td>
                                                </tr>
                                            </table></td>
                                        <td align="right" valign="top">$qrcode</td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 16px arial;color:#000;">This is How it Works</td>
                        </tr>
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td><table cellspacing="0" cellpadding="0" border="0" width="100%" style="font:normal 14px arial;color:#666;">
                                    <tr>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35">$voucher_image2</td>
                                                    <td>Print voucher </td>
                                                </tr>
                                            </table></td> 
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35">$voucher_image3</td>
                                                    <td>Arrange an appointment with the business </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                    <tr height="20">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35">$voucher_image4</td>
                                                    <td>Bring along your coupon </td>
                                                </tr>
                                            </table></td>
                                        <td><table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                <tr>
                                                    <td width="35">$voucher_image5</td>
                                                    <td>Redeem and enjoy ! </td>
                                                </tr>
                                            </table></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr height="20">
                            <td style="border-bottom: 1px dashed #c0c0c0">&nbsp;</td>
                        </tr>
                        <tr height="20">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 12px/18px arial;color:#000000;"><strong>Any Questions ? Email Us : </strong><a  style="color: #333333;text-decoration: none;">$contact_email</a></td>
                        </tr>
                        <tr height="20">
                            <td style="border-bottom: 1px dashed #c0c0c0">&nbsp;</td>
                        </tr>
                        <tr height="15">
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font:normal 12px/18px arial;color:#000000;"><strong>$voucher_footer</strong> $contact_phone .</td>
                        </tr>
                         </table></td>
			<td width="10"></td>
                        </tr>
			<tr height="15">
				<td></td>
			</tr>						
                         </table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
                        // reset pointer to the last page
                        $pdf->lastPage();
                        // Close and output PDF document
                        $pdf->Output('images/pdf/Voucher'.$i.'.pdf', 'F');
                        }
                
                 
                }	
		
	}
	
	public function template_create($template="",$subject="",$message="")
	{
		ini_set('memory_limit','64M');
                set_time_limit(3200);
                
                 require_once(APPPATH.'vendor/pdf/config/lang/eng.php');
                        require_once(APPPATH.'vendor/pdf/tcpdf.php');
                        // create new PDF document
                        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                         $pdf->SetCreator(PDF_CREATOR);
                        $pdf->SetAuthor('Nicola Asuni');
                        $pdf->SetTitle('TCPDF Example 039');
                        $pdf->SetSubject('TCPDF Tutorial');
                        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
                         $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                         $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                        //set margins
                        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                        //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetMargins(6, 0, 0);                        
                        $pdf->SetHeaderMargin(-10);
                        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                        //set auto page breaks
                        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                        //set image scale factor
                        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                        //set some language-dependent strings
                       // $pdf->setLanguageArray($l);
                        // set font
                        $pdf->SetFont('helvetica', '', 10);
                        // add a page
                        $pdf->AddPage();
                        // define some HTML content with style
                        if($template==1)
                        {
                        $logo ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/red_emarket.png"  />';
                        $color1="color:#a61c00;";
                        $color2="background: #d6d2d3";
                        $color3="#d6d2d3";
					}else{
						$logo ='<img src="'.PATH.'/themes/'.THEME_NAME.'/images/green_emarket.png"  />';
						$color1="color:#5bb110;";
						$color2="background: #d4fede";
						$color3="#d4fede";
					}
$html = <<<EOF

<html>
    <body>
        <table width="200" cellpadding="0" cellspacing="0" border="0">
            <tr style="$color2;"> <td colspan="3" style="font-size: 0;vertical align:top;"> &nbsp;</td></tr>
            <tr>
                <td style="padding:8px;$color2;"></td>
                <td width="568" style="border:10px solid $color3;">
                    <table width="550" cellpadding="0" cellspacing="0" border="0" style="padding:0";>    
						<tr><td></td></tr>
                        <tr><td width="100%" align="center" style="line-height:10pt">$logo</td></tr>                        
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 17px arial;$color1;">Dear Customer</td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 13px arial;color:#000;">Your have a NEWSletter from emarketplace.com </td></tr>
                        <tr style="height: 10px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:normal 13px/19px arial;color:#555;padding:0 15px;">$message</td></tr>
                        <tr style="height: 20px;"><td style="font-size: 0;line-height: 0;border-bottom: 1px solid #000;">&nbsp;</td></tr>
                        <tr style="height: 5px;"><td style="font-size: 0;line-height: 0;">&nbsp;</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#000;">emarketplace.com</td></tr>
                        <tr><td width="100%" align="center" style="font:bold 12px arial;color:#a61c00;">Thank you,  eMarketplace Team.</td></tr>
                        <tr><td></td></tr>
                    </table>
                </td>
                <td style="padding:8px;$color2;"></td>
            </tr>
            <tr style="$color2;height:15px;"> <td colspan="3" style="font-size: 0;line-height: 0;"> &nbsp;</td></tr>
        </table>
    </body>
</html>
EOF;
             // output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
                        // reset pointer to the last page
                        $pdf->lastPage();
                        // Close and output PDF document
                        $pdf->Output('images/newsletter/newsletter.pdf', 'F'); 
                        //url::redirect(PATH . 'images/newsletter/newsletter.pdf'); exit;  
		
	}
	
}
?>
