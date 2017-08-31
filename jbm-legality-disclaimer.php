<?php
/*
Plugin Name: _Legality Disclaimer
Description: Legality Disclaimer at checkout
Version: 1.1
*/
/**
 * Add legal disclaimer checkboxes
 */
add_action( 'woocommerce_review_order_before_submit', 'jbm_legality_checkout_fields' );
function jbm_legality_checkout_fields() {
    echo '<div id="legality_checkout_field"><h3>Legal Disclaimer</h3>';
    woocommerce_form_field( 'legality_checkout', array(
        'type'          => 'checkbox',
        'class'         => array('intl_agree'),
        'label'         => __('The company makes no representations regarding the legality (express or implied), of the products in your jurisdiction. It is the customer\'s responsibility to determine whether the customer can use or consume these products in their jurisdiction.'),
        'required'   => true,
        ));
    echo '</div>';
}
add_action('woocommerce_checkout_process', 'jbm_legality_checkout_field_process');
function jbm_legality_checkout_field_process() {
	if ( ! $_POST['legality_checkout'] )
			wc_add_notice( __( 'Please agree to the Legality Disclaimer.' ), 'error' );
}
add_action( 'woocommerce_checkout_update_order_meta', 'jbm_legality_checkout_field_update_order_meta' );
function jbm_legality_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['legality_checkout'] ) ) {
        update_post_meta( $order_id, '_legality_checkout', current_time( 'mysql' ) );
    }
}
?>
