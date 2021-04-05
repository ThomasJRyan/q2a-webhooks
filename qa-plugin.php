<?php

/*
	Plugin Name: Q2A Webhooks
	Plugin URI:
	Plugin Description: A plugin for firing off curl requests to open endpoints
	Plugin Version: 1.0
	Plugin Date: 2021-04-03
	Plugin Author: Thomas Ryan
	Plugin Author URI: 
	Plugin License: Apache2
	Plugin Minimum Question2Answer Version: 1.8
	Plugin Update Check URI:
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_module('event', 'qa-webhooks.php', 'qa_webhooks', 'Webhooks');
