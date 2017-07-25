<?php

function prism_shortcode( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'code' => 'markup',
			),
			$atts
		);

	$code = '<pre class="line-numbers"><code class="language-' . $atts['code'] . '">' . $content . '</code></pre>';

	return $code;

}
add_shortcode( 'prism', 'prism_shortcode' );
