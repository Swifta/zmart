
<form action="https://www.paypal.com/cgi-bin/webscr"
method="post"
<input type="hidden" name="business" value="nandhu_1334926456_biz@gmail.com">
<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">
<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="Hot Sauce">
<input type="hidden" name="currency_code" value="USD">
<!-- Provide a dropdown menu option field. -->
<input type="hidden" name="on0" value="Type">Type of sauce <br />
<select name="os0">
<option value="Select a type">-- Select a type --</option>
<option value="Red">Red sauce</option>
<option value="Green">Green sauce</option>
</select> <br />
<!-- Provide a dropdown menu option field with prices. -->
<input type="hidden" name="on1" value="Size">Size <br />
<select name="os1">
<option value="06oz">6 oz. bottle - $5.95 USD</option>
<option value="12oz">12 oz. bottle - $9.95 USD</option>
<option value="36oz">3 12 oz. bottles - $19.95 USD</option>
</select> <br />
<!-- Specify the price that PayPal uses for each option. --> 
<input type="hidden" name="option_index" value="1">
<input type="hidden" name="option_select0" value="06oz">
<input type="hidden" name="option_amount0" value="5.95">
<input type="hidden" name="option_select1" value="12oz">
<input type="hidden" name="option_amount1" value="9.95">
<input type="hidden" name="option_select2" value="36oz">
<input type="hidden" name="option_amount2" value="19.95">
<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif"
alt="PayPal - The safer, easier way to pay online">
<img alt="" border="0" width="1" height="1"
src="https://www.paypal.com/en_US/i/scr/pixel.gif" >
</form>
