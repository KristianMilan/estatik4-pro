<?php

/**
 * Class Es_Search_Form_Shortcode.
 */
class Es_Agency_Field_Shortcode extends Es_Shortcode {

	/**
	 * Return search shortcode DOM.
	 *
	 * @return string|void
	 */
	public function get_content() {
		$atts = $this->get_attributes();

		if ( empty( $atts['name'] ) && empty( $atts['agency_id'] ) ) return null;

		$value = es_get_the_formatted_field( $atts['name'], $atts['agency_id'] );

		return is_string( $value ) ? $value : null;
	}

	/**
	 * Return shortcode default attributes.
	 *
	 * @return array|void
	 */
	public function get_default_attributes() {
		return apply_filters( sprintf( '%s_default_attributes', static::get_shortcode_name() ), array(
			'name' => '',
			'agency_id' => get_the_ID(),
		) );
	}

	/**
	 * @return Exception|string
	 */
	public static function get_shortcode_name() {
		return 'es_agency_field';
	}
}
