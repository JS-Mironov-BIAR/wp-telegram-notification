<?php
/**
 * Plugin Name: WordPress notification with Telegram
 * Plugin URI:  https://olaksen.by
 * Description: Легкий и быстрый плагин подключения к боту telegram
 * Version:     1.0.0
 * Author:      Egor Mironov
 * Author URI:  https://yourwebsite.com
 * License:     GPL2
 * Text Domain: wp-telegram-notification

 */

if (!defined('ABSPATH')) {
	exit;
}

// Core admin pages
require_once plugin_dir_path(__FILE__) . 'admin/assets.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
require_once plugin_dir_path(__FILE__) . 'admin/chat-sync.php';
require_once plugin_dir_path(__FILE__) . 'admin/test-send.php';

// Telegram logic and sync
require_once plugin_dir_path(__FILE__) . 'includes/init.php';
