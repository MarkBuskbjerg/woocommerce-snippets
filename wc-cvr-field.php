/*
 * Title: WooCommerce CVR Field
 * Description: Adds, saves and displays a custom field for WooCommerce Checkout. This field is the danish CVR number (registration number for a company)
 * How: Just add this to functions.php after installing WooCommerce
 */

/*
* CVR in WooCommerce Checkout
*/
add_action( 'woocommerce_after_checkout_billing_form', 'mb_cvr_field' );
function mb_cvrr_field( $checkout ) {
    echo '<div id="mb_vat_field"><h2>' . __('CVR nummer') . '</h2>';

    woocommerce_form_field( 'cvr_number', array(
        'type'          => 'text',
        'class'         => array( 'cvr-number-field form-row-wide') ,
        'label'         => __( 'CVR nummer Number' ),
        'placeholder'   => __( 'Indtast dit CVR nummer' ),
		), $checkout->get_value( 'cvr_number' ));

    echo '</div>';
}

/*
* Save CVR Number in the order meta
*/
add_action( 'woocommerce_checkout_update_order_meta', 'mb_checkout_cvr_number_update_order_meta' );
function mb_checkout_cvr_number_update_order_meta( $order_id ) {
	if ( ! empty( $_POST['cvr_number'] ) ) {
			update_post_meta( $order_id, '_cvr_number', sanitize_text_field( $_POST['cvr_number'] ) );
	}
}

/*
 * Display CVR nummer in order edit screen
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'mb_cvr_number_display_admin_order_meta', 10, 1 );
function mb_cvr_number_display_admin_order_meta( $order ) {
    echo '<p><strong>' . __( 'CVR nummer', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->id, '_cvr_number', true ) . '</p>';
}
