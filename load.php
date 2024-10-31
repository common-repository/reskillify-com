<?php
/*
  Plugin Name: Reskillify
  Description: Woocommerce and reskillify.com integration for link courses and purchases with reskillify.com platform
  Version: 1.1.2
  Author: Reskillify
  Author URI: https://reskillify.com
  Text Domain: reskillify
  Domain Path: /languages
*/

define("RESKILLIFY_PLUGIN_NAME", "reskillify-com");

if ( is_admin() ) {
	require_once __DIR__."/includes/settings.php";
	require_once __DIR__."/includes/add-field-to-woocommerce.php";
}
require_once __DIR__."/includes/reskillify_connect.php";