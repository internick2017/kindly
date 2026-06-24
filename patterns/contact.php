<?php
/**
 * Title: Contact — Get in touch
 * Slug: kindly/contact
 * Categories: kindly, contact
 * Description: Contact details beside a placeholder for a forms-plugin block.
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Get in touch', 'kindly' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'Reach out', 'kindly' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Email:', 'kindly' ); ?></strong> hello@example.org</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Phone:', 'kindly' ); ?></strong> (000) 000-0000</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong><?php esc_html_e( 'Address:', 'kindly' ); ?></strong> 123 Community Way, Your City</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"surface","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-surface-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","textColor":"primary"} -->
<p class="has-text-align-center has-primary-color has-text-color"><?php esc_html_e( 'Add your contact-form plugin block here.', 'kindly' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
