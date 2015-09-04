
<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<div class="bread_crumb"><a href="<?php echo PATH."merchant.html"; ?>" title="<?php echo $this->Lang['HOME']; ?>"><?php echo $this->Lang["HOME"]; ?> <span class="fwn">&#155;&#155;</span></a><p><?php echo $this->template->title; ?></p></div>
<div class="cont_container mt15 mt10">
    <div class="content_top"><div class="top_left"></div><div class="top_center"></div><div class="top_rgt"></div></div>
    <div class="content_middle">
        <form action="" method="post" class="admin_form fl" enctype="multipart/form-data">
            <table>
            	
                 <tr>
                    <td></td> <td></td><td></td>
                <tr>
		<em> <?php echo$this->Lang["UPLOAD_MUST_CSV"]; ?> </em>
		<a href="<?php echo PATH; ?>images/xls/Merchant_product.xls" style="text-decoration:underline"> <?php echo $this->Lang["CLICK_SAMPLE_CSV"];?> </a>
                    <td><label><?php echo $this->Lang["PRODUCT_IMPORT"]; ?></label><span>*</span></td>
                    <td><label>:</label></td>
                    <td>
                    	<input type="file" name="im_product" />
                    	<em><?php if(isset($this->form_error["im_product"])){ echo $this->form_error["im_product"]; }?></em>
                    </td>
                    <td class="import_text"><em> <?php echo$this->Lang["GUIDE_LINE"]; ?> : </em> 
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="submit" value="<?php echo $this->Lang['SUBMIT']; ?>" title="<?php echo $this->Lang['SUBMIT']; ?>" /><input type="reset" value="<?php echo $this->Lang['RESET']; ?>" onclick="javascript:window.location='<?php echo PATH; ?>merchant/product-import.html'" title="<?php echo $this->Lang['RESET']; ?>"/> </td>
                     <td><em>1. <?php echo $this->Lang["IMPORT_MUST_SEPARATORS"]; ?>.</em></td>
                </tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
                <td><em>2. <?php echo $this->Lang["CATEGORIES_MUST_WEBSITE"]; ?>.</em>
					</td>
                </tr>
                <tr>
					<td></td>
					<td></td>
					<td></td>
                <td><em>3. <?php echo $this->Lang["PRODUCT_LESS_AMOUNT"]; ?>.</em>
					</td>
                </tr>
                                <tr>
					<td></td>
					<td></td>
					<td></td>
                <td><em>4. <?php echo $this->Lang["PRODUCT_IMAGES_MUST"]; ?>.</em></td>
                </tr>

            </table>
        </form>
    </div>
    <div class="content_bottom"><div class="bot_left"></div><div class="bot_center"></div><div class="bot_rgt"></div></div>
</div>
