<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/classic-commerce/emails/plain/email-order-details.php.
 *
 * @see     https://classiccommerce.cc/docs/installation-and-setup/template-structure/
 * @package ClassicCommerce/Templates/Emails
 * @version WC-3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );

/* translators: %1$s: Order ID. %2$s: Order date */
echo wp_kses_post( wc_strtoupper( sprintf( __( '[Order #%1$s] (%2$s)', 'classic-commerce' ), $order->get_order_number(), wc_format_datetime( $order->get_date_created() ) ) ) ) . "\n";
echo "\n" . wc_get_email_order_items( $order, array( // WPCS: XSS ok.
	'show_sku'      => $sent_to_admin,
	'show_image'    => false,
	'image_size'    => array( 32, 32 ),
	'plain_text'    => true,
	'sent_to_admin' => $sent_to_admin,
) );

echo "==========\n\n";

$totals = $order->get_order_item_totals();

if ( $totals ) {
	foreach ( $totals as $total ) {
		echo wp_kses_post( $total['label'] . "\t " . $total['value'] ) . "\n";
	}
}

if ( $order->get_customer_note() ) {
	echo esc_html__( 'Note:', 'classic-commerce' ) . "\t " . wp_kses_post( wptexturize( $order->get_customer_note() ) ) . "\n";
}

if ( $sent_to_admin ) {
	/* translators: %s: Order link. */
	echo "\n" . sprintf( esc_html__( 'View order: %s', 'classic-commerce' ), esc_url( $order->get_edit_order_url() ) ) . "\n";
}

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
