<?php

/**
 * Class Es_Admin_Listing_Agent_Added_Email.
 */
class Es_Subscription_Otp_Payed_Email extends Es_Email {

	public function get_tokens() {
		$data = $this->get_data();

		$data = wp_parse_args( $data, array(
			'agent_name' => null,
		) );

		return array_merge( parent::get_tokens(), array(
			'{agent_name}' => $data['agent_name'],
		) );
	}

	/**
	 * @return mixed|string
	 */
	public function get_content() {
		return ests( 'subscription_otp_payed_email_content' );
	}

	/**
	 * @return mixed|string
	 */
	public function get_subject() {
		return ests( 'subscription_otp_payed_email_subject' );
	}

	/**
	 * @return mixed|string|void
	 */
	public static function get_label() {
		return __( 'One Time Payment paid successfully', 'es' );
	}
}
