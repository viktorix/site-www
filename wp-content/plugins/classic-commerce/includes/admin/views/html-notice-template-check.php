<?php
/**
 * Admin View: Notice - Template Check
 *
 * @package ClassicCommerce/Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme = wp_get_theme();
?>
<div id="message" class="updated woocommerce-message">
	<a class="woocommerce-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'wc-hide-notice', 'template_files' ), 'woocommerce_hide_notices_nonce', '_wc_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'classic-commerce' ); ?></a>

	<p>
		<?php /* translators: %s: theme name */ ?>
		<?php printf( __( '<strong>Your theme (%s) contains outdated copies of some Classic Commerce template files.</strong> These files may need updating to ensure they are compatible with the current version of Classic Commerce. Suggestions to fix this:', 'classic-commerce' ), esc_html( $theme['Name'] ) ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
		<ol>
			<li><?php esc_html_e( 'Update your theme to the latest version. If no update is available contact your theme author asking about compatibility with the current Classic Commerce version.', 'classic-commerce' ); ?></li>
			<li><?php esc_html_e( 'If you copied over a template file to change something, then you will need to copy the new version of the template and apply your changes again.', 'classic-commerce' ); ?></li>
		</ol>
	</p>
	<p class="submit">
		<a class="button-primary" href="https://docs.woocommerce.com/document/template-structure/" target="_blank"><?php esc_html_e( 'Learn more about templates', 'classic-commerce' ); ?></a>
		<a class="button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=wc-status' ) ); ?>" target="_blank"><?php esc_html_e( 'View affected templates', 'classic-commerce' ); ?></a>
	</p>
</div>
