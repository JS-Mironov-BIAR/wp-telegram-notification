<?php
/**
 * Plugin Name: WordPress notification with Telegram
 * Plugin URI:  https://olaksen.by
 * Description: Легкий и быстрый способ получать уведомления с сайта в telegram.
 * Version:     1.0.0
 * Author:      Egor Mironov
 * Author URI:  https://yourwebsite.com
 * License:     GPL2
 * Text Domain: wp-telegram-notification

 */

if (!defined('ABSPATH')) {
	exit;
}

// Connecting Files
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/init.php';
require_once plugin_dir_path(__FILE__) . 'includes/assets.php';
