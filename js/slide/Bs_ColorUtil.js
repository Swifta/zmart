/**
* be aware that dechex and hexdec may be moved into another file.
* crap. use toString(16) and toString(10) instead. dechex and hexdec 
* will disappear. --andrej
* 
* @package    javascript_core
* @subpackage gfx
* @copyright  blueshoes
*/


	function dechex(dec) {
		/*
		try {
			return dec.toString(16);
		} catch (e) {
			//alert(e);
		}
		return 'ff'; //fallback
		*/
		
		var x = parseInt(dec / 16);
		var xx = dechexHelper(x);
		var rest = dec - (x * 16);
		return xx + '' + dechexHelper(rest);
	}
	function dechexHelper(x) {
		if (x <= 9) return x;
		switch (x) {
			case 10:
				return 'A';
			case 11:
				return 'B';
			case 12:
				return 'C';
			case 13:
				return 'D';
			case 14:
				return 'E';
			case 15:
				return 'F';
		}
	}
	
	function hexdec(hex) {
		/*
		try {
			return hex.toString(10);
		} catch (e) {
			//alert(e);
		}
		return '00'; //fallback
		*/
		
		if (hex.length == 6) {
			return hexdec(hex.substr(0,2)) + ' ' + hexdec(hex.substr(2,2)) + ' ' + hexdec(hex.substr(4,2));
		}
		var left  = parseInt(hexdecHelper(hex.substr(0,1)));
		var right = parseInt(hexdecHelper(hex.substr(1)));
		return (left * 16) + right;
	}
	function hexdecHelper(x) {
		if (x <= 9) return x;
		switch (x.toUpperCase()) {
			case 'A':
				return 10;
			case 'B':
				return 11;
			case 'C':
				return 12;
			case 'D':
				return 13;
			case 'E':
				return 14;
			case 'F':
				return 15;
		}
	}
	
	

function Point3(){var a=arguments;switch(a.length){case 0:default:this.x=this.y=this.z=0;break;case 1:{switch(typeof a[0]){case "object":{var o=a[0];if(o.constructor==Point3){this.x=o.x;this.y=o.y;this.z=o.z;}else if(o.constructor==Array){this.x=o[0];this.y=o[1];this.z=o[2];}break;}case "string":{var p;if(a[0].length==6){p=parseInt("0x"+a[0]);}else if(a[0].charAt(0)=='#'){p=parseInt("0x"+a[0].substr(1,6));}else p=Math.floor(a[0]);this.x=(p&0xFF0000)>>>0x10;this.y=(p&0x00FF00)>>>0x08;this.z=(p&0x0000FF)>>>0x00;break;}default:this.x=this.y=this.z=a[0];}break;}case 3:{this.x=a[0];this.y=a[1];this.z=a[2];break;}}}

function setBasicMember__Point3__(){var P=Point3;var PP=P.prototype;
function digitHex2(p){if(p<0x00){return "00";}else if(p<0x10){return "0"+p.toString(16);}else if(p>0xff){return "ff";}else return p.toString(16);}
P.RGBtoHSB=function(){var c=new P(arguments[0]);var cmax=c.max();var cmin=c.min();var h=0.0;var s=(cmax!=0.0)?(cmax-cmin)/cmax:0.0;var b=cmax/0xFF;if(s!=0.0){var cc=new P(c);cc.scale(-1);cc.add(cmax);cc.scale(1/(cmax-cmin));if(c.x==cmax){h=0.0+cc.z-cc.y;}else if(c.y==cmax){h=2.0+cc.x-cc.z;}else h=4.0+cc.y-cc.x;h/=6.0;if(h<0.0){h+=1.0;}else if(h>1.0)h-=1.0;}return new P(h,s,b);};
P.HSBtoRGB=function(){var v=new P(arguments[0]);var h=v.x;var s=v.y;var b=v.z;var c=new P();if(s==0.0){c.add(b);}else{var e=(h-Math.floor(h))*6.0;var f=Math.floor(e);var g=e-f;var n=b*(1.0-s);var m=((f&1)==0)?b*(1.0-s*(1.0-g)):b*(1.0-s*g);switch(f){case 0:c.set(b,m,n);break;case 1:c.set(m,b,n);break;case 2:c.set(n,b,m);break;case 3:c.set(n,m,b);break;case 4:c.set(m,n,b);break;case 5:c.set(b,n,m);break;}}c.scale(255.0);c.add(0.5);return c.toInteger();};
PP.set=function(){var a=arguments;var p;switch(a.length){case 0:default:p=new P();break;case 1:p=new P(a[0]);break;case 3:p=new P(a[0],a[1],a[2]);break;}this.x=p.x;this.y=p.y;this.z=p.z;};
PP.setX=function(x){this.x=x;};
PP.setY=function(y){this.y=y;};
PP.setZ=function(z){this.z=z;};
PP.getX=function(){return this.x;};
PP.getY=function(){return this.y;};
PP.getZ=function(){return this.z;};
PP.toArray=function(){return new Array(this.x,this.y,this.z);};
PP.toInteger=function(){return new P(Math.floor(this.x),Math.floor(this.y),Math.floor(this.z));};
PP.toColor=PP.getColor=function(){return digitHex2(Math.round(this.x))+digitHex2(Math.round(this.y))+digitHex2(Math.round(this.z));};
PP.equals=function(p){return(this.x==p.x&&this.y==p.y&&this.z==p.z);};
PP.intEquals=function(p){return(this.toInteger().equals(p.toInteger()));};
PP.isNaN=function(){return(isNaN(this.x)||isNaN(this.y)||isNaN(this.z)||this.x==""||this.y==""||this.z=="");};
PP.distance=function(p){if(p){var q=new P(this);q.sub(p);return q.distance();}else return Math.sqrt(Math.pow(this.x,2)+Math.pow(this.y,2)+Math.pow(this.z,2));};
PP.mulin=function(p){return this.x*p.x+this.y*p.y+this.z*p.z;};
PP.mulout=function(p){return new P(this.y*p.z-p.y*this.z,this.z*p.x-p.z*this.x,this.x*p.y-p.x*this.y);};
PP.max=function(){return Math.max(Math.max(this.x,this.y),this.z);};
PP.min=function(){return Math.min(Math.min(this.x,this.y),this.z);};
PP.angle=function(p){var result=this.mulin(p)/(this.distance()*p.distance());if(Math.abs(result)>1.0)result /=Math.abs(result);return Math.acos(result);};
PP.absolute=function(){this.x=Math.abs(this.x);this.y=Math.abs(this.y);this.z=Math.abs(this.z);};
PP.scale=function(v){this.x*=v;this.y*=v;this.z*=v;};
PP.add=function(p){var d=new P(p);this.x+=d.x;this.y+=d.y;this.z+=d.z;};
PP.sub=function(p){var d=new P(p);this.x-=d.x;this.y-=d.y;this.z-=d.z;};
PP.toString=function(){return "Point3:("+this.x+","+this.y+","+this.z+")";};
}setBasicMember__Point3__();

function HSBtoRGB(hue, saturation, brightness) {
 var r = 0, g = 0, b = 0;
 if (saturation == 0) {
  r = g = b = parseInt(brightness * 255);
 } else {
  var h = (hue - Math.floor(hue)) * 6.0;
  var f = h - Math.floor(h);
  var p = brightness * (1.0 - saturation);
  var q = brightness * (1.0 - saturation * f);
  var t = brightness * (1.0 - (saturation * (1.0 - f)));
  h = h + "";
  if(h.charAt(0) == ".") {
   h = 0 + h;
  }
  if(parseInt(h) == 0) {
   r = parseInt(brightness * 255);
   g = parseInt(t * 255);
   b = parseInt(p * 255);
  } else if(parseInt(h) == 1) {
   r = parseInt(q * 255);
   g = parseInt(brightness * 255);
   b = parseInt(p * 255);
  } else if(parseInt(h) == 2) {
   r = parseInt(p * 255);
   g = parseInt(brightness * 255);
   b = parseInt(t * 255);
  } else if(parseInt(h) == 3) {
   r = parseInt(p * 255);
   g = parseInt(q * 255);
   b = parseInt(brightness * 255);
  } else if(parseInt(h) == 4) {
   r = parseInt(t * 255);
   g = parseInt(p * 255);
   b = parseInt(brightness * 255);
  } else if(parseInt(h) == 5) {
   r = parseInt(brightness * 255);
   g = parseInt(p * 255);
   b = parseInt(q * 255);
  }
 }
 r = r.toString(16);
 g = g.toString(16);
 b = b.toString(16);
 if(r.length == 0) { r = '00'; }
 if(g.length == 0) { g = '00'; }
 if(b.length == 0) { b = '00'; }
 if(r.length == 1) { r = '0' + r; }
 if(g.length == 1) { g = '0' + g; }
 if(b.length == 1) { b = '0' + b; }
 return new Array(r, g, b);
}


/**
* @param  string colorCode (hex, like 'FFFFFF')
* @return bool (true=dark, false=bright)
*/
function isDarkColor(colorCode) {
	var myChar = colorCode.substr(2, 1);
	return (!isNaN(myChar) && (myChar < 8));
}


/**
* takes 2 colors and returns one that lies somewhere in between.
* 
* example: startColor is white, endColor is black, percent is 50. 
*          the returned color will be gray. if % is 80 then it will 
*          be more black.
* 
* @param  string startColor (6-7 digits, eg '#ffffff', leading # is not necessary)
* @param  string endColor   (6-7 digits, eg '#ffffff', leading # is not necessary)
* @param  int    percent (0-100)
* @return string (7 digits, eg '#FFFFFF' always in upper case.)
* @throws bool false
* @see    mixColorPart()
*/
function mixColor(startColor, endColor, percent) {
	if (startColor.length >= 7) startColor = startColor.substr(1, 6);
	if (endColor.length   >= 7) endColor   = endColor.substr(1, 6);
	startColor = startColor.toUpperCase();
	endColor   = endColor.toUpperCase();
	if (percent == 0)   return '#' + startColor;
	if (percent == 100) return '#' + endColor;
	
	var startRed   = hexdec(startColor.substr(0,2));
	var startGreen = hexdec(startColor.substr(2,2));
	var startBlue  = hexdec(startColor.substr(4,2));
	var endRed     = hexdec(endColor.substr(0,2));
	var endGreen   = hexdec(endColor.substr(2,2));
	var endBlue    = hexdec(endColor.substr(4,2));
	
	try {
		var newRed   = mixColorPart(startRed,   endRed,   percent);
		var newGreen = mixColorPart(startGreen, endGreen, percent);
		var newBlue  = mixColorPart(startBlue,  endBlue,  percent);
		var newRedStr   = newRed.toString(16);
		var newGreenStr = newGreen.toString(16);
		var newBlueStr  = newBlue.toString(16);
		if (newRedStr.length   == 1) newRedStr   = '0' + newRedStr;
		if (newGreenStr.length == 1) newGreenStr = '0' + newGreenStr;
		if (newBlueStr.length  == 1) newBlueStr  = '0' + newBlueStr;
		var newColor =  '#' + (newRedStr + newGreenStr + newBlueStr).toUpperCase();
		return newColor;
	} catch (e) {
		//alert(e);
		return false;
	}
}

/**
* takes 2 color parts and returns one that lies somewhere in between.
* 
* @param  int startColor (0-255)
* @param  int endColor   (0-255)
* @param  int percent    (0-100)
* @return int
* @see    mixColor()
*/
function mixColorPart(startColor, endColor, percent) {
	if (percent == 0)   return startColor;
	if (percent == 100) return endColor;
	var diffColor = endColor - startColor;
	if (diffColor > 0) {
		return startColor + parseInt(diffColor / 100 * percent);
	} else if (diffColor < 0) {
		return startColor + parseInt(diffColor / 100 * percent);
	} else {
		return startColor; //no change, same color.
	}
}


