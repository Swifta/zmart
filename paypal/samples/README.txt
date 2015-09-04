README for PayPal WPS Toolkit PHP Samples
=========================================

Steps to run the PayPal WPS Toolkit PHP Samples:

1. Download and install the following required software.

   Software:			Version:		Download from:
   =========			========       		==============
   PHP				4.3.0 (or higer)	http://www.php.net/downloads.php
   PHP CURL Extention
   
   
2. Run the following PHP command from within your installation directory to install the samples 

	php install.php
	
   At the prompt for your target web directory, enter the name of the directory where you wish to install 
   the WPS PHP web samples (eg. /usr/local/apache/htdocs). If your application is on a shared server,
   enter the full path to a subdirectory of your public HTML directory into which the installer will copy
   the WPS PHP web sample files. The directory should not previously exist on your server. 

   If you see no error messages, the installation was successful.
   To verify installation, browse to the installation directory and you should see the paypal_php_wps_samples directory.
   
   
3. To run the samples, go to http://www.mydomain.com/<targetDir>/paypal_php_samples/index.html.