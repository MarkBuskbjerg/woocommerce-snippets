/* 
 * Name: Direct to cart
 * Description: Redirect users directly to checkout instead of cart. Extremely useful for one-product shops.
 * Author: Mark Buskbjerg
 */

add_filter('woocommerce_add_to_cart_redirect', 'mb_direct_to_cart');

function mb_direct_to_cart() {
    global $woocommerce;
    $checkout_url = wc_get_checkout_url();
    return $checkout_url;   
}
