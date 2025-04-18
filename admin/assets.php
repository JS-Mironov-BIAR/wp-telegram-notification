<?php

add_action('admin_enqueue_scripts', 'wtn_enqueue_admin_assets');

/**
 * Enables styles and scripts only on the Telegram Notification page
 */
function wtn_enqueue_admin_assets($hook): void {
	if ($hook !== 'settings_page_wtn-settings') return;

	$version = '1.0.0';

	wp_enqueue_style( 'wtn-admin-style', plugin_dir_url(__DIR__) . '/assets/css/admin.css', [], $version );
	wp_enqueue_script( 'wtn-admin-script', plugin_dir_url(__DIR__) . '/assets/dist/admin.js', [], $version, true );

	wp_localize_script('wtn-admin-script', 'wtn_admin', [
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('wtn_chat_sync_nonce')
	]);
}
