<?php
/**
 * Program: install.php
 *
 * Installer for PayPal PHP WPS Toolkit
 *
 * This version assumes that the distribution (.zip, .tar, .tar.gz) has already
 * been expanded since this script is included in the distribution.
 *
 * Author:  E. Erwa
 * Date:  10/04/2006
 *
 * Notes:
 * - Handle entered directories with/without trailing slash
 * - The install.php resides at the top of the PHP tree so there is no install required
 *   for the PHP libs.
 */

/**
 * Required PHP extension list.
 */
$reqd_wps_ext = array("openssl", "curl");

/**
 * Checks.
 */
if(!inWpsDir()) {
    $wps_dir = dirname(__FILE__);
    error_message("Please cd to the $wps_dir and run install.php");
    exit(1);
}
if($err = validate_php_env($reqd_wps_ext)) {
    error_message("Missing required PHP extention(s) for WPS Toolkit: $err");
    exit(1);
}

/**
 * Confirm overwriting.
 */
echo "This installer will overwrite any existing files in the target directory.\nContinue (y or n)? ";
$stdin = fopen("php://stdin", "r");
$confirm = strtolower(substr(trim(fgets($stdin)), 0, 1));
if($confirm != "y") {
    exit(1);
}

/**
 * Proceed with installation.
 */
echo "Installing the PayPal PHP WPS Toolkit ...\n";


/**
 * Install web files.
 */
echo "Where would you like the PayPal web samples installed? ";
$php_web_dir = strip_slash(trim(fgets($stdin)));
fclose($stdin);
if(!is_dir($php_web_dir)) {
	// Create if it does not exist.
	echo "Creating $php_web_dir...\n";
	mkdir($php_web_dir, 0755);
}
echo "Installing web samples to $php_web_dir\n";
install_web($php_web_dir);

echo "\n\nInstallation Complete!\n\n";
exit(0);

/**
 * Utility functions below
 */
function error_message($msg)
{
    echo "INSTALLATION ERROR:\n$msg\n";
}

function strip_slash($path)
{
    if (strrpos($path, "/") === strlen($path) - 1) {
        $path = substr($path, 0, strlen($path) - 1);
    }
    return $path;
}

function inWpsDir()
{
    $wps_dir = dirname(__FILE__);
    if (strpos($wps_dir, "paypal_php_wps_toolkit") === strlen($wps_dir) - strlen("paypal_php_wps_toolkit")) {
        return true;
    } else {
        return false;
    }
}

function validate_php_env($required_extensions)
{
    // Exit-code style - empty string == succeeded.
    $result = "";

    $php_ext = get_loaded_extensions();
    foreach ($required_extensions as $ext) {
        if (!in_array($ext, $php_ext)) {
            $result .= " $ext";
        }
    }

    return trim($result);
}

function install_web($to_dir)
{
    $to_dir .= DIRECTORY_SEPARATOR. "paypal_php_wps_samples";
    copydir_r("." . DIRECTORY_SEPARATOR . "samples" . DIRECTORY_SEPARATOR . "web", $to_dir, 0755);
    generate_ini_set(dirname(__FILE__), $to_dir . DIRECTORY_SEPARATOR . "ppwps_include_path.inc");
}

function generate_ini_set($wps_dir, $phpfile, $libdir = "lib")
{
    $include_path = get_include_path();
    if (!stristr($wps_dir, $include_path)) {
        if (!($fp = fopen($phpfile, "w"))) {
            error_message("Unable to generate $phpfile");
            return false;
        }

        $stamp = date("m/d/Y H:i:s");
		$code =	"<?php\n\n" .
				"//**************************************************\n" .
				"// AUTO-GENERATED include for PayPal PHP WPS Toolkit\n" .
				"// Created by install.php on $stamp\n" .
 				"//**************************************************\n\n" .
 				"set_include_path('$wps_dir' . DIRECTORY_SEPARATOR . '$libdir' . PATH_SEPARATOR . get_include_path());\n\n" .
				"?>";

        fwrite($fp, $code);
        fclose($fp);
    }
    return true;
}

/**
 * Copies everything from directory $fromDir to directory $toDir and
 * sets up files mode $chmod
 */
function copydir_r($fromDir, $toDir, $chmod = 0757)
{
    // Check for some errors
    $errors = array();
    $messages = array();
    if (!is_dir($toDir)) {
        mkdir($toDir, $chmod);
    }
    if (!is_dir($fromDir)) {
        $errors[] = "source dir $fromDir is not a directory";
    }
    if (!empty($errors)) {
        return false;
    }

    // Processing.
    $exceptions = array(".", "..", ".svn");
    $handle = opendir($fromDir);
    while (false !== ($item = readdir($handle)))
        if (!in_array($item, $exceptions)) {
            // Cleanup for trailing slashes in directories
            // destinations.
            $from = str_replace("//", "/", "$fromDir/$item");
            $to = str_replace("//", "/", "$toDir/$item");

            if (is_file($from)) {
                if (@copy($from, $to)) {
                    chmod($to, $chmod);
                    touch($to,filemtime($from)); // to track last modified time
                    $messages[] = "File copied from $from to $to";
                } else
                    $errors[] = "cannot copy file from $from to $to";
            }
            if (is_dir($from)) {
                if (@mkdir($to)) {
                    chmod($to, $chmod);
                    $messages[] = "Directory created: $to";
                } else
                    $errors[] = "cannot create directory $to";
                copydir_r($from, $to, $chmod);
            }
        }

    closedir($handle);
    return true;
}