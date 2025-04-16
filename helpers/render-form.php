<?php

/**
 * Renders the form template by replacing custom shortcodes with HTML
 * and wraps supported elements with <label> if label="..." is set.
 *
 * @param string $template
 * @return string
 */
function wtn_render_form_template(string $template): string {
	/**
	 * Processes a field in <label> with <span> inside if label="" is specified
	 *
	 * @parameter string $tag HTML input type="text" or just a text field
	 * @parameter array $matches defines preg_matchch
	 * @parameter bool $isTextarea
	 * @string rerned
	 */
	$wrap_with_label = static function (string $tag, array $matches, bool $isTextarea = false): string {
		$attrs = $matches[1];
		preg_match('/label="([^"]+)"/', $attrs, $labelMatch);
		$label = $labelMatch[1] ?? null;

		$attrs = preg_replace('/label="[^"]*"/', '', $attrs); // remove label from attributes

		$input = $isTextarea
			? "<textarea $attrs></textarea>"
			: "<input $tag $attrs>";

		return $label
			? "<label><span>$label</span>$input</label>"
			: $input;
	};

	$template = preg_replace_callback('/\[text (.*?)\]/', fn($m) => $wrap_with_label('type="text"', $m), $template);
	$template = preg_replace_callback('/\[tel (.*?)\]/', fn($m) => $wrap_with_label('type="tel"', $m), $template);
	$template = preg_replace_callback('/\[email (.*?)\]/', fn($m) => $wrap_with_label('type="email"', $m), $template);
	$template = preg_replace_callback('/\[textarea (.*?)\]/', fn($m) => $wrap_with_label('', $m, true), $template);

	// Checkbox — обрабатывается отдельно, т.к. внутри label порядок input/label отличается
	$template = preg_replace_callback('/\[checkbox (.*?)\]/', static function ($matches) {
		$attrs = $matches[1];
		preg_match('/label="([^"]+)"/', $attrs, $labelMatch);
		$label = $labelMatch[1] ?? '';
		$attrs = preg_replace('/label="[^"]*"/', '', $attrs);

		return $label
			? "<label><input type=\"checkbox\" $attrs><span>$label</span></label>"
			: "<input type=\"checkbox\" $attrs>";
	}, $template);

	// Submit button
	$template = preg_replace_callback('/\[send (.*?)\]/', static function ($matches) {
		preg_match('/text="(.*?)"/', $matches[1], $textMatch);
		$text = $textMatch[1] ?? 'Отправить';
		return '<button ' . $matches[1] . '>' . esc_html($text) . '</button>';
	}, $template);

	return $template;
}
