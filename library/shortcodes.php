<?php
/**
 * @package Temperance
 *
 */

/**
 * Create a pull quote
 *
 * @param array $atts This captures the attribute values
 * @param string optional $content The content between the opening and closing tags
 * @return string
 */
function temperance_pull_quote_shortcode( $atts, $content = '' ) {

    $defaults = array(
        'attribution' => '',
        'url' => '',
    );
    $my_atts = shortcode_atts( $defaults, $atts );

    $attribution = wp_kses_post( $my_atts[ 'attribution' ] );
    $url = $my_atts[ 'url' ] ? $my_atts[ 'url' ] : '';

    $output = '<blockquote class="pullquote">';
    $output .=  wpautop( wp_kses_post( $content ) );

    if ($attribution) {
    	if ($url) {
    	    $attribution .= ' <a href="'. $url . '">(source)</a>';
	    }
		$output .= '<p class="attribution">&mdash;' . $attribution . '</p>';
	}
    $output .= '</blockquote>';

    return $output;

}


