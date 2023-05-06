<?php

/**
 * Class Es_Profile_Shortcode.
 */
class Es_Profile_Shortcode extends Es_Shortcode {

    /**
     * Return shortcode name.
     *
     * @return string
     */
    public static function get_shortcode_name() {
        return 'es_profile';
    }

    /**
     * @return false|string
     */
    public function get_content() {
        ob_start();

        if ( get_current_user_id() ) {
	        $tabs = array(
		        'my-listings' => array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/my-listings.php' ),
			        'label' => __( 'My listings', 'es' ),
			        'icon' => "<span class='es-icon es-icon_home'></span>",
			        'id' => 'my-listings',
		        ),
		        'requests' => array(
			        'template' => ! empty( $_GET['request_id'] ) ?
				        es_locate_template( 'front/shortcodes/profile/tabs/single-request.php' ) : es_locate_template( 'front/shortcodes/profile/tabs/requests.php' ),
			        'label' => __( 'Requests', 'es' ),
					'counter' => es_get_new_requests_count(),
			        'icon' => "<span class='es-icon es-icon_mail'></span>",
			        'id' => 'requests',
		        ),
		        'saved-homes' => array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/saved-homes.php' ),
			        'label' => __( 'Saved homes', 'es' ),
			        'icon' => "<span class='es-icon es-icon_heart'></span>",
			        'id' => 'saved-homes',
		        ),
		        'saved-searches' => array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/saved-searches.php' ),
			        'label' => __( 'Saved searches', 'es' ),
			        'icon' => "<span class='es-icon es-icon_search'></span>",
			        'id' => 'saved-searches',
		        ),
		        'saved-agents' => array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/saved-agents.php' ),
			        'label' => __( 'Saved agents', 'es' ),
			        'icon' => "<span class='es-icon es-icon_glasses'></span>",
			        'id' => 'saved-agents',
		        ),
		        'saved-agencies' => array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/saved-agencies.php' ),
			        'label' => __( 'Saved agencies', 'es' ),
			        'icon' => "<span class='es-icon es-icon_case'></span>",
			        'id' => 'saved-agencies',
		        ),
	        );

			if ( ! current_user_can( 'agent' ) && ! current_user_can( 'administrator' ) ) {
				unset( $tabs['requests'] );
				unset( $tabs['my-listings'] );
			}

			if ( isset( $tabs['requests'] ) && ! ests( 'is_profile_requests_tab_enabled' ) ) {
				unset( $tabs['requests'] );
			}

	        if ( ! ests( 'is_saved_search_enabled' ) ) {
		        unset( $tabs['saved-searches'] );
	        }

			if ( ! ests( 'is_properties_wishlist_enabled' ) ) {
				unset( $tabs['saved-homes'] );
			}

			if ( ! ests( 'is_agents_wishlist_enabled' ) || ! ests( 'is_agents_enabled' ) ) {
				unset( $tabs['saved-agents'] );
			}

			if ( ! ests( 'is_agencies_wishlist_enabled' ) || ! ests( 'is_agencies_enabled' ) ) {
				unset( $tabs['saved-agencies'] );
			}

	        if ( ests( 'is_subscriptions_enabled' ) && current_user_can( 'agent' ) ) {
	        	$tabs['billing'] = array(
			        'template' => es_locate_template( 'front/shortcodes/profile/tabs/billing.php' ),
			        'label' => __( 'Billing', 'es' ),
			        'icon' => "<span class='es-icon es-icon_billing'></span>",
			        'id' => 'billing',
		        );
	        }

	        $tabs = apply_filters( 'es_profile_get_tabs', $tabs );

            es_load_template( 'front/shortcodes/profile/profile.php', array(
                'user_entity' => es_get_user_entity(),
                'tabs' => $tabs,
            ) );
        } else {
            $shortcode = es_get_shortcode_instance( 'es_authentication' );
            echo $shortcode->get_content();
        }
        return ob_get_clean();
    }
}
