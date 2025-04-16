<?php

/**
 * Renders the form template by replacing short shortcodes with HTML
 *
 * @param string $template
 * @return string
 */
function wtn_render_form_template(string $template): string {
	// Замена [text name="..." placeholder="..."] → input
	$template = preg_replace_callback('/\[text (.*?)\]/', function ($matches) {
		return '<input type="text" ' . $matches[1] . '>';
	}, $template);

	$template = preg_replace_callback('/\[tel (.*?)\]/', function ($matches) {
		return '<input type="tel" ' . $matches[1] . '>';
	}, $template);

	$template = preg_replace_callback('/\[email (.*?)\]/', function ($matches) {
		return '<input type="email" ' . $matches[1] . '>';
	}, $template);

	$template = preg_replace_callback('/\[textarea (.*?)\]/', function ($matches) {
		return '<textarea ' . $matches[1] . '></textarea>';
	}, $template);

	$template = preg_replace_callback('/\[send (.*?)\]/', function ($matches) {
		preg_match('/text="(.*?)"/', $matches[1], $textMatch);
		$text = $textMatch[1] ?? 'Отправить';
		return '<button ' . $matches[1] . '>' . esc_html($text) . '</button>';
	}, $template);

	return $template;
}
